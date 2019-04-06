<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_m');
        $this->load->model('add_friend_m');
        $this->load->model('comment_m');
    }

    public function index() {
        
        $input = array();
        $list_friend = $this->add_friend_m->get_list($input);
        
        foreach ($list_friend as $row) {
            $row->friend = $this->users_m->get_info($row->friends_id);
        }
        
        $this->data['list_friend'] = $list_friend;

        
        $this->data['temp'] = 'chat/index';
        $this->load->view('site/index', $this->data);
    }
    
    public function add_friend() {
    
    
        $this->data['temp'] = 'chat/add_friend';
        $this->load->view('site/index', $this->data);
    }
    
    public function load_broad_message() {
        $xhtml = '';
        if ($_POST['id']) {
            $id = $_POST['id'];
        }
    }

}
