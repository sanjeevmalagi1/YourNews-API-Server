<?php

class Users_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function AddUser($identifier,$country) {
            $UserInfo = array(
                'identifier' => $identifier,
                'country' => $country
                );
            $this->db->insert('users', $UserInfo);
            $insert_id = $this->db->insert_id();

            return  $insert_id;
        }
}