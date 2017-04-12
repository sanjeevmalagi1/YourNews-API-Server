<?php

class News_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function AddNews($image,$heading,$body,$link,$createdBy,$createdAt,$type) {
            $NewsInfo = array(
                'image' => $image,
                'heading' => $heading,
                'body' => $body,
                'link' => $link,
                'createdBy' => $createdBy,
                'Type' => $type
                );
            
            if($this->db->insert('news', $NewsInfo)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function isAlreadyAdded($heading) {
            $NewsInfo = array(
                'heading' => $heading
                );
            $this->db->where($NewsInfo);
            $query = $this->db->get('news');
            return $query->row_array();
        }
        
        public function addPoint($id) {
            $this->db->where('id', $id);
            $this->db->set('points', 'points+1', FALSE);
            $this->db->update('news');
        }
        
        public function removePoint($id) {
            $this->db->where('id', $id);
            $this->db->set('points', 'points-1', FALSE);
            $this->db->update('news');
        }
        
        public function addGood($id) {
            $this->db->where('id', $id);
            $this->db->set('good', 'good+1', FALSE);
            $this->db->update('news');
        }
        
        public function removeGood($id) {
            $this->db->where('id', $id);
            $this->db->set('good', 'good-1', FALSE);
            $this->db->update('news');
        }
        
        public function addBad($id) {
            $this->db->where('id', $id);
            $this->db->set('bad', 'bad+1', FALSE);
            $this->db->update('news');
        }
        
        public function removeBad($id) {
            $this->db->where('id', $id);
            $this->db->set('bad', 'bad-1', FALSE);
            $this->db->update('news');
        }
        
        public function GetSectionNews($section,$type,$page=0) {
            /*SELECT *,(good+bad) AS SUM_COUNTS, (NOW()-createdAt) AS TIME_ELIPSED, ((good+bad)*10000/(NOW()-createdAt)) AS RANKING
            FROM news 
            ORDER BY RANKING LIMIT 1*/
            $this->db->select('*,(NOW()-createdAt) as `TIME_ELAPSED`');
            $this->db->where('Type', $section);
            
            $this->db->order_by("TIME_ELAPSED", "asc");
            if($type == "good"){
                $this->db->select('((good-bad)/(good+bad)) as `RATING`');
                $this->db->order_by("RATING", "desc");
            }
            if($type == "bad"){
                $this->db->select('((bad-good)/(good+bad)) as `RATING`');
                $this->db->order_by("RATING", "desc");
            }
            $this->db->order_by("points", "desc");
            $this->db->limit(1,$page);
            $query = $this->db->get('news');
            
            return $query->result_array();
        }
        
        public function GetAllNews($type,$page=0) {
            $this->db->select('*,((points)/((NOW()-createdAt))) as `RANKING`');
            $this->db->select('(NOW()-createdAt) as `TIME_ELAPSED`');
            if($type == "good"){
                $this->db->select('((good-bad)/(good+bad)) as `RATING`');
                $this->db->order_by("RATING", "desc");
            }
            if($type == "bad"){
                $this->db->select('((bad-good)/(good+bad)) as `RATING`');
                $this->db->order_by("RATING", "desc");
            }
            $this->db->order_by("TIME_ELAPSED", "asc");
            $this->db->order_by("RANKING", "desc");
            $this->db->limit(1,$page);
            $query = $this->db->get('news');
            
            return $query->result_array();
        }
}