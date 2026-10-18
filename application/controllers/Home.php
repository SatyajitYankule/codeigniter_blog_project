<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->user_id) {
            redirect('Login');
        }

    }



    public function index()
    {
        $this->db->select('blogs.*, category.c_category as category_name, author.a_author_name as author_name');
        $this->db->from('blogs');
        $this->db->join('category', 'category.c_auto_id = blogs.b_cat_ref_id', 'left');
        $this->db->join('author', 'author.a_auto_id = blogs.b_auth_ref_id', 'left');
        $this->db->order_by('b_cretated_at', 'DESC'); // newest first
        $data['blogs'] = $this->db->get()->result();

        if (!empty($data['blogs'])) {
            $data['meta'] = [
                'title' => $data['blogs'][0]->b_meta_title ?? 'Latest Blog Posts',
                'description' => $data['blogs'][0]->b_meta_description ?? 'Check out our latest blogs',
                'keywords' => $data['blogs'][0]->b_meta_keywords ?? 'blog, articles, posts',
            ];
        } else {
            $data['meta'] = [
                'title' => 'Latest Blog Posts',
                'description' => 'Read the latest blog posts on various topics.',
                'keywords' => 'blog, articles, news',
            ];
        }

        $this->load->view('index', $data);
    }



    public function show_blog_page($id)
    {
        $data['blog'] = $this->db->select('blogs.*, category.c_category as category_name, author.a_author_name as author_name')
            ->from('blogs')
            ->join('category', 'category.c_auto_id = blogs.b_cat_ref_id', 'left')
            ->join('author', 'author.a_auto_id = blogs.b_auth_ref_id', 'left')
            ->where('blogs.b_auto_id', $id)
            ->get()->row();

        if (!$data['blog']) {
            show_404();
            return;
        }

        $data['recent_blogs'] = $this->db->select('b_auto_id, b_short_content, b_title')
            ->from('blogs')
            ->where('b_auto_id !=', $id)
            ->order_by('b_cretated_at', 'DESC')
            ->limit(6)
            ->get()->result();

        $this->load->view('show_blog', $data);
    }

}

?>