<?php

// include 'model.php';
Class portal {
	//private $MRSITE = 'http://myresearcher.com/dataportal/';

	/**
	 * 
	 * new laravel api url
	 * ***/
    private $publicPath = 'https://dpdata.myresearcher.com/public/';
	private $MRSITE = 'https://dpdata.myresearcher.com/nv/';
	private $FROM_LOCAL_DB = '1';
	
	public function __construct()
    {
		if (isset($_GET['download']) && $_GET['download'] != '') {
			$this->download($_GET['download']);
		}
    }

	private function mr_portal($action, $postDatas)
	{
		
		// echo $postDatas;
		// echo $postDatas;

		// die;
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
	public function get_portal(){

		if(isset($_POST['action']))
		{
			$action = $_POST['action'];
		} else {
			$action = '';
		}
		if(isset($_POST['tab']))
		{
			$tab = $_POST['tab'];
		} else {
			$tab = '';
		}

		$postDatas = '';
		if(isset($_POST['is_arr']) && $_POST['is_arr'] == 1)
		{
			$postDatas = http_build_query($_POST); 
		}
			if(isset($_POST['ids']))
			{
				$ids = $_POST['ids'];
			} else {
				$ids = '';
			}

		if ($this->FROM_LOCAL_DB == 1) {
		$Model = new Model();

			switch ($action) {
				
				case 'home':
					$content = $Model->home($action);
					break;
	
				case 'economy_develop':
				case 'economy_labor':
				case 'economy_real':
				case 'economy_utility':
				case 'economy_taxes':
					$content = $Model->economic_development($action);
					break;
	
				case 'location_msa':
					$content = $Model->location_comparison($action);
					break;
	
				case 'statewide_data':
					$content = $Model->statewide_data($tab, $action);
					break;
	
			/*	case 'quick_chart':
					$content = $Model->quick_chart($ids, $action) ;
					break;*/
					
				default:
					$content = $this->mr_portal($action, $postDatas);
				break;
			}
		}else{
			$content = $this->mr_portal($action, $postDatas);
		}

		return $content;
	}

	public function download_portal()
	{
		if(isset($_POST['action']))
		{
			$action = $_POST['action'];
		} else {
			die;
		}
		$postDatas = http_build_query($_POST);
	
		$content = $this->mr_portal($action, $postDatas);
		// $content = $dataModel->home();

		return $content;
	}
	
	public function download($name)
	{
	
		$exp = explode(".",$name);
		$type = $exp[1];

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
$obj = new portal();

if(isset($_POST['downlaod']) && $_POST['downlaod'] == 1){
    echo $obj->download_portal();
} else {
	echo $obj->get_portal();

}


