<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\CreateProductRequest;
use App\Http\Requests\Branch\UpdateProductRequest;
use App\Http\Resources\Branch\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read-product');

        return response()->json([
            'products' => auth()->user()->staff->branch->products
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
    public function store(CreateProductRequest $request)
    {
        $this->authorize('create-product');

        $product = Product::query()->create([
            'branch_id' => auth()->user()->staff->branch_id,
            'staff_id' => auth()->user()->staff->id,
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'sell_price' => $request->get('sell_price'),
            'buy_price' => $request->get('buy_price'),
            'count' => $request->get('count'),
        ]);

        if($product){
            return response()->json([
                'msg' => 'کالا با موفقیت در انبار افزوده شد'
            ])->setStatusCode(200);
        }

        return response()->json([
            'msg' => 'ثبت کالا با خطاد رو به رو شد'
        ])->setStatusCode(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('read-product');

        return response()->json([
            'product' => new ProductResource($product)
        ])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('edit-product');

        if($request->hasFile("pic")){
            $pic = $request->get('pic');
        }else{
            $pic = $product->pic;
        }

         $product->update([
             'storage_id' => $request->get("storage_id"),
             'staff_id' => auth()->user()->staff->id,
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'sell_price' => $request->get('sell_price'),
            'buy_price' => $request->get('buy_price'),
            'pic' => $pic,
            'count' => $request->get('count'),
        ]);

        return response()->json([
            'msg' => 'کالا با موفقیت ویرایش شد'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete-product');

        $product->delete();

        return response()->json([
            'msg' => 'کالا با موفقیت حذف شد'
        ])->setStatusCode(200);
    }

    public function getStorages()
    {
        return response()->json([
            'storages' => auth()->user()->staff->branch->storages
        ])->setStatusCode(200);
    }

    public function getCategories()
    {
        return response()->json([
            "categories" => Category::all()
        ])->setStatusCode(200);
    }

    public function findProduct(Request $request)
    {
        $q = $request->get('q');
        $products = Product::query()->where('name','like',"%$q%")->get();

        return response()->json([
            'products' => ProductResource::collection($products)
        ])->setStatusCode(200);
    }
}
