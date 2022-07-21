<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jenis_model', 'jenis');
		$this->auth->cek();
		$this->load->helper('tgl_indo');
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Jenis Obat',
			'judul'			=> 'Master Data Jenis Obat',
			'data'	 		=> 	$this->jenis->getjenis(),
			'content'		=> 'jenis/v_content',
			'ajax'	 		=> 'jenis/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_jenis', 'Nama obat', 'required',
		array( 'required'  => '%s harus diisi!'));

		if ($this->form_validation->run()) 
		{

			$data = array(
				'nama_jenis'	=> $this->input->post('nama_jenis')
			);

			$q = $this->jenis->insertjenis($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('jenis'),'refresh');

		}else{
			
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('jenis'),'refresh');
		}

		
	}

	public function update()
	{
		$this->form_validation->set_rules('id_jenis', 'Id Jenis', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('nama_jenis', 'Jenis Obat', 'required',
		array( 'required'  => '%s harus diisi!'));

		if (!$this->form_validation->run()) 
		{
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('jenis'),'refresh');
		}

		$id = $this->input->post('id_jenis');

		$cek = $this->jenis->getjenis($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('jenis'),'refresh');
		}else{

				$data = array(
					'nama_jenis'			=> $this->input->post('nama_jenis')
				);
			
				
			$this->jenis->updatejenis($data, $id);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('jenis'),'refresh');
		}
	
	}

	public function delete($id)
	{
		$cek = $this->jenis->getjenis($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('jenis'),'refresh');
		}else{
			
			$this->jenis->deletejenis($id);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('jenis'),'refresh');
		}
		

	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */