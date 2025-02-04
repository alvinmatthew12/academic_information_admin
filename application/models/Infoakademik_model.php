<?php 
	defined('BASEPATH') OR exit ('No direct script access allowed');

	class Infoakademik_model extends CI_Model
	{
		
		private $_table = "t_pengumuman";
		// private $_table = "tb_infoakademik";
		
		public function getAll() {
			$dbportal = $this->load->database('portal',TRUE);
			// return $this->db->get($this->_table)->result();
			$dbportal->from($this->_table);
			$dbportal->join('t_tipe_pengumuman_ref', ''.$this->_table.'.pmTppmrId = t_tipe_pengumuman_ref.tppmrId');
			$dbportal->order_by("pmId", "desc");
			$query = $dbportal->get(); 
			return $query->result();
		}

		public function getById($id) {
			$dbportal = $this->load->database('portal',TRUE);
			// return $this->db->get($this->_table)->result();
			$dbportal->from($this->_table);
			$dbportal->where("pmId", $id);
			$dbportal->join('t_tipe_pengumuman_ref', ''.$this->_table.'.pmTppmrId = t_tipe_pengumuman_ref.tppmrId');
			$dbportal->order_by("pmId", "desc");
			$query = $dbportal->get(); 
			return $query->result();
		}

		public function getTipe($id) {
			$dbportal = $this->load->database('portal',TRUE);
			$dbportal->select('tppmrNama');
			$dbportal->from('t_tipe_pengumuman_ref');
			$dbportal->where("tppmrId", $id);
			return $dbportal->get();
		}

		public function getToken()
		{
			$dbportal = $this->load->database('portal',TRUE);
			$dbportal->from('t_user');
			$dbportal->where("tusrSignature IS NOT NULL", NULL);
			$dbportal->where("tusrSignature != ","");
			return $dbportal->get();
		}

		public function update($id,$data)
		{
			$dbportal = $this->load->database('portal',TRUE);
			$dbportal->where('tusrNama', $id);
			return $dbportal->update('t_user', $data);
		}

		public function publish($data) {
			$dbportal = $this->load->database('portal',TRUE);
			$dbportal->insert($this->_table, $data);
			$insert_id = $dbportal->insert_id();
			$data1 = array('tjpmThakrid' => 1,'tjpmlPmId' => $insert_id);

			$data2 = array (
						array('fpmlFakId' => 1,'fpmlPmId' => $insert_id),
						array('fpmlFakId' => 2,'fpmlPmId' => $insert_id),
						array('fpmlFakId' => 3,'fpmlPmId' => $insert_id),
						array('fpmlFakId' => 4,'fpmlPmId' => $insert_id),
						array('fpmlFakId' => 5,'fpmlPmId' => $insert_id),
						array('fpmlFakId' => 6,'fpmlPmId' => $insert_id)
				);

			$dbportal->insert("t_tujuan_pengumuman_link", $data1);
			return $dbportal->insert_batch("t_fakultas_pengumuman_link", $data2);
		}

		public function updateInfo($id, $data) {
			$dbportal = $this->load->database('portal',TRUE);
			$dbportal->where('pmId', $id);
			return $dbportal->update($this->_table, $data);
		}

		public function delete($id) {
			$dbportal = $this->load->database('portal',TRUE);
			return $dbportal->delete($this->_table, array("pmId" => $id));
		}
	}
 ?>