<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('websites_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }
	
        public function AddSite()
	{
            //http://localhost/SuperArdorAnalytics/index.php/Website/AddSite
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $owner_id =  $_POST['OwnerId'];
                $name = $_POST['Name'];
                echo json_encode($this->websites_model->AddWebsite($owner_id,$name));
            }
	}
        
        public function GetWebsitesOfUser() {
            //http://localhost/SuperArdorAnalytics/index.php/Website/GetWebsitesOfUser
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $user_id =  $_POST['UserId'];
                echo json_encode($this->websites_model->GetWebsitesOfUser($user_id));
            }
            
        }
        
        public function EditWebSite() {
            //http://localhost/SuperArdorAnalytics/index.php/Website/EditWebSite
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $website_id = $_POST['WebSiteID'];
                $newName = $_POST['NewName'];
                echo json_encode($this->websites_model->EditWebSite($website_id,$newName));
            }
            
        }
       
}
