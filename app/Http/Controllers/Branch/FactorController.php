<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\CreateFactorRequest;
use App\Http\Requests\Branch\UpdateFactorRequest;
use App\Http\Resources\Branch\FactorResource;
use App\Models\Account;
use App\Models\document;
use App\Models\documentRows;
use App\Models\Factor;
use App\Models\Ledger;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read-factor');

        return response()->json([
            'factors' => FactorResource::collection(Factor::all())
        ])->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFactorRequest $request)
    {
        $this->authorize('create-factor');

        $type = $request->get('type');
        $paid_price = $request->get('paid_price');

        $factor = Factor::query()->create([
            'branch_id' => auth()->user()->staff->branch_id,
            'staff_id' => auth()->user()->staff->id,
            'title' => $request->get('title'),
            'category_id' => $request->get('category_id'),
            'person_id' => $request->get('person_id'),
            'date' => $request->get('date'),
            'due_date' => $request->get('due_date'),
            'paid_price' => $request->get('paid_price'),
            'total_price' => 0,
            'type' => $type
        ]);

        $products = $request->get('products');

        $total_price_factor = 0;

        $document = document::query()->create([
            'date' => $request->get('date'),
            'branch_id' => auth()->user()->staff->branch_id,
            'staff_id' => auth()->user()->staff->id,
            'factor_id' => $factor->id,
            'title' => 'سند خودکار',
            'type' => $request->get('type'),
            'status' => $request->get('type'),

        ]);

        $creditor_account = Account::query()
            ->where('type','creditor')
            ->first();

        foreach ($products as $product){
            $productModel = Product::query()->where('id',$product['product_id'])->firstOrFail();
            if($type === 1){
                $productModel->update([
                    'count' =>  $product['count'] + $productModel->count
                ]);

            }else{
                $productModel->update([
                    'count' =>  $productModel->count - $product['count']
                ]);
            }

            $total_price_product = ($product['count'] * $product['unit_price']) + $product['tax'] - $product['discount'];

            $total_price_factor += $total_price_product;

            $productData = [
                'unit' => $product['unit'],
                'count' => $product['count'],
                'unit_price' => $product['unit_price'],
                'discount' => $product['discount'],
                'tax' => $product['tax'],
                'total_price' => $total_price_product,
                'storage_id' => $product['storage_id']
            ];


            $factor->update([
                'total_price' => $total_price_factor
            ]);

            $factor->factorProduct()->attach($product['product_id'],$productData);

            documentRows::query()->create([
                'document_id' => $document->id,
                'account_name' => $creditor_account->name,
                'description' => $productModel->name,
                'detailed_code' => random_int(1111,4444),
                'debtor' => 0,
                'creditor' => $total_price_product,
                'due_date' => $request->get('due_date')
            ]);
        }

        $debtor_account = Account::query()
            ->where('type','debtor')
            ->first();

        documentRows::query()->create([
            'account_id' => $debtor_account->id,
            'document_id' => $document->id,
            'account_name' => $debtor_account->name,
            'description' => $productModel->name,
            'detailed_code' => random_int(1111,4444),
            'debtor' => $factor->total_price,
            'creditor' => 0,
            'due_date' => $request->get('due_date')
        ]);




        return response()->json([
            'msg' => 'فاکتور با موفقیت افزوده شد'
        ])->setStatusCode(200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Factor $factor)
    {
        $this->authorize('read-factor');

        return response()->json([
            'factor' => new FactorResource($factor)
        ])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factor $factor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFactorRequest $request, Factor $factor)
    {
        $this->authorize('edit-factor');

        $type = (int) $request->get('type');
        $paid_price = $request->get('paid_price');
        $last_paid_price = $factor->paid_price;

        $factor->update([
            'branch_id' => auth()->user()->staff->branch_id,
            'staff_id' => auth()->user()->staff->id,
            'title' => $request->get('title'),
            'category_id' => $request->get('category_id'),
            'person_id' => $request->get('person_id'),
            'date' => $request->get('date'),
            'due_date' => $request->get('due_date'),
            'paid_price' => $request->get('paid_price'),
            'total_price' => 0,
            'type' => $type
        ]);

        $products = $request->get('products');
        $total_price_factor = 0;
        $syncData = [];

        $productModels = Product::whereIn('id', collect($products)->pluck('product_id'))
            ->get()
            ->keyBy('id');

        foreach ($products as $product){

            $productModel = $productModels[$product['product_id']];

            if($type === 1){
                $productModel->increment('count', $product['count']);
            } else {
                if($productModel->count < $product['count']){
                    throw new \Exception('موجودی کافی نیست');
                }
                $productModel->decrement('count', $product['count']);
            }

            $total_price_product = ($product['count'] * $product['unit_price'])
                + $product['tax'] - $product['discount'];

            $total_price_factor += $total_price_product;

            $syncData[$product['product_id']] = [
                'title' => $product['title'],
                'unit' => $product['unit'],
                'count' => $product['count'],
                'unit_price' => $product['unit_price'],
                'discount' => $product['discount'],
                'tax' => $product['tax'],
                'total_price' => $total_price_product,
            ];
        }

        if ($paid_price > 0 && $paid_price !== $last_paid_price)
            Ledger::query()->create([
                'type' => $type,
                'amount' => $paid_price - $last_paid_price,
                'description' => $type == 1 ? "جهت فاکتور خرید - $factor->title" : "جهت فاکتور فروش - $factor->title"
            ]);

        $factor->update([
            'total_price' => $total_price_factor
        ]);

        $factor->factorProduct()->sync($syncData);
        return response()->json([
            'msg' => 'فاکتور با موفقیت ویرایش شد'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factor $factor)
    {
        $this->authorize('delete-factor');

        $factor->factorProduct()->detach();

        $factor->delete();

        return response()->json([
            'msg' => 'فاکتور با موفقیت حذف شد'
        ])->setStatusCode(200);
    }

    public function getStorages()
    {
        return response()->json([
            'storages' => auth()->user()->staff->branch->storages
        ])->setStatusCode(200);
    }
}
