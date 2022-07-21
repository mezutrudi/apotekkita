<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Obat_model', 'obat');
		$this->load->model('Jenis_model', 'jenis');
		$this->auth->cek();
		$this->load->helper('tgl_indo');
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Obat',
			'judul'			=> 'Master Data Obat',
			'data' 			=> $this->obat->getobat(),
			'jenis' 		=> 	$this->jenis->getjenis(),
			'content'		=> 'obat/v_content',
			'ajax'	 		=> 'obat/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_obat', 'Nama obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('id_jenis', 'Jenis obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('harga_obat', 'Harga obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('stok_obat', 'Stok obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('tanggal_expired', 'Tanggal Expired', 'required',
		array( 'required'  => '%s harus diisi!'));

		if ($this->form_validation->run()) 
		{

			$data = array(
				'nama_obat'			=> $this->input->post('nama_obat'),
				'id_jenis'			=> $this->input->post('id_jenis'),
				'harga_obat'		=> $this->input->post('harga_obat'),
				'stok_obat'			=> $this->input->post('stok_obat'),
				'tanggal_expired'	=> $this->input->post('tanggal_expired')
			);

			$q = $this->obat->insertobat($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('obat'),'refresh');

		}else{
			
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('obat'),'refresh');
		}

		
	}

	public function update()
	{
		$this->form_validation->set_rules('id_obat', 'Id Obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('nama_obat', 'Nama obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('id_jenis', 'Jenis obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('harga_obat', 'Harga obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('stok_obat', 'Stok obat', 'required',
		array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('tanggal_expired', 'Tanggal Expired', 'required',
		array( 'required'  => '%s harus diisi!'));

		if (!$this->form_validation->run()) 
		{
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('obat'),'refresh');
		}

		$id = $this->input->post('id_obat');

		$cek = $this->obat->getobat($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('obat'),'refresh');
		}else{

				$data = array(
					'nama_obat'			=> $this->input->post('nama_obat'),
					'id_jenis'			=> $this->input->post('id_jenis'),
					'harga_obat'		=> $this->input->post('harga_obat'),
					'stok_obat'			=> $this->input->post('stok_obat'),
					'tanggal_expired'	=> $this->input->post('tanggal_expired')
				);
			
				
			$this->obat->updateobat($data, $id);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('obat'),'refresh');
		}
	
	}

	public function delete($id)
	{
		$cek = $this->obat->getobat($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('obat'),'refresh');
		}else{
			
			$this->obat->deleteobat($id);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('obat'),'refresh');
		}
		

	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */