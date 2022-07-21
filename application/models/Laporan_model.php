<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	


	public function getlaporan($id = null)
	{
		if($id === null){
			
			$this->db->select('*');
			$this->db->from('tbl_laporan');
			$this->db->order_by('tbl_laporan.id_laporan', 'Asc');
			$query = $this->db->get()->result_array();
			return $query;

		}else{

			$this->db->select('*');
			$this->db->from('tbl_laporan');
			$this->db->where('tbl_laporan.id_laporan', $id);
			$this->db->order_by('tbl_laporan.id_laporan', 'Asc');
			$query = $this->db->get()->result_array();
			return $query;
			
		}
	}

	public function carilaporan($tgl_awal,$tgl_akhir)
	{
			
		$this->db->select('*');
		$this->db->from('tbl_laporan');
		$this->db->where('tbl_laporan.tanggal_laporan >=',$tgl_awal);
		$this->db->where('tbl_laporan.tanggal_laporan <=',$tgl_akhir);
		$query = $this->db->get()->result_array();
		return $query;

	}

	public function deletelaporan($id)
	{
		$this->db->delete('tbl_laporan', ['id_laporan' => $id]);
		return $this->db->affected_rows();
	}


	public function insertlaporan($data)
	{
		$this->db->insert('tbl_laporan', $data);
		return $this->db->affected_rows();
	}

	public function updatelaporan($data, $id)
	{
		$this->db->update('tbl_laporan', $data, ['id_laporan' => $id]);
		return $this->db->affected_rows();
	}

	public function cek_urut_terkahir($tanggal)
	{
		$this->db->select('no_arsip');
		$this->db->from('tbl_laporan');
		$this->db->where('tanggal_laporan', $tanggal);
		$this->db->order_by('tbl_laporan.id_laporan', 'Desc');
		$query = $this->db->get();
		return $query;
	}

	public function total()
    {
        $this->db->select('count(*) as j_laporan');
		$this->db->from('tbl_laporan');
		$query = $this->db->get()->row();
		return $query->j_laporan;
    }

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */