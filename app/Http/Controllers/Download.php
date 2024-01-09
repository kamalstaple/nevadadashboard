<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Download extends Controller
{
    private $publicPath = 'https://dpdata.myresearcher.com/public/';
	private $MRSITE = 'https://dpdata.myresearcher.com/nv/';
	private $FROM_LOCAL_DB = '1';
    





    private function mr_portal($action, $postDatas)
	{
		
		
		$username = 'lvgea';
		$password = 'nTryIt!';
		//$siteUrl = $this->MRSITE .'goedcur/'.$action;
		$siteUrl = $this->MRSITE .$action;
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
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postDatas );
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




    public function download(Request $request)
	{
	//   dd($request->name);
		$exp = explode(".",$request->name);
		$type = $exp[1];
        $name = $request->name;

		$url = $this->publicPath .'reports/goed/'.$name;
		// $url = $this->MRSITE .'reports/goed/'.$name;
		$path = 'reports/'.$name;
		
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
		$arrs = array('file' => $name);
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
		
		header("Content-Disposition: attachment; filename=".$name);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($path));
		readfile($path);
		header('Connection: close');
		@unlink($path);
		exit;
	}


}
