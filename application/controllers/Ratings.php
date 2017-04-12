<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ratings extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->model('ratings_model');
                $this->load->model('users_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }
	
        public function addPoint()
	{   
            //Ratings/addPoint
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                $num = 1;
                $newsId = $_POST['newsId'];
                $userId = $_POST['userId'];
                if($this->ratings_model->isAlreadyUp($userId,$newsId)){
                    $this->ratings_model->removeUp($newsId,$userId);
                    $this->news_model->removePoint($newsId);
                    $result = array(
                        'action' => 'removed',
                        'points' => $num
                    );
                    echo json_encode($result);
                }
                else {
                    if($id = $this->ratings_model->isAlreadyDown($userId,$newsId)){
                        $this->ratings_model->removeDown($newsId,$userId);
                        $this->news_model->addPoint($newsId);
                        $num++;
                    }
                    $this->ratings_model->addUp($newsId,$userId);
                    $this->news_model->addPoint($newsId);
                    $result = array(
                        'action' => 'added',
                        'points' => $num
                    );
                    echo json_encode($result);
                }
            }
	}
        
        public function removePoint()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                $num = 1;
                $newsId = $_POST['newsId'];
                $userId = $_POST['userId'];
                
                if($this->ratings_model->isAlreadyDown($userId,$newsId)){
                    $this->ratings_model->removeDown($newsId,$userId);
                    $this->news_model->addPoint($newsId);
                    $result = array(
                        'action' => 'added',
                        'points' => $num
                    );
                    echo json_encode($result);
                }
                else{
                    if($id = $this->ratings_model->isAlreadyUp($userId,$newsId)){
                        $this->ratings_model->removeUp($newsId,$userId);
                        $this->news_model->removePoint($newsId);
                        $num++;
                    }
                    $this->ratings_model->addDown($newsId,$userId);
                    $this->news_model->removePoint($newsId);
                    $result = array(
                        'action' => 'removed',
                        'points' => $num
                    );
                    echo json_encode($result);
                }
            }
	}
        
        public function addGood()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                $newsId = $_POST['newsId'];
                $userId = $_POST['userId'];
                
                $previous = false;
                if($this->ratings_model->isAlreadyGood($userId,$newsId)){
                    $this->ratings_model->removeGood($newsId,$userId);
                    $this->news_model->removeGood($newsId);
                    $result = array(
                        'action' => 'removed',
                        'type' => 'good'
                    );
                    echo json_encode($result);
                }
                else{
                    if($this->ratings_model->isAlreadyBad($userId,$newsId)){
                        $this->ratings_model->removeBad($newsId,$userId);
                        $this->news_model->removeBad($newsId);
                        $previous =  true;
                    }
                    $this->ratings_model->addGood($newsId,$userId);
                    $this->news_model->addGood($newsId);
                    $result = array(
                        'action' => 'added',
                        'type' => 'good',
                        'previous' => $previous
                    );
                    echo json_encode($result);
                }
            }
	}
        
        public function addBad()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                $newsId = $_POST['newsId'];
                $userId = $_POST['userId'];
                
                $previous = false;
                if($this->ratings_model->isAlreadyBad($userId,$newsId)){
                    $this->ratings_model->removeBad($newsId,$userId);
                    $this->news_model->removeBad($newsId);
                    $result = array(
                        'action' => 'removed',
                        'type' => 'bad'
                    );
                    echo json_encode($result);
                }
                else{
                    if($this->ratings_model->isAlreadyGood($userId,$newsId)){
                        $this->ratings_model->removeGood($newsId,$userId);
                        $this->news_model->removeGood($newsId);
                        $previous = true;
                    }
                    $this->ratings_model->addBad($newsId,$userId);
                    $this->news_model->addBad($newsId);
                    $result = array(
                        'action' => 'added',
                        'type' => 'bad',
                        'previous' => $previous
                    );
                    echo json_encode($result);
                }
            }
	}
}
