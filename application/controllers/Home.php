<?php

Class Home extends MY_Controller {
    public function __construct() {
        parent::__construct();
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load session library
        $this->load->library('session');
        // Load database
        $this->load->model('login_database');
        
        //Load url helper
        $this->load->helper('url');
        
        //Load url helper
        $this->load->helper('security');

        $this->load->model('users_m');
        $this->load->model('add_friend_m');
        $this->load->model('comment_m');
    }
        // Show login page
    public function index() {
        if($this->input->post()) {
            $this->form_validation->set_rules('username', '', 'trim|required|xss_clean', 
                array(
                        'required'      => 'Tên đăng nhập không được trống',
                )
            );
            $this->form_validation->set_rules('password', '', 'trim|required|xss_clean',
                array(
                        'required'      => 'Mật khẩu không được trống',
                )
            );

            if ($this->form_validation->run()) {
                $data = array(
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password')
                    );
                $result = $this->login_database->login($data);
                if ($result) {
                    $username = $this->input->post('username');
                    $result = $this->login_database->read_user_information($username);
                    if ($result) {
                        $session_data = array(
                            'username' => $result[0]->username,
                            'email' => $result[0]->email,
                            'name' => $result[0]->name,
                            'image_link' => $result[0]->image_link
                        );
                        $_SESSION['id'] = $result[0]->id;
                        $_SESSION['login'] = true;
                        $_SESSION['info'] = $session_data;
                        redirect(base_url());  
                    }
                } else {
                    $this->session->set_flashdata('message', 'Tên đăng nhập hoặc mật khẩu chưa đúng');
                    redirect(base_url());                  
                }
            }
        }

        $this->data['title'] = 'Đăng nhập';
        $this->data['temp'] = 'home/login_form';
        $this->load->view('site/index', $this->data);
    }
    // Show registration page
    public function user_registration_show() {       
        if($this->input->post()) {
            $this->form_validation->set_rules('name', '', 'trim|required|xss_clean', 
                array(
                        'required'      => 'Họ tên không được trống',
                )
            );
            $this->form_validation->set_rules('username', '', 'trim|required|xss_clean', 
                array(
                        'required'      => 'Tên đăng nhập không được trống',
                )
            );
            $this->form_validation->set_rules('password', '', 'required|min_length[3]',
                array(
                        'required'      => 'Mật khẩu không được trống',
                        'min_length'      => 'Mật khẩu tối thiểu 3 ký tự',
                )
            );

            $this->form_validation->set_rules('re_password', '', 'matches[password]',
                array(
                        'matches'      => 'Mật khẩu không chưa đúng',
                )
            );

            if ($this->form_validation->run()) {
                $data = array(
                    'name' =>  $this->input->post('name'),
                    'username' =>  $this->input->post('username'),
                    'password' =>  $this->input->post('password'),
                );
                if($this->users_m->create($data)){
                    $this->session->set_flashdata('message', 'Bạn đã đăng ký tài khoản thành công vui lòng đăng nhập để sử dụng');
                    redirect(base_url());  
                }
            }
        }

        $this->data['title'] = 'Đăng ký';
        $this->data['temp'] = 'home/registration_form';
        $this->load->view('site/index', $this->data);
    }    
}
?>