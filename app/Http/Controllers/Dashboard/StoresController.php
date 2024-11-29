<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $stores=Store::paginate(5);
       return view('dashboard.stores.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store=new store();
        return view('dashboard.stores.create',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
         $request->merge([
                'slug'=>Str::slug($request->name)
         ]);
         $data=$request->except(['logo_image','cover_image']);
         if($request->hasFile('logo_image')){
           $logo_file=$request->logo_image;
           $logo_path=$logo_file->store('dashboardImages/stores/logoImages','public');
           $data['logo_image']=$logo_path;
         }
         if($request->hasFile('cover_image')){
            $cover_file=$request->cover_image;
            $cover_path=$cover_file->store('dashboardImages/stores/coverImages','public');
            $data['cover_image']=$cover_path;
          }
        Store::create($data);
        return redirect()->route('dashboard.stores.index')
               ->with('success','store created successfully');
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
    public function edit(Store $store)
    {
        return view('dashboard.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
       $request->merge([
           'slug'=>Str::slug($request->name)
       ]);
       $data=$request->except(['logo_image','cover_image']);
       $old_logo_image=$store->logo_image;
       $old_cover_image=$store->cover_image;
       if($request->hasFile('logo_image')){
         $logo_file=$request->logo_image;
         $logo_path=$logo_file->store('dashboardImages/stores/logoImages','public');
         $data['logo_image']=$logo_path;
       }
       if($request->hasFile('cover_image')){
        $cover_file=$request->cover_image;
        $cover_path=$cover_file->store('dashboardImages/stores/coverImages','public');
        $data['cover_image']=$cover_path;
      }
      $store->update($data);
      if($old_logo_image && isset( $data['logo_image'])){
        Storage::disk('public')->delete($old_logo_image);
       }
       if($old_cover_image && isset( $data['cover_image'])){
        Storage::disk('public')->delete($old_cover_image);
       }
    return redirect()->route('dashboard.stores.index')
            ->with('success','store updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
          return redirect()->route('dashboard.stores.index')
          ->with('success','store deleted successfully');
    }
    public function trash(){
        $stores=Store::onlyTrashed()->paginate();
        return view('dashboard.stores.trash',compact('stores'));
    }
    public function restore(Request $request,$id){
        $store=Store::onlyTrashed()->findOrFail($id);
        $store->restore();
        return redirect()->route('dashboard.stores.trash')
               ->with('sucsses','store restored sucssefuly');
    }
    public function forceDelete($id){
      $store=Store::onlyTrashed()->findOrFail($id);
      $old_cover_image=$store->cover_image;
      $old_logo_image=$store->logo_image;
      $store->forceDelete();
      if($old_cover_image){
        Storage::disk('public')->delete($old_cover_image);
      }
      if($old_logo_image){
        Storage::disk('public')->delete($old_logo_image);
      }
      return redirect()->route('dashboard.stores.trash')
      ->with('success','store deleted forever successfully');
    }
}
