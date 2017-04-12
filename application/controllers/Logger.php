<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logger extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('logs_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }
	
        public function AddInitiallog()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                $key = $_POST['APIKey'];
                $url = $_POST['URL'];
                $ip = $_POST['ip'];
                $lat = $_POST['latitude'];
                $lng = $_POST['longitude'];
                $country = $_POST['country_name'];
                $address = $_POST['city'].','.$_POST['region_name'];
                
                echo json_encode($this->logs_model->Addlog($key,$url,$ip,$lat,$lng,$country,$address));
            }
	}
        
        public function LogEnd()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['key'];
                $time = $_POST['time'];
                echo json_encode($this->logs_model->LogEnd($id,$time));
            }
	}
        
        public function LogTenSeconds()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['key'];
                echo json_encode($this->logs_model->LogTenSeconds($id));
            }
	}
        
        public function LogThirtySeconds()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['key'];
                echo json_encode($this->logs_model->LogThirtySeconds($id));
            }
	}
        
        public function LogThreeMins()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['key'];
                echo json_encode($this->logs_model->LogThreeMins($id));
            }
	}
        
	public function GetLogs()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $key = $_POST['key'];
                
                $ip = (isset($_POST['IP']) ? $_POST['IP'] : NULL);
                $URL = (isset($_POST['URL']) ? $_POST['URL'] : NULL);
                $Country = (isset($_POST['Country']) ? $_POST['Country'] : NULL);
                echo json_encode($this->logs_model->GetAllLogs($key,$ip,$URL,$Country));   
            }
	}
        
        public function GetLog()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $key = $_POST['key'];
                
                $ID = (isset($_POST['ID']) ? $_POST['ID'] : NULL);
                echo json_encode($this->logs_model->GetLog($key,$ID));   
            }
	}
        
}
