<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Obat extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model', 'obat');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if($id === null){

            $obat = $this->obat->getobat();
        }else{
            $obat = $this->obat->getobat($id);
        }

        if($obat){
            $this->response([
                'status' => true,
                'data' => $obat
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'not found'
            ], REST_Controller::HTTP_NOT_FOUND);

        }
       
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if($id === null){

            $this->response([
                'status' => false,
                'message' => 'bad request'
            ], REST_Controller::HTTP_BAD_REQUEST);

        }else{
            $delete = $this->obat->deleteobat($id);
            if($delete > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted success'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    function index_post()
    {
        $data = [

            'nama_obat'         => $this->post('nama_obat'),
            'id_jenis'          => $this->post('id_jenis'),
            'stok_obat'         => $this->post('stok_obat'),
            'harga_obat'         => $this->post('harga_obat'),
            'tanggal_expired'    => $this->post('tanggal_expired')
        ];
        $insert = $this->obat->insertobat($data);
        if ($insert > 0) {
            $this->response([
                'status' => true,
                'message' => 'created success'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'created failed'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = [

            'nama_obat'       => $this->put('nama_obat'),
            'id_jenis'        => $this->put('id_jenis'),
            'stok_obat'       => $this->put('stok_obat'),
            'harga_obat'      => $this->put('harga_obat'),
            'tanggal_expired'    => $this->put('tanggal_expired')
        ];


        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'bad request'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if($this->obat->getobat($id) == null){
            
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_BAD_REQUEST);

        }else{
            
            if ($this->obat->updateobat($data, $id) > 0) {
    
                $this->response([
                    'status' => true,
                    'message' => 'updated success'
                ], REST_Controller::HTTP_CREATED);
            } else {
    
                $this->response([
                    'status' => false,
                    'message' => 'updated failed'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        
    }
}