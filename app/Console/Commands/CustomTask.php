<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Home;
use App\Models\Economic;
use App\Models\Location;
use App\Models\Statewide;
class CustomTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     private $publicPath = 'https://dpdata.myresearcher.com/public/';
     private $MRSITE = 'https://dpdata.myresearcher.com/nv/';
     private $FROM_LOCAL_DB = '2';
    protected $signature = 'app:custom-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       return $this->home();
        // $this->economic_development();
        // $this->statewide();
        // $this->locationComparison();
    }

    private function mr_portal($action, $postDatas)
    {
        $username = 'lvgea';
		$password = 'nTryIt!';
		$siteUrl = $this->MRSITE .$action;

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
		return $content;
    }
    private function home()
    {
        $res=0;
        $action='home';
        $postDatas = '';
        $data=$this->mr_portal($action,$postDatas);
        if(isset($data) && $data!=''){
           $updatedata= Home::where('action', $action)->update(['data'=> $data]);
            if($updatedata){
                return 'true';
            }else{
                echo "error";
            }
        	

        }
    }
    private function economic_development(){
        // echo "ok";
        // die;
        $res=0;
        $postDatas = '';
        $actions=array('economy_develop','economy_labor','economy_real','economy_utility','economy_taxes');
			/*echo "</br>";
			echo 'Economic Page';*/
        foreach ($actions as $key => $action) {
        	$data=$this->mr_portal($action,$postDatas);
	        if(isset($data) && $data!=''){
			print_r( $data=json_encode($data,TRUE));

	        	// $res = $Model->economic_development($action,$data);
	            /*if($res==1){
	                echo "</br>";
	                echo ucfirst($action).' -------DATA UPDATED SUCCESSFULLY.';
	            }*/
	        }
        }
       
    }

    private function statewide(){
        $res=0;
        $action='statewide_data';
        $actions=array('Humboldt','Elko','Washoe','Pershing','Lander','Eureka','Lander','White PINe','Mineral','Esmeralda','NYe','Nevada','Lincoln','Clark','Lyon','Douglas','Storey','Carson City','Churchill');
		/*echo "</br>";
		echo 'Statewide Page';*/
        foreach ($actions as $key => $tab) {
        	$postDatas = "action=statewide_data&tab=".$tab."&is_arr=1";
        	$data=$this->mr_portal('statewide_data',$postDatas); 
	        if(isset($data) && $data!=''){
                print_r( $data=json_encode($data,TRUE));
	        	// $res = $Model->statewide_data($action,$tab,$data);
	            /*if($res==1){
	                echo "</br>";
	                echo ucfirst($tab).' -------DATA UPDATED SUCCESSFULLY.';
	            }*/
	        }
        }
    }

    private function locationComparison(){
        $res=0;
        $action='location_msa';
        $postDatas = '';
        $data=$this->mr_portal($action,$postDatas);

		/*echo "</br>";
		echo 'Location Comparison Page';*/

        if(isset($data) && $data!=''){
            print_r( $data=json_encode($data,TRUE));
            /*if($res==1){
                echo "</br>";
                echo ucfirst('location comparison').' -------DATA UPDATED SUCCESSFULLY.';
            }*/
        }
    }
}
