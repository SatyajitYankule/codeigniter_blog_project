<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}


	public function index()
	{
		$this->load->view('Admin/login');
	}



	public function login()
	{

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');


		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Admin/login');
		} else {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$result = $this->Login_model->login_data($username, $password);

			if ($result) {
				$this->session->set_userdata('user_id', $result->l_auto_id);
				$this->session->set_userdata('username', $result->l_username);
				redirect('Dashboard');
				// $this->load->view('Admin/dashboard');
			} else {
				$this->session->set_flashdata('error', 'Invalid credentials');
				redirect('login');
			}

		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy(); 

		redirect('login');
	}
}
