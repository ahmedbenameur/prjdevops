<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index($name = null)
    {
        return view("welcome", compact("name"));
    }

    public function hello($name,$age,$gender=null){
        return view("hello", compact("name","age","gender"));
    }

}
