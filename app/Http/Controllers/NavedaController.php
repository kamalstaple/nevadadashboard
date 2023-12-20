<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Economic;
use App\Models\Statewide;

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
        $economic = Economic::get();
        // echo "<pre/>";
        // print_r(json_decode($economic[0]['data']));
        // die;
        return view ('economical',compact('economic'));

    }
    public function mapdata(Request $request)
    {
         $statewide = Statewide::where(['tab' =>$request->city,  'action' =>'statewide_data'])->get();
        
         

    }
}
