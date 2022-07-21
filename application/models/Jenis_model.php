<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	


	public function getjenis($id = null)
	{
		if($id === null){
			
			$this->db->select('*');
			$this->db->from('tbl_jenis');
			$this->db->order_by('tbl_jenis.id_jenis', 'Asc');
			$query = $this->db->get()->result_array();
			return $query;

		}else{

			$this->db->select('*');
			$this->db->from('tbl_jenis');
			$this->db->order_by('tbl_jenis.id_jenis', 'Asc');
			$this->db->where('tbl_jenis.id_jenis', $id);
			$query = $this->db->get()->result_array();
			return $query;
			
		}
	}

	public function deletejenis($id)
	{
		$this->db->delete('tbl_jenis', ['id_jenis' => $id]);
		return $this->db->affected_rows();
	}


	public function insertjenis($data)
	{
		$this->db->insert('tbl_jenis', $data);
		return $this->db->affected_rows();
	}

	public function updatejenis($data, $id)
	{
		$this->db->update('tbl_jenis', $data, ['id_jenis' => $id]);
		return $this->db->affected_rows();
	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */