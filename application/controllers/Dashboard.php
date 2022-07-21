<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		$this->load->model('Obat_model', 'obat');
		$this->load->model('Laporan_model', 'laporan');
		$this->load->model('Rekomendasi_model', 'rekomendasi');
		$this->auth->cek();
		$this->load->helper('tgl_indo');
	}

	public function index()
	{
		$tglsekarang = date('Y-m-d');

			$data = array(
				'title'					=> $this->session->userdata('level').' - Dashboard',
				'total_obat'			=> $this->obat->total(),
				'total_laporan'			=> $this->laporan->total(),
				'total_rekomendasi'		=> $this->rekomendasi->total(),
				'user'					=> $this->session->userdata('nama'),
				'content'	 			=> 'dashboard/v_content',
				'ajax'	 				=> 'dashboard/v_ajax'
			);

		
		
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	

}

/* End of file Guru.php */
/* Location: ./application/controllers/user/Guru.php */