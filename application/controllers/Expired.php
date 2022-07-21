<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expired extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Obat_model', 'obat');
		$this->load->model('Jenis_model', 'jenis');
		$this->load->model('Laporan_model', 'laporan');
		$this->load->model('Detail_laporan_model', 'detail_laporan');
		$this->auth->cek();
		$this->load->helper('tgl_indo');
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Data Obat Expired',
			'judul'			=> 'Data Obat Expired',
			'data' 			=> $this->obat->getobat(),
			'jenis' 		=> 	$this->jenis->getjenis(),
			'content'		=> 'expired/v_content',
			'ajax'	 		=> 'expired/v_ajax'
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

	public function laporan()
	{
		$id_jenis 	= $this->input->post('id_jenis');
		$tgl_awal 	= $this->input->post('tgl_awal');
		$tgl_akhir 	= $this->input->post('tgl_akhir');

		$cek_expired = $this->obat->obatexpired($id_jenis,$tgl_awal,$tgl_akhir);
		if($cek_expired){

			$tanggal = date('Y-m-d');
			$tanggal1 = date('Ymd');
			$dariDB = $this->laporan->cek_urut_terkahir($tanggal)->row_array();
			$nourut = substr($dariDB['no_arsip'], 14, 3);
			$urut = $nourut + 1;
			$kode_baru = 'TRE-'.$tanggal1.'-'.sprintf("%03s", $urut);
	
			$data = array(
				'no_arsip'			=> $kode_baru,
				'tanggal_laporan'	=> $tanggal
			);
	
			$q = $this->laporan->insertlaporan($data);
	
			echo "
			<div class='x_panel'>
	
			  <div class='x_content'>
				<div class='row'>
					<div class='col-sm-12'>

						<div class='alert alert-success alert-dismissible ' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
							</button>
							<strong>Laporan Berhasil Dibuat</strong>
						</div>
	
					  <div class='card-box table-responsive'>
					  <table id='datatable' class='table table-striped table-bordered' style='width:100%'>
						<thead>
						  <tr>
							<th style='width: 10%;'>No.</th>
							<th>Nama Obat</th>
							<th>Jenis</th>
							<th>Stok</th>
							<th>Tanggal</th>
						  </tr>
						</thead>
						<tbody>
						";
						$no =1;
						foreach($cek_expired as $row_expired){
							$data = array(
								'no_arsip'			=> $kode_baru,
								'id_obat'			=> $row_expired['id_obat'],
								'tanggal_expired'	=> $row_expired['tanggal_expired']
							);
				
							$q = $this->detail_laporan->insertdetail_laporan($data);

							echo"
							<tr>
								<td>".$no."</td>
								<td>".$row_expired['nama_obat']."</td>
								<td>".$row_expired['nama_jenis']."</td>
								<td>".$row_expired['stok_obat']."</td>
								<td>".$row_expired['tanggal_expired']."</td>
							</tr>
							";
							$no++;
						};
                     
				echo "</tbody></table>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			";

		}else{
			echo "
			<div class='x_panel'>
	
				<div class='x_content'>
					<div class='row'>
						<div class='col-sm-12'>
							<div class='alert alert-danger alert-dismissible ' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
								</button>
								<strong>Data Obat Expired Tidak Ditemukan</strong> Laporan Tidak Dapat DIproses.
							</div>
						</div>
					</div>
				</div>
			</div>

			";
		}
		
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */