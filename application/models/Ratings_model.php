<?php

class Ratings_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function addUp($newsId,$userId) {
            $rating = array(
                'newsId' => $newsId,
                'ratedBy' => $userId,
                'up' => '1'
                );
            if($this->db->insert('ratings', $rating)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function removeUp($newsId,$userId) {
            $condition = array(
                'newsId' => $newsId,
                'up' => '1',
                'ratedBy' => $userId
                );
            $this->db->where($condition);
            return $this->db->delete('ratings'); 
        }
        
        public function addDown($newsId,$userId) {
            $rating = array(
                'newsId' => $newsId,
                'ratedBy' => $userId,
                'down' => '1'
                );
            if($this->db->insert('ratings', $rating)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function removeDown($newsId,$userId) {
            $condition = array(
                'newsId' => $newsId,
                'down' => '1',
                'ratedBy' => $userId
                );
            $this->db->where($condition);
            return $this->db->delete('ratings');
        }
        
        public function addGood($newsId,$userId) {
            $rating = array(
                'newsId' => $newsId,
                'ratedBy' => $userId,
                'good' => '1'
                );
            if($this->db->insert('ratings', $rating)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function removeGood($newsId,$userId) {
            $condition = array(
                'newsId' => $newsId,
                'good' => '1',
                'ratedBy' => $userId
                );
            $this->db->where($condition);
            return $this->db->delete('ratings');
        }
        
        public function addBad($newsId,$userId) {
            $rating = array(
                'newsId' => $newsId,
                'ratedBy' => $userId,
                'bad' => '1'
                );
            if($this->db->insert('ratings', $rating)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function removeBad($newsId,$userId) {
            $condition = array(
                'newsId' => $newsId,
                'bad' => '1',
                'ratedBy' => $userId
                );
            $this->db->where($condition);
            return $this->db->delete('ratings');
        }
        
        public function getRatingsOfUser($userId,$newsId) {
            $condition = array(
                'ratedBy' => $userId,
                'newsId' => $newsId
                );
            $this->db->where($condition);
            $query = $this->db->get('ratings');
            return $query->result_array();
        }
        
        public function isAlreadyGood($userId,$newsId) {
            $condition = array(
                'ratedBy' => $userId,
                'newsId' => $newsId,
                'good' => '1'
                );
            $this->db->where($condition);
            $query = $this->db->get('ratings');
            return $query->row_array();
        }
        
        public function isAlreadyBad($userId,$newsId) {
            $condition = array(
                'ratedBy' => $userId,
                'newsId' => $newsId,
                'bad' => '1'
                );
            $this->db->where($condition);
            $query = $this->db->get('ratings');
            return $query->row_array();
        }
        
        public function isAlreadyUp($userId,$newsId) {
            $condition = array(
                'ratedBy' => $userId,
                'newsId' => $newsId,
                'up' => '1'
                );
            $this->db->where($condition);
            $query = $this->db->get('ratings');
            return $query->row_array();
        }
        
        public function isAlreadyDown($userId,$newsId) {
            $condition = array(
                'ratedBy' => $userId,
                'newsId' => $newsId,
                'down' => '1'
                );
            $this->db->where($condition);
            $query = $this->db->get('ratings');
            return $query->row_array();
        }
}