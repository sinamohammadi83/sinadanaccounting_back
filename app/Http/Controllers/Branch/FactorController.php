<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\CreateFactorRequest;
use App\Http\Requests\Branch\UpdateFactorRequest;
use App\Http\Resources\Branch\FactorResource;
use App\Models\Factor;
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
                'description' => $product['description'],
                'unit' => $product['unit'],
                'count' => $product['count'],
                'unit_price' => $product['unit_price'],
                'discount' => $product['discount'],
                'tax' => $product['tax'],
                'total_price' => $total_price_product,

            ];


            $factor->update([
                'total_price' => $total_price_factor
            ]);

            $factor->factorProduct()->attach($product['product_id'],$productData);

        }

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
                'description' => $product['description'],
                'unit' => $product['unit'],
                'count' => $product['count'],
                'unit_price' => $product['unit_price'],
                'discount' => $product['discount'],
                'tax' => $product['tax'],
                'total_price' => $total_price_product,
            ];
        }

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
}
