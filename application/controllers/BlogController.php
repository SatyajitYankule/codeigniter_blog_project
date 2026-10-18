<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BlogController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->user_id) {
            redirect('Login');
        }

        $this->load->model('BlogModel');
    }


    public function index()
    {
        $this->load->view('Admin/blog_page');
    }



    public function add_blog()
    {
        $data['category'] = $this->db->get('category')->result();
        $data['author'] = $this->db->get('author')->result();
        $this->load->view('Admin/add_blog', $data);
    }




    public function insert_blog()
    {
        $category = $this->input->post('category');
        $author = $this->input->post('author');
        $add_title = $this->input->post('add_title');
        $short_content = $this->input->post('short_content');
        $main_content = $this->input->post('main_content');
        $meta_title = $this->input->post('meta_title');
        $meta_description = $this->input->post('meta_description');
        $meta_keywords = $this->input->post('meta_keywords');
        $user_id = $this->session->user_id;

        // echo $category;
        // echo $author;
        // echo $short_content;
        // echo $main_content;
        //  die;

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];
            // print_r($config); die;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                return;
            } else {
                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $upload_data['file_name'];
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Image is required']);
            return;
        }

        $data = array(
            'b_cat_ref_id' => $category,
            'b_auth_ref_id' => $author,
            'b_title' => $add_title,
            'b_short_content' => $short_content,
            'b_main_content' => $main_content,
            'b_meta_title' => $meta_title,
            'b_meta_description' => $meta_description,
            'b_meta_keywords' => $meta_keywords,
            'b_image' => $image_path,
            'b_updated_by' => $user_id
        );

        $insert = $this->BlogModel->insert_blog($data);

        if ($insert) {
            echo json_encode(['status' => 'success', 'message' => 'Blog added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert blog']);
        }
    }



    public function get_blogs()
    {
        $result = $this->BlogModel->get_all_blogs();

        // print_r($result); die;

        $i = 0;
        foreach ($result as $value) {

            $i++;

            $cat_sql = $this->db->select('c_category')
                ->from('category')
                ->where('c_auto_id', $value->b_cat_ref_id)
                ->get()->row();
            $category_data = $cat_sql ? $cat_sql->c_category : 'N/A';



            $auth_sql = $this->db->select('a_author_name')
                ->from('author')
                ->where('a_auto_id', $value->b_auth_ref_id)
                ->get()->row();
            $author_data = $auth_sql ? $auth_sql->a_author_name : 'N/A';

            // echo "<pre>"; print_r($category_data); die;

            $image = '<img src="' . base_url($value->b_image) . '" width="80" height="60">';




            $btn = '
                <div class="d-flex gap-2">
                    <a href="' . base_url('BlogController/edit_blog/' . $value->b_auto_id) . '" class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <button type="button" class="btn btn-danger" onclick="delete_blog(' . $value->b_auto_id . ')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    </div>';


            $date = date('F j, Y', strtotime($value->b_cretated_at));
            $data[] = array(
                $i,
                $image,
                $value->b_title,
                $category_data,
                $author_data,
                // $value->b_short_content,
                $date,
                $btn
            );
        }

        $output = array(
            'data' => $data
        );

        echo json_encode($output);
    }



    public function edit_blog($id)
    {
        $data['edit_data'] = $this->db->where('b_auto_id', $id)->get('blogs')->row();
        $data['category'] = $this->db->get('category')->result();
        $data['author'] = $this->db->get('author')->result();
        // echo "<pre>"; print_r($data); die;

        $this->load->view('Admin/edit_blog', $data);

    }





    public function update_blog()
    {
        $blog_id = $this->input->post('blog_id');
        $category = $this->input->post('category');
        $author = $this->input->post('author');
        $add_title = $this->input->post('add_title');
        $short_content = $this->input->post('short_content');
        $main_content = $this->input->post('main_content');
        $meta_title = $this->input->post('meta_title');
        $meta_description = $this->input->post('meta_description');
        $meta_keywords = $this->input->post('meta_keywords');
        $old_image = $this->input->post('old_image');

        $image_path = $old_image;

        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                return;
            } else {
                $upload_data = $this->upload->data();
                $new_image_path = 'uploads/' . $upload_data['file_name'];
                $image_path = $new_image_path;

                if (!empty($old_image) && $new_image_path !== $old_image) {
                    $old_image_full_path = FCPATH . $old_image;

                    if (file_exists($old_image_full_path) && is_file($old_image_full_path)) {
                        unlink($old_image_full_path);
                    }
                }
            }
        }

        $data = [
            'b_cat_ref_id' => $category,
            'b_auth_ref_id' => $author,
            'b_title' => $add_title,
            'b_short_content' => $short_content,
            'b_main_content' => $main_content,
            'b_meta_title' => $meta_title,
            'b_meta_description' => $meta_description,
            'b_meta_keywords' => $meta_keywords,
            'b_image' => $image_path,
        ];

        $this->db->where('b_auto_id', $blog_id);
        $update = $this->db->update('blogs', $data);

        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Blog updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update blog']);
        }
    }




    public function delete_blog()
    {
        $id = $this->input->post('id');

        // echo $id; die;

        $result = $this->BlogModel->delete_blog($id);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Blog deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete author.'
            ]);
        }
    }

}
