<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Economic;
use App\Models\Statewide;
use App\Models\Location;

class NavedaController extends Controller
{
    
    private $publicPath = 'https://dpdata.myresearcher.com/public/';
	private $MRSITE = 'https://dpdata.myresearcher.com/nv/';
	private $FROM_LOCAL_DB = '1';

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
         echo "<pre/>";
         print_r($statewide);
         die;
        
         

    }


    public function locationcomparistion()
    {
        $location = Location::where('action' , 'location_msa')->get();
       
        return view('location_comparistion', compact('location'));
    }




    public function mr_portal(Request $request)
	{
		// 
        // return $request;
        // print_r($request);
		// die;
		$username = 'lvgea';
		$password = 'nTryIt!';
		//$siteUrl = $this->MRSITE .'goedcur/'.$action;
		$siteUrl = $this->MRSITE .$request->action;
		// echo $siteUrl1;
		// die();
		if($siteUrl != '') {

			$ch = curl_init();
			$headers = array(
			'Accept: application/json',
			'Authorization: Bearer 3XT49nRtgertygetHYDFDUYuN2zPSwMEAOq9X34jckRKSbqLWEwKAFtcDBOB'
			);
			curl_setopt($ch, CURLOPT_URL, $siteUrl);
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_USERPWD, "portaluser:nTryIt!");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
			curl_setopt($ch, CURLOPT_TIMEOUT,        20); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
			
			$content = curl_exec($ch);
			
			/*if($action=='economy_develop' || $action=='economy_labor' || $action=='economy_real' || $action=='economy_utility' || $action=='economy_taxes'){
				$content=gzdecode($content);
			}*/
		}
		else {
			$content = '';
		}
		// echo "<pre/>";
		// print_r($content);
		// die;
		return $content;
	}



	public function overviewpage()
	{
		return view('overview');
	}
}
