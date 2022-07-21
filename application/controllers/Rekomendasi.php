<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rekomendasi_model', 'rekomendasi');
		$this->auth->cek();
		$this->load->helper('tgl_indo');
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Rekomendasi Obat',
			'judul'			=> 'Data Rekomendasi Obat',
			'data'	 		=> 	$this->rekomendasi->getrekomendasi(),
			'content'		=> 'rekomendasi/v_content',
			'ajax'	 		=> 'rekomendasi/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_rekomendasi', 'Nama obat', 'required',
		array( 'required'  => '%s harus diisi!'));

		if ($this->form_validation->run()) 
		{

			$data = array(
				'nama_rekomendasi'	=> $this->input->post('nama_rekomendasi')
			);

			$q = $this->rekomendasi->insertrekomendasi($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('rekomendasi'),'refresh');

		}else{
			
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('rekomendasi'),'refresh');
		}

		
	}

	public function update()
	{
		$this->form_validation->set_rules('id_rekomendasi', 'Id rekomendasi', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('nama_rekomendasi', 'rekomendasi Obat', 'required',
		array( 'required'  => '%s harus diisi!'));

		if (!$this->form_validation->run()) 
		{
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('rekomendasi'),'refresh');
		}

		$id = $this->input->post('id_rekomendasi');

		$cek = $this->rekomendasi->getrekomendasi($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('rekomendasi'),'refresh');
		}else{

				$data = array(
					'nama_rekomendasi'			=> $this->input->post('nama_rekomendasi')
				);
			
				
			$this->rekomendasi->updaterekomendasi($data, $id);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('rekomendasi'),'refresh');
		}
	
	}

	public function delete($id)
	{
		$cek = $this->rekomendasi->getrekomendasi($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('rekomendasi'),'refresh');
		}else{
			
			$this->rekomendasi->deleterekomendasi($id);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('rekomendasi'),'refresh');
		}
		

	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */