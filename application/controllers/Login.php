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

	public function proses() {
		// $this->form_validation->set_rules('username','username','required|trim|xss_clean');
		// $this->form_validation->set_rules('password','password','required|trim|xss_clean');

		// if ($this->form_validation->run() == FALSE) {
		// 	$this->load->view('login');
		// 	$this->load->view('footer');
		// } else {
		// 	$username = $this->input->post('username');
		// 	$password = $this->input->post('password');

		// 	if ($username == "admin" && $password == "admin") {
		// 		$sess_data['username'] = "admin";
		// 		$sess_data['nama'] = "Admin";
		// 		$sess_data['level'] = "Admin";
		// 		$this->session->set_userdata($sess_data);

		// 		redirect(base_url('infoakademik'));
		// 	} else {
		// 		$this->session->set_flashdata('failed_login', 'Username atau Password Salah');
		// 		redirect(base_url('login'));
		// 	}
		// }

		// Melakukan validasi input username dan password
		$this->form_validation->set_rules('username', 'username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');
		// Jika validasi input username dan password bernilai false 
		// maka user/admin diminta melakukan input ulang
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('login'); // Menampilkan halaman utama login
			$this->load->view('footer');
		} 
		// Jika validasi input username dan password bernilai false 
		// maka user/admin diminta melakukan input ulang
		else 
		{
			// Input username dan password dengan fungsi POST 
			$username = $this->input->post('username')."@uib.ac.id";
			$password = $this->input->post('password');

			$ldapconn = ldap_connect("uib.ac.id"); // jika gagal akan mereturn value FALSE  

			if ($ldapconn) 
			{  
				// menyatukan aplikasi dengan server LDAP  
				$ldapbind = @ldap_bind($ldapconn, $username, $password);  
				// verify binding  
				if ($ldapbind) 
				{  
					if ($username == "nafisatul@uib.ac.id" || $username == "wahyudi@uib.ac.id" || $username == "viona@uib.ac.id" || $username == "hadianto@uib.ac.id" || $username == "fauzan@uib.ac.id" || $username == "herman@uib.ac.id" || $username == "alvin@uib.ac.id")
					{
						$sess_data['username'] = $username;
						$sess_data['nama'] =  $this->input->post('username');
						$sess_data['level'] = "Admin";
						$this->session->set_userdata($sess_data);
						redirect(base_url('infoakademik'));
					}
					else
					{
						$this->session->set_flashdata('result_login', 'User berhasil diregistrasi, mohon menunggu admin untuk validasi.');
						redirect(base_url('login'));
					}
				} 
				else 
				{  
					$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
					redirect(base_url('login'));
				}  
			}
			else
			{  
				$this->session->set_flashdata('result_login', 'Terjadi masalah pada server.');
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
