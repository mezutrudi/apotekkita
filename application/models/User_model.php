<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function getuser($id = null)
	{
		if($id === null){
			
			return $this->db->get('tbl_user')->result_array();
		}else{
			return $this->db->get_where('tbl_user', ['id_user' => $id])->result_array();
		}
	}

	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $query = $this->db->get();
	}

	
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */