<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function save_category($data)
    {
        return $this->db->insert('category', $data);
    }

    public function get_categories()
    {
        $data = $this->db->get('category')->result();
        return $data;
    }

    public function fetch_category($id)
    {
        $data = $this->db->where('c_auto_id', $id)->get('category')->row();
        return $data;
    }


    public function update_category($hid_id, $data)
    {
        // echo $hid_id; die;
        return $this->db->where('c_auto_id', $hid_id)->update('category', $data);
    }

    public function delete_category($id){
       return $this->db->where('c_auto_id', $id)->delete('category');
    }
}
?>