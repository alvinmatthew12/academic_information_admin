<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infoakademik extends CI_Controller {

	function __construct() {
		parent:: __construct();

		$this->load->model("infoakademik_model");
	}

	public function index() {
		if ($this->session->userdata('username')) {
			
		} else {
			redirect(base_url('login'));
		}
		$data["infoakademik"] = $this->infoakademik_model->getAll();
		$this->load->view('header');
		$this->load->view('infoakademik/list', $data);
		$this->load->view('footer');
	}

	public function detail($id) {
		if ($this->session->userdata('username')) {
			
		} else {
			redirect(base_url('login'));
		}
		$data["infoakademik"] = $this->infoakademik_model->getById($id);
		$this->load->view('header');
		$this->load->view('infoakademik/detail', $data);
		$this->load->view('footer');
	}

	public function add() {
		if ($this->session->userdata('username')) {
			
		} else {
			redirect(base_url('login'));
		}
		$infoakademik = $this->infoakademik_model;
		$validation = $this->form_validation; 

		if ($this->input->post()) {
			$post = $this->input->post();
			$judul = $this->judul = $post["judul"];
			$isi = $this->isi = $post["isi"];
			$tipe = $this->tipe = $post["tipe"];

			$data = array(
				'pmTppmrId' => $tipe,
				'pmTanggal' => date("Y/m/d"),
				'pmJudul' => $judul,
				'pmIsi' => $isi,
				'pmImagePath' => '',
				'pmImageAlt' => ''
			);

			// $data = array(
			// 	'judul' => $judul,
			// 	'tanggal' => date("Y/m/d"),
			// 	'isi' => $isi
			// );

	        $infoakademik->publish($data);
	        $this->session->set_flashdata('success', 'Informasi berhasil dipublikasi');

	        // $isi_conv =  strip_tags($isi);
	        // str_replace("&nbsp;", " ", $isi_conv);

	        $getTipe = $infoakademik->getTipe($tipe);
	        foreach ($getTipe->result() as $type) {
	        	$namaTipe = $type->tppmrNama;
	        	$this->send_notif($namaTipe, $judul);
	        }

		}

		$this->load->view('header');
		$this->load->view('infoakademik/add');
		$this->load->view('footer');

	}

	public function edit($id = null) {
		if ($this->session->userdata('username')) {} 
		else {
			redirect(base_url('login'));
		}
		if (!isset($id)) {
			redirect(base_url('infoakademik'));
		}

		$infoakademik = $this->infoakademik_model;

		if ($this->input->post()) {
			$post = $this->input->post();
			$judul = $this->judul = $post["judul"];
			$isi = $this->isi = $post["isi"];
			$tipe = $this->tipe = $post["tipe"];

			$data = array(
				'pmTppmrId' => $tipe,
				'pmTanggal' => date("Y/m/d"),
				'pmJudul' => $judul,
				'pmIsi' => $isi,
				'pmImagePath' => '',
				'pmImageAlt' => ''
			);

			$infoakademik->updateInfo($id, $data);
	        $this->session->set_flashdata('edit', 'Informasi berhasil diperbaharui');
			redirect(base_url('infoakademik'));
		}

		$data["infoakademik"] = $this->infoakademik_model->getById($id);
		$this->load->view('header');
		$this->load->view('infoakademik/edit', $data);
		$this->load->view('footer');
	}

	public function save_token() {
		$npm = $this->post('npm');
		$token = $this->post('token');
		$data=array(
			'tusrSignature' => $token,
		);
		$this->infoakademik_model->update($npm,$data);
	}

	public function send_notif($tipe, $judul) {
		if ($this->session->userdata('username')) {
			
		} else {
			redirect(base_url('login'));
		}
		$token[] = array();

		$devicelist = $this->infoakademik_model->getToken();
		foreach ($devicelist->result() as $list) 
		{
			array_push(
			$token,$list->tusrSignature);
		}

		// Server key from Firebase Console
		define( 'API_ACCESS_KEY', 'AAAAp17jXpo:APA91bEF2vkEMD6h8-T2jqT8QpuZ2cYegF1wHOqJPDfPcvBmpyL5GgVyyH6azlZ7OJ4IrNcnKQaD6LPjbi1RpOfkljkIHc__OM-l9yAYjzmLMUalQhcz7vFq62wzdSu9xLqhASJ0kauX' );

		$data = array(
					"to" => "/topics/students",
					"registration_tokens" => $token,
		            "notification" => array( 
		              	"title" => $tipe, 
		              	"body" => $judul,
		              	"icon" => "drawable-xhdpi-icon.png",
					    "sound" => "default",
					    "click_action" => "FCM_PLUGIN_ACTIVITY"
		              	),
		          	"data" => array(
		              		"landing_page" => "info-akademik"
		              	)
		        );

		$data_string = json_encode($data); 

		echo "The Json Data : ".$data_string; 

		$headers = array
		(
		     'Authorization: key=' . API_ACCESS_KEY, 
		     'Content-Type: application/json'
		);                                                                                 
		                                                                                                                     
		$ch = curl_init();  

		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
		curl_setopt( $ch,CURLOPT_POST, true );  
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
		                                                                                                                     
		$result = curl_exec($ch);

		curl_close ($ch);

		echo "<p>&nbsp;</p>";
		echo "The Result : ".$result;

        $this->session->set_flashdata('success', 'Informasi berhasil dipublikasi');
		redirect(base_url('infoakademik'));
	}

	public function delete($id) {
		if ($this->session->userdata('username')) {
			
		} else {
			redirect(base_url('login'));
		}
		if (!isset($id)) show_404(); 

		if ($this->infoakademik_model->delete($id)) {
	        $this->session->set_flashdata('delete', 'Informasi berhasil dihapus');
			redirect(base_url('infoakademik'));
		}
	}

	public function logout(){
		if ($this->session->userdata('username')) {
			
		} else {
			redirect(base_url('login'));
		}
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

}