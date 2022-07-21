<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Jenis extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_model', 'jenis');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if($id === null){

            $jenis = $this->jenis->getjenis();
        }else{
            $jenis = $this->jenis->getjenis($id);
        }

        if($jenis){
            $this->response([
                'status' => true,
                'data' => $jenis
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
            $delete = $this->jenis->deletejenis($id);
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

            'nama_jenis'        => $this->post('nama_jenis')
        ];
        $insert = $this->jenis->insertjenis($data);
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

            'nama_jenis'       => $this->put('nama_jenis')
        ];


        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'bad request'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        if($this->jenis->getjenis($id) == null){
            
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_BAD_REQUEST);

        }else{
            
            if ($this->jenis->updatejenis($data, $id) > 0) {
    
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