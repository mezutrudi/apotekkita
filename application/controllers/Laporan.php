<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
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
			'title'			=> $this->session->userdata('level').' - Data Laporan',
			'judul'			=> 'Data Laporan',
			'data' 			=> $this->laporan->getlaporan(),
			'content'		=> 'laporan/v_content',
			'ajax'	 		=> 'laporan/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}


	public function delete($id)
	{
		$cek = $this->laporan->getlaporan($id);
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('laporan'),'refresh');
		}else{
			
			$this->laporan->deletelaporan($id);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('laporan'),'refresh');
		}
		

	}

	public function cari()
	{
		$tgl_awal 	= $this->input->post('tgl_awal');
		$tgl_akhir 	= $this->input->post('tgl_akhir');

		$cek_expired = $this->laporan->carilaporan($tgl_awal,$tgl_akhir);
		if($cek_expired){

	
			echo "
			<table id='datatable' class='table table-striped table-bordered' style='width:100%'>
                    <thead>
                      <tr>
                        <th style='width: 10%;'>No.</th>
                        <th>Nomor Arsip</th>
                        <th>Tanggal</th>
                        <th style='width: 20%;'>Aksi</th>
                      </tr>
                    </thead>


                    <tbody>";
                    $no=1; 
					foreach($cek_expired as $row){
                    
					echo"<tr>
                        <td>".$no."</td>
                        <td>".$row['no_arsip']."</td>
                        <td>".$row['tanggal_laporan']."</td>
                        <td>
                          <button type='submit' class='btn-danger btnhapus' data-id='". $row['id_laporan']."'><i class='fa fa-lg fa-trash'></i> Hapus</button>

                          <a href='cetak/". $row['no_arsip']."' type='submit' class='btn-sm btn-primary btnedit' target='_blank'><i class='fa fa-lg fa-print'></i> Cetak</a>
                          </td>

                      </tr>";
                      } 
                    "</tbody>
                  </table>
			";

		}else{
			echo "
			<table id='datatable' class='table table-striped table-bordered' style='width:100%'>
                    <thead>
                      <tr>
                        <th style='width: 10%;'>No.</th>
                        <th>Nomor Arsip</th>
                        <th>Tanggal</th>
                        <th style='width: 20%;'>Aksi</th>
                      </tr>
                    </thead>
			</table>

			";
		}
		
	}

	public function cetak($id)
	{
		$detail_laporan = $this->detail_laporan->getdetail_laporan($id);

			$data_tabel = '<table> 
							<tr>
								<th style="border:1px solid #000; width:50px; text-align: center;"><b>No. </b></th>
								<th style="border:1px solid #000; width:300px; text-align: center;"><b>Nama Obat</b></th>
								<th style="border:1px solid #000; width:150px; text-align: center;"><b>Jenis Obat</b></th>
								<th style="border:1px solid #000; width:250px; text-align: center;"><b>Stok</b></th>
								<th style="border:1px solid #000; width:150px; text-align: center;"><b>Tanggal Expired</b></th>
							</tr>';
				$no=1; 
				foreach($detail_laporan as $d_detail_laporan){
				$data_tabel .='
					<tr>
						<th style="border:1px solid #000; text-align: center;">  '.$no.'</th>
						<th style="border:1px solid #000; text-align: left;">  '.$d_detail_laporan['nama_obat'].'</th>
						<th style="border:1px solid #000; text-align: left;">  '.$d_detail_laporan['nama_jenis'].'</th>
						<th style="border:1px solid #000; text-align: center;"> '.$d_detail_laporan['stok_obat'].'</th>
						<th style="border:1px solid #000; text-align: center;">  '.date_indo($d_detail_laporan['tanggal_expired']).'</th></tr>';
						 
					$no++;
				}

				$data_tabel .= '</table>';


			$data = array(
				'data' => $data_tabel,
				'no_arsip' => $id
			);
			
			$this->load->view('laporan/v_cetak', $data, FALSE);		
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */