<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    // eager loading
        $products=Product::with(['category','store'])->latest()->paginate();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product=new Product();
        $categories=Category::all();
        $stores=Store::all();
        return view('dashboard.products.create',
        compact('product','categories','stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   $request->merge([
        'slug'=>Str::slug($request->name)
    ]);
        $product=Product::create($request->all());
        return redirect()->route('dashboard.products.index')
        ->with('success','product '.$product->name.' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories=Category::all();
        $stores=Store::all();
        $tags=implode(',',$product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit',
        compact('product','categories','stores','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,Product $product)
    {
        $request->merge([
            'slug'=> Str::slug($request->name)
        ]);
       $old_image=$product->image;
       $data=$request->except('image','tags');
       if($request->hasFile('image')){
          $file = $request->file('image') ;
          $path=$file->store('dashboardImages/products','public');
          $data['image']=$path;
       }
       $product->update($data);
       if($old_image && isset( $data['image'])){
           Storage::disk('public')->delete($old_image);
       }
    //    dd($request->post('tags'));
       $tags=json_decode($request->post('tags'));
       $saved_tags=Tag::all();
       $tag_ids=[];
       foreach($tags as $item){
         $slug=Str::slug($item->value);
         $tag=$saved_tags->where('slug',$slug)->first();
         if(! $tag){
            $tag=Tag::create([
                'name'=>$item->value,
                'slug'=>$slug
            ]);
         }
         $tag_ids[]=$tag->id;
       }
       $product->tags()->sync($tag_ids);
       return redirect()->route('dashboard.products.index')
               ->with('success','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
