<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
             $products= Product::filter($request->query())
                        ->with('category:id,name','store:id,name','tags:id,name')
                        ->paginate();
            return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|max:255',
            'category_id'=>'required|exists:categories,id',
            'store_id'=>'required|exists:stores,id',
            'status'=>'in:active,draft,archived',
            'price'=>'required|numeric|min:0',
            'compare_price'=>'required:numeric|gt:price'
        ]);
        $product=Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
         return new ProductResource($product);
    //    return $product->load('category:id,name','store:id,name','tags:id,name');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'sometimes|string|max:255',
            'description'=>'nullable|max:255',
            'category_id'=>'sometimes|exists:categories,id',
            'store_id'=>'sometimes|exists:stores,id',
            'status'=>'in:active,draft,archived',
            'price'=>'sometimes|numeric|min:0|lt:compare_price',
            'compare_price'=>'sometimes:numeric|gt:price'
        ]);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
       return [
            'message'=>'product deleted successfully'
        ];
        // return response()->json([
        //     'message'=>'product deleted successfully'
        // ],200);
    }
}
