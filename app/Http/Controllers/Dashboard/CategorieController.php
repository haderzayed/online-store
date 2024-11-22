<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents=Category::all();
        $category=new Category();
        return view('dashboard.categories.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug'=> Str::slug($request->name)
        ]);
        $data=$request->except('image');
        if($request->hasFile('image')){
           $file = $request->file('image') ;
           $path=$file->store('dashboardImages/categories','public');
           $data['image']=$path;
        }
        // dd($request->all());
        Category::create( $data);
        return redirect()->route('dashboard.categories.index')
               ->with('success','category created successfully');
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
    public function edit($id)
    {
        try{
            $category=Category::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('dashboard.categories.index')
               ->with('info','category not found !');
        }
        $parents=Category::where('id','<>',$id)
                           ->where(function($query)use ($id){
                            $query->whereNull('parent_id')
                            ->orWhere('parent_id','<>',$id);
                           })->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $category=Category::findOrFail($id);
       $old_image=$category->image;
       $data=$request->except('image');
       if($request->hasFile('image')){
          $file = $request->file('image') ;
          $path=$file->store('dashboardImages/categories','public');
          $data['image']=$path;
       }
       $category->update($data);
       if($old_image && isset( $data['image'])){
           Storage::disk('public')->delete($old_image);
       }
       return redirect()->route('dashboard.categories.index')
               ->with('success','category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $category=Category::findOrFail($id);
          $old_image=$category->image;
          $category->delete();
          if( $old_image){
            Storage::disk('public')->delete($old_image);
          }
          return redirect()->route('dashboard.categories.index')
          ->with('success','category deleted successfully');
    }
}
