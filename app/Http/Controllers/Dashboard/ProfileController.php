<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit(){
        $user=Auth::user()->profile;
        $countries = Countries::getNames();
        $locales = Languages::getNames();
        return view('dashboard.profile.edit',compact('user','countries','locales'));
    }
    public function update(Request $request){
        $request->validate([
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'birthday'=>['nullable','date','before:today'],
            'country'=>['required','string','size:2']
        ]);
        // $data=$request->except(['_token', '_method']);
        $user=Auth::user();
        //fill هتعبي المودل بالداتا بس
        //save لو موجود هتعدل عليه لو مش موجود هتكريته
         $user->profile->fill( $request->all() )->save();

        return redirect()->route('dashboard.profile.edit')
               ->with([
                'success'=>'profile updated successufly'
            ]);

    }
}
