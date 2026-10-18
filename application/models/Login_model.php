<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function login_data($username, $password)
    {
        $query = $this->db->where('l_username', $username)->where('l_password', $password)->get('login');

        if($query->num_rows() ==1){
            $users = $query->row();
            return $users;
        }
    }
}
?>