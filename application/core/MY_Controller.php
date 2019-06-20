<?php

Class MY_Controller extends CI_Controller {

    //bien gui du lieu sang ben view
    public $data = array();

    function __construct() {
        //ke thua tu CI_Controller
        parent::__construct();
        $this->check_user_login();
    }

    // check user login
    function check_user_login() {
        $controller = $this->uri->rsegment('1');
        $action = $this->uri->rsegment('2');
        // unset($_SESSION['logged_in']);
        // echo '<pre>';
        // print_r($_SESSION);die();
        // nếu chưa đăng nhập thì về trang đăng nhập
        if(!$_SESSION['login'] && $controller != 'home') {
            redirect(base_url());
        } 
        // nếu đã đăng nhập thì không cho vàng trang đăng nhập
        if($_SESSION['login'] && $controller == 'home') {
            redirect(base_url('chat'));
        } 
        //update user online
        if($_SESSION['login']) {
            $this->load->model('user_online_m');
            $user_id = $_SESSION['id'];
            $where = array('users_id' => $user_id);
            $info_user_online = $this->user_online_m->get_info_rule($where);
            $data = array(
                'users_id' => $user_id,
                'time' => time()
            );
            //check user online isset
            if($info_user_online) {
                $this->user_online_m->update($info_user_online->id, $data);
            }else {
                $this->user_online_m->create($data);
            }
        }  
    }
}
