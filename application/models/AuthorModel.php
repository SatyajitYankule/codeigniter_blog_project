<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthorModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function save_author($data)
    {
        return $this->db->insert('author', $data);
    }

    public function get_author()
    {
        $data = $this->db->get('author')->result();
        return $data;
    }

    public function fetch_author($id)
    {
        $data = $this->db->where('a_auto_id', $id)->get('author')->row();
        return $data;
    }


    public function update_author($hid_id, $data)
    {
        // echo $hid_id; die;
        return $this->db->where('a_auto_id', $hid_id)->update('author', $data);
    }

    public function delete_author($id){
       return $this->db->where('a_auto_id', $id)->delete('author');
    }
}
?>