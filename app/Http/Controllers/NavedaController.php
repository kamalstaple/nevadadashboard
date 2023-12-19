<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class NavedaController extends Controller
{
    

    /**Home page data  */
    public function Home()
    {
        $data=  Home::where('action', 'home')->get()->toArray();
    
        return view ('home',compact('data'));
       
    }
    public function economical()
    {
        return view ('economical');

    }
}
