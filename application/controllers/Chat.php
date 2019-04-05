<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {


        $this->data['temp'] = 'chat/index';
        $this->load->view('site/index', $this->data);
    }
    
    public function add_friend() {
    
    
        $this->data['temp'] = 'chat/add_friend';
        $this->load->view('site/index', $this->data);
    }

}
