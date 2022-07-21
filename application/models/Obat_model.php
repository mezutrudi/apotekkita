<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	


	public function getobat($id = null)
	{
		if($id === null){
			
			$this->db->select('*');
			$this->db->from('tbl_obat');
			$this->db->join('tbl_jenis','tbl_obat.id_jenis = tbl_jenis.id_jenis','inner');
			$this->db->order_by('tbl_obat.id_obat', 'Asc');
			$query = $this->db->get()->result_array();
			return $query;

		}else{

			$this->db->select('*');
			$this->db->from('tbl_obat');
			$this->db->join('tbl_jenis','tbl_obat.id_jenis = tbl_jenis.id_jenis','inner');
			$this->db->order_by('tbl_obat.id_obat', 'Asc');
			$this->db->where('tbl_obat.id_obat', $id);
			$query = $this->db->get()->result_array();
			return $query;
			
		}
	}

	public function deleteobat($id)
	{
		$this->db->delete('tbl_obat', ['id_obat' => $id]);
		return $this->db->affected_rows();
	}


	public function insertobat($data)
	{
		$this->db->insert('tbl_obat', $data);
		return $this->db->affected_rows();
	}

	public function updateobat($data, $id)
	{
		$this->db->update('tbl_obat', $data, ['id_obat' => $id]);
		return $this->db->affected_rows();
	}

	public function obatexpired($id_jenis,$tgl_awal,$tgl_akhir)
	{
			
		$this->db->select('*');
		$this->db->from('tbl_obat');
		$this->db->join('tbl_jenis','tbl_obat.id_jenis = tbl_jenis.id_jenis','inner');
		$this->db->where('tbl_obat.id_jenis', $id_jenis);
		$this->db->where('tbl_obat.tanggal_expired >=',$tgl_awal);
		$this->db->where('tbl_obat.tanggal_expired <=',$tgl_akhir);
		$query = $this->db->get()->result_array();
		return $query;

	}

	public function total()
    {
        $this->db->select('count(id_obat) as j_obat');
		$this->db->from('tbl_obat');
		$query = $this->db->get()->row();
		return $query->j_obat;
    }
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */