<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        //any function must return respose : view,json,redirect,file
        return view("dashboard.index");
    }
}
