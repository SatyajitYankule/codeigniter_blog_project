<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogModel extends CI_Model
{
    public function insert_blog($data)
    {
        return $this->db->insert('blogs', $data); 
    }

    public function get_all_blogs()
    {
        return $this->db->get('blogs')->result();
    }

   
    public function delete_blog($id)
    {
        return $this->db->where('b_auto_id', $id)->delete('blogs'); 
    }
}
