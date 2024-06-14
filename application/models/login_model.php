<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    public function is_valid_user($username, $password){
        $query = $this->db->query("select username,password from user_log
                where username ='".$username."' AND password ='".$password."'");
            return $query->row();

    }
    public function getUsernamePassword($email_id)
    {
         $query = $this->db->query("select a_id,username,password,role_id from admin_panel 
                where email_id='".$email_id."'");
            return $query->row();
    }
    
    public function ResetPassword($oldpass,$role_id,$data)
    {
        $query=$this->db->query("select * from admin_panel where password='".$oldpass."' AND role_id='".$role_id."'");
        if ($query->num_rows() > 0) {  
            
            $this->db->where('password',$oldpass);
            $this->db->update('admin_panel',$data);
            return true;
        }
        return false;
            
    }

}
