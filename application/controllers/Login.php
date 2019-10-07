<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent:: __construct();
	}

	public function process() {
		$this->form_validation->set_rules('username','username','required|trim|xss_clean');
		$this->form_validation->set_rules('password','password','required|trim|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
			$this->load->view('footer');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($username == "admin" && $password == "admin") {
				$sess_data['username'] = "admin";
				$sess_data['nama'] = "Admin";
				$sess_data['level'] = "Admin";
				$this->session->set_userdata($sess_data);

				redirect(base_url('infoakademik'));
			} else {
				$this->session->set_flashdata('failed_login', 'Username atau Password Salah');
				redirect(base_url('login'));
			}
		}
	}

	public function index()
	{
		$this->load->view('login');
		$this->load->view('footer');
	}
}
