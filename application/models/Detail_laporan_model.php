<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_laporan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	


	public function getdetail_laporan($id = null)
	{
		if($id === null){
			
			$this->db->select('*');
			$this->db->from('tbl_detail_laporan');
			$this->db->join('tbl_obat','tbl_detail_laporan.id_obat = tbl_obat.id_obat','inner');
			$this->db->join('tbl_jenis','tbl_obat.id_jenis = tbl_jenis.id_jenis','inner');
			$this->db->order_by('tbl_detail_laporan.id_detail_laporan', 'Asc');
			$query = $this->db->get()->result_array();
			return $query;

		}else{

			$this->db->select('*');
			$this->db->from('tbl_detail_laporan');
			$this->db->join('tbl_obat','tbl_detail_laporan.id_obat = tbl_obat.id_obat','inner');
			$this->db->join('tbl_jenis','tbl_obat.id_jenis = tbl_jenis.id_jenis','inner');
			$this->db->where('tbl_detail_laporan.no_arsip', $id);
			$this->db->order_by('tbl_detail_laporan.id_detail_laporan', 'Asc');
			$query = $this->db->get()->result_array();
			return $query;
			
		}
	}

	public function deletedetail_laporan($id)
	{
		$this->db->delete('tbl_detail_laporan', ['id_detail_laporan' => $id]);
		return $this->db->affected_rows();
	}


	public function insertdetail_laporan($data)
	{
		$this->db->insert('tbl_detail_laporan', $data);
		return $this->db->affected_rows();
	}

	public function updatedetail_laporan($data, $id)
	{
		$this->db->update('tbl_detail_laporan', $data, ['id_detail_laporan' => $id]);
		return $this->db->affected_rows();
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */