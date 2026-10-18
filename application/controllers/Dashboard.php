	<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Dashboard extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

            if(!$this->session->user_id){
                redirect('Login');
            }
		}


		public function index()
		{
			$this->load->view('Admin/dashboard');
		}

	}
