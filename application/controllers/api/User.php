<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }
    public function index_get()
    {
        $username = $this->get('username');
        $password = sha1($this->get('password'));

        if($username == null || $password == null){

            $this->response([
                'status' => false,
                'message' => 'bad request'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;

        }else{
            $user = $this->user->login($username, $password)->result_array();

            if($user){
                $this->response([
                    'status' => true,
                    'message' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'not found'
                ], REST_Controller::HTTP_NOT_FOUND);
    
            }
            
        }
       
    }

}