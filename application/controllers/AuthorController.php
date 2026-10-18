<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthorController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->user_id) {
            redirect('Login');
        }

        $this->load->model('AuthorModel');
    }


    public function index()
    {
        $this->load->view('Admin/author');
    }

    public function save_author()
    {
        $author = $this->input->post('author');
        $user_id = $this->session->user_id;

        if (!empty($author)) {
            $data = array(
                'a_author_name' => $author,
                'a_updated_by' => $user_id
            );

            $result = $this->AuthorModel->save_author($data);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Author added successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Try again.']);
            }

        } else {
            echo json_encode(['status' => 'warning', 'message' => 'Author field is required.']);
        }
    }


    public function get_author()
    {
        $result = $this->AuthorModel->get_author();

        $i = 0;

        foreach ($result as $value) {
            $i++;
            $btn = '<button type="button" class="btn btn-success" onclick=edit_auth(' . $value->a_auto_id . ')> <i class="fa-solid fa-pen-to-square"></i> </button>
                    <button type="button" class="btn btn-danger" onclick=delete_auth(' . $value->a_auto_id . ')> <i class="fa-solid fa-trash"></i> </button>';
            $data[] = array(
                $i,
                $value->a_author_name,
                $btn
            );
        }

        $output = array(
            'data' => $data
        );

        echo json_encode($output);
    }



    public function edit_auth()
    {
        $id = $this->input->post('id');

        $result = $this->AuthorModel->fetch_author($id);
        // print_r($result); die;

        echo json_encode($result);

    }

    public function update_author()
    {
        $edit_author = $this->input->post('edit_author');
        $hid_id = $this->input->post('hid_id');

        $data = array(
            'a_author_name' => $edit_author,
        );

        $result = $this->AuthorModel->update_author($hid_id, $data);
        // print_r($result); die;
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Author Updates successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Try again.']);
        }
    }


    public function delete_author()
    {
        $id = $this->input->post('id');

        $result = $this->AuthorModel->delete_author($id);
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Author deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete author.'
            ]);
        }
    }

}
