<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FilUpload_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    public function saveCriminalInfo($data) {
        $this->db->insert('criminal_info', $data);
        return $this->db->insert_id();   
    }

    public function getcriminalDetails($img_path)
    {
    	$query = $this->db->query("SELECT `name`,`criminal_id`,`crime`,`police_station`,`image_path` FROM `criminal_info` WHERE `image_path`='$img_path'");
    	//echo $this->db->last_query();die();
        return $query->result();
    }

    public function chk_criminalId($criminal_id)
    {
    	$query = $this->db->query("SELECT `name`,`criminal_id`,`crime`,`police_station`,`image_path` FROM `criminal_info` WHERE `criminal_id`='$criminal_id'");
    	//echo $this->db->last_query();die();
        return $query->result();
    }
}