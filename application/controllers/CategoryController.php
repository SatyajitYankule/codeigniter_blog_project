<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->user_id) {
            redirect('Login');
        }

        $this->load->model('CategoryModel');
    }


    public function index()
    {
        $this->load->view('Admin/category');
    }

    public function save_category()
    {
        $category = $this->input->post('category');
        $user_id = $this->session->user_id;

        if (!empty($category)) {
            $data = array(
                'c_category' => $category,
                'c_updated_by' => $user_id
            );

            $result = $this->CategoryModel->save_category($data);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Category added successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Try again.']);
            }

        } else {
            echo json_encode(['status' => 'warning', 'message' => 'Category field is required.']);
        }
    }


    public function get_categories()
    {
        $result = $this->CategoryModel->get_categories();
        // print_r($result);

        $i = 0;

        foreach ($result as $value) {
            $i++;
            $btn = '<button type="button" class="btn btn-success" onclick=edit_cat(' . $value->c_auto_id . ')> <i class="fa-solid fa-pen-to-square"></i> </button>
                    <button type="button" class="btn btn-danger" onclick=delete_cat(' . $value->c_auto_id . ')> <i class="fa-solid fa-trash"></i> </button>';
            // $btn = '<button class="btn btn-success"> Edit </button>';
            $data[] = array(
                $i,
                $value->c_category,
                $btn
            );
        }

        $output = array(
            'data' => $data
        );

        echo json_encode($output);
    }



    public function edit_cate()
    {
        $id = $this->input->post('id');

        $result = $this->CategoryModel->fetch_category($id);
        // print_r($result); die;

        echo json_encode($result);

    }

    public function update_category()
    {
        $edit_category = $this->input->post('edit_category');
        $hid_id = $this->input->post('hid_id');

        $data = array(
            'c_category' => $edit_category,
        );

        $result = $this->CategoryModel->update_category($hid_id, $data);
        // print_r($result); die;
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Category Updates successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Try again.']);
        }
    }


    public function delete_category()
    {
        $id = $this->input->post('id');

        $result = $this->CategoryModel->delete_category($id);
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Category deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete category.'
            ]);
        }
    }

}
