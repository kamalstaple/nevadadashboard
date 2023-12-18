<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class NavedaController extends Controller
{
    

    public function Home()
    {
        $data=  Home::where('action', 'home')->select('data')->get();
        return view ('home',compact('data'));
       
    }
}
