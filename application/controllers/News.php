<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    
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
	
        public function GetNewsMetadata()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                echo json_encode($this->news_model->getNewsMetadata());
            }
	}
        
        public function GetNewById()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                echo json_encode($this->news_model->getNewsMetadata());
            }
	}
        
        public function GetSectionNews()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //print_r($_POST);
                $page = $_POST['page'];
                $section = $_POST['section'];
                $type = $_POST['type'];
                echo json_encode($this->news_model->GetSectionNews($section,$type,$page));
            }
	}
        
        public function GetAllNews() {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $page = $_POST['page'];
                $type = $_POST['type'];
                echo json_encode($this->news_model->GetAllNews($type,$page));
            }
            /*$r = new HttpRequest('http://example.com/feed.rss', HttpRequest::METH_GET);
            $r->setOptions(array('lastmodified' => filemtime('local.rss')));
            $r->addQueryData(array('category' => 3));
            try {
                $r->send();
                if ($r->getResponseCode() == 200) {
                    file_put_contents('local.rss', $r->getResponseBody());
                }
            } catch (HttpException $ex) {
                echo $ex;
            }*/
        }
        
        public function AddNews() {
            
            $response = file_get_contents('https://newsapi.org/v1/articles?source=techcrunch&sortBy=latest&apiKey=c9d18881f5cf4446b066b0d7989b79b2');
            $result = json_decode($response); 
            if($result->status == "ok"){
                //var_dump($result->articles);
                
                foreach ($result->articles as $article) {
                    //var_dump($this->news_model->isAlreadyAdded($article->title));
                    if(! $this->news_model->isAlreadyAdded($article->title)){
                        $this->news_model->AddNews($article->urlToImage,$article->title,$article->description,$article->url,$article->author,$article->publishedAt,"Technology");
                    }
                }
            }
            
            $response = file_get_contents('https://newsapi.org/v1/articles?source=business-insider&sortBy=latest&apiKey=c9d18881f5cf4446b066b0d7989b79b2');
            $result = json_decode($response); 
            if($result->status == "ok"){
                //var_dump($result->articles);
                
                foreach ($result->articles as $article) {
                    //var_dump($this->news_model->isAlreadyAdded($article->title));
                    if(! $this->news_model->isAlreadyAdded($article->title)){
                        $this->news_model->AddNews($article->urlToImage,$article->title,$article->description,$article->url,$article->author,$article->publishedAt,"Business");
                    }
                }
            }
            
            $response = file_get_contents('https://newsapi.org/v1/articles?source=the-times-of-india&sortBy=latest&apiKey=c9d18881f5cf4446b066b0d7989b79b2');
            $result = json_decode($response); 
            if($result->status == "ok"){
                //var_dump($result->articles);
                
                foreach ($result->articles as $article) {
                    //var_dump($this->news_model->isAlreadyAdded($article->title));
                    if(! $this->news_model->isAlreadyAdded($article->title)){
                        $this->news_model->AddNews($article->urlToImage,$article->title,$article->description,$article->url,$article->author,$article->publishedAt,"National");
                    }
                }
            }
            
            $response = file_get_contents('https://newsapi.org/v1/articles?source=google-news&sortBy=top&apiKey=c9d18881f5cf4446b066b0d7989b79b2');
            $result = json_decode($response); 
            if($result->status == "ok"){
                //var_dump($result->articles);
                
                foreach ($result->articles as $article) {
                    //var_dump($this->news_model->isAlreadyAdded($article->title));
                    if(! $this->news_model->isAlreadyAdded($article->title)){
                        $this->news_model->AddNews($article->urlToImage,$article->title,$article->description,$article->url,$article->author,$article->publishedAt,"International");
                    }
                }
            }
            
            $response = file_get_contents('https://newsapi.org/v1/articles?source=cnn&sortBy=top&apiKey=c9d18881f5cf4446b066b0d7989b79b2');
            $result = json_decode($response); 
            if($result->status == "ok"){
                //var_dump($result->articles);
                
                foreach ($result->articles as $article) {
                    //var_dump($this->news_model->isAlreadyAdded($article->title));
                    if(! $this->news_model->isAlreadyAdded($article->title)){
                        $this->news_model->AddNews($article->urlToImage,$article->title,$article->description,$article->url,$article->author,$article->publishedAt,"International");
                    }
                }
            }
            
        }
}
