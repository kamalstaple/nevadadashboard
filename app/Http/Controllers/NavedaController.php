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

		// print_r($request->all());
		// die;
         $statewide = Statewide::where(['tab' =>$request->city,  'action' =>'statewide_data'])->get();
		 if(isset($statewide[0]) && !empty($statewide[0])){
		 return view('statewide',compact('statewide'));
		 }else{
			return redirect()->route('/');
		 }
       

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



	public function download(Request $request)

	{
		
	
		$exp = explode(".",$request->name);
		$type = $exp[1];

		$url = $this->publicPath .'reports/goed/'.$request->name;
		// $url = $this->MRSITE .'reports/goed/'.$name;
		$path = 'reports/'.$request->name;
		
		$fp = fopen ($path, 'w+'); # open file to write 
		$ch = curl_init(); # start curl
		curl_setopt( $ch, CURLOPT_URL, $url );

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false ); 	# set return transfer to false
		curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 ); # increase timeout to download big file
		curl_setopt( $ch, CURLOPT_FILE, $fp ); # write data to local file
		
		curl_exec( $ch ); # execute curl
		curl_close( $ch );
		fclose( $fp ); # close local file
		
		if (filesize($path) > 0)
		$arrs = array('file' => $request->name);
		$postDatas = http_build_query($arrs);
		
 		$this->mr_portal('reportD', $postDatas);
		
		if(isset($_COOKIE['download_complete']))
		{
			unset($_COOKIE['download_complete']);
		}
		setcookie("download_complete", "completed", time()+3600 );
		
		header("Pragma: public");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		
		if($type == "pdf") {
			header("Content-Type: application/force-download");
		} else if($type == "csv"){
			header("Content-Type: application/vnd.ms-excel");	
		} else {
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		}
		
		header("Content-Disposition: attachment; filename=".$request->name);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($path));
		readfile($path);
		header('Connection: close');
		@unlink($path);
		exit;
	}


}
