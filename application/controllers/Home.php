<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $this->data['judul']='Login';
        $this->data['action']=  site_url('home/do_login');

        $this->data['temp'] = 'home/login_view';
        $this->load->view('site/index', $this->data);
    }
    
    public function do_login(){
        $this->load->model('user_verifikasi','verifikasi');
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
    
        $query=  $this->verifikasi->cek_user($user_id, $password);
    
        if($query->num_rows()>0){
            redirect('Login/main_page');
        }else{
            $this->session->set_flashdata('login_error',TRUE);
            redirect('login');
        }
    }
}
