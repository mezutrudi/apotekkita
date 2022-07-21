<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	


	public function getrekomendasi($id = null)
	{
		if($id === null){
			
			$this->db->select('*');
			$this->db->from('tbl_rekomendasi');
			$this->db->order_by('tbl_rekomendasi.id_rekomendasi', 'Desc');
			$query = $this->db->get()->result_array();
			return $query;

		}else{

			$this->db->select('*');
			$this->db->from('tbl_rekomendasi');
			$this->db->order_by('tbl_rekomendasi.id_rekomendasi', 'Desc');
			$this->db->where('tbl_rekomendasi.id_rekomendasi', $id);
			$query = $this->db->get()->result_array();
			return $query;
			
		}
	}

	public function deleterekomendasi($id)
	{
		$this->db->delete('tbl_rekomendasi', ['id_rekomendasi' => $id]);
		return $this->db->affected_rows();
	}


	public function insertrekomendasi($data)
	{
		$this->db->insert('tbl_rekomendasi', $data);
		return $this->db->affected_rows();
	}

	public function updaterekomendasi($data, $id)
	{
		$this->db->update('tbl_rekomendasi', $data, ['id_rekomendasi' => $id]);
		return $this->db->affected_rows();
	}

	public function total()
    {
        $this->db->select('count(*) as j_rekomendasi');
		$this->db->from('tbl_rekomendasi');
		$query = $this->db->get()->row();
		return $query->j_rekomendasi;
    }

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */