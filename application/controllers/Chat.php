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
        $user_id = $_SESSION['id'];
        $input = array();
        $input['where'] = array('user_id' => $user_id, 'status' => 1);
        $obj_add_friend = $this->add_friend_m->get_list($input);
        // list xhtml mesage
        $xhtml_list_mesage = '';
        if ($obj_add_friend) {
            $ids = $this->users_m->getId($obj_add_friend, 'friends_id');
            $input = array();
            $input['where_in'] = array('id', $ids);
            $input['order'] = array('name', 'ASC');
            $list_friend = $this->users_m->get_list($input);
            if ($list_friend) {
                if($list_friend[0]) {
                    $idFriend =  $list_friend[0]->id;
                    $sql = "SELECT * FROM `comment` WHERE ((`to_id` = '$idFriend' AND `from_id` = '$user_id') OR (`to_id` = '$user_id' AND `from_id` = '$idFriend'))
                    ORDER BY `created` ASC;";   
                    $list_mesage_first = $this->comment_m->query($sql);
                    if($list_mesage_first) {                        
                        foreach($list_mesage_first as $row) {
                            $xhtml_list_mesage .= $this->create_one_mesage($user_id, $row->from_id, $row->to_id, $row->image_list, $row->vn_detail, $row->created);
                        }
                    }
                }
            }
        }
        $this->data['xhtml_list_mesage'] = $xhtml_list_mesage;
        $this->data['list_friend'] = $list_friend;
        $this->data['title'] = 'Danh sách bạn bè';
        $this->data['temp'] = 'chat/index';
        $this->load->view('site/index', $this->data);
    }

    public function create_one_mesage($id_curent, $from_id, $to_id, $image_list, $content, $created) {
        $xhtml_list_mesage = '';
        if($id_curent && $from_id && $to_id) {
            $id = $id_curent == $from_id ? $from_id : $to_id;
            $info_user = $this->users_m->get_info($id);
            $link_img = base_url().'public/img/default-user-'. ($info_user->sex ? $info_user->sex : 1) .'.jpg';
            if(!empty($obj_friend->image_link)){
                //$link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
            }
            // get list image
            $image_list = json_decode($image_list);
            $xhtml_list_image = '';
            if($image_list) {
                $xhtml_list_image .= '<div class="image-message">';
                foreach($image_list as $value) {                    
                    $xhtml_list_image .=    '<div class="image-message-img">
                                                <img onclick="showImage(this)" src="'.base_url().'uploads/chat/'.$value.'" />
                                            </div>';
                }
                $xhtml_list_image .= '</div>';
            }
    
            $class_1 = $id_curent == $from_id ? 'end' : 'start';
            $class_2 = $id_curent == $from_id ? 'msg_cotainer_send' : 'msg_cotainer';
            $block_img =    '<div class="img_cont_msg">
                                <img src="'.$link_img.'" class="rounded-circle user_img_msg">
                            </div>';
            $block_content = '<div class="'.$class_2.'">
                                '.$xhtml_list_image.'
                                '.$content.' <span class="msg_time">8:40 AM, Today</span>
                            </div>';
            $str_restult = $id_curent == $from_id ? $block_content.$block_img : $block_img.$block_content;
            $xhtml_list_mesage .= '<div class="d-flex justify-content-'.$class_1.' mb-4">
                            '.$str_restult.'
                        </div>';
        }
        return $xhtml_list_mesage;
    }
    
    public function add_friend() {
        $user_id = $_SESSION['id'];

        $input = array();
        $input['where'] = array('user_id' => $user_id, 'status' => 1);

        $list_user = $this->add_friend_m->get_list($input);

        if($list_user) {
            $arrId = $this->add_friend_m->getId($list_user, 'friends_id');
            $input = array();
            $input['where'] = array('id <>' => $user_id);
            if($_POST['search']) {
                $input['like'] = array('name', $_POST['search']);
            }           
            $input['where_not_in'] = array('id', $arrId);
            $list_user = $this->users_m->get_list($input);

            foreach($list_user as $row) {
                $where = array('user_id' => $user_id, 'friends_id' => $row->id, 'status' => 0);
                $info = $this->add_friend_m->get_info_rule($where);
                if($info) {
                    $row->status_add = 1;
                }
            }
        }

        $this->data['list_user'] = $list_user;
        $this->data['title'] = 'Thêm bạn bè';
        $this->data['temp'] = 'chat/add_friend';
        $this->load->view('site/index', $this->data);
    }

    public function acept_friend() {
        $user_id = $_SESSION['id'];
        $input = array();
        $input['where'] = array('friends_id' => $user_id, 'status' => 0);
        $list_user = $this->add_friend_m->get_list($input);

        foreach($list_user as $row) {
            $where = array('id' => $row->user_id);
            $info = $this->users_m->get_info_rule($where);
            if($info) {
                $row->name = $info->name;
            }
        }
    
        $this->data['list_user'] = $list_user;
        $this->data['title'] = 'Thông báo';
        $this->data['temp'] = 'chat/acept_friend';
        $this->load->view('site/index', $this->data);
    }

    public function count_notifi_add_friend() {
        $flag = 0;
        $user_id = $_SESSION['id'];
        if($_POST['id_friend']) {

            $where = array('user_id' => $user_id, 'friends_id' => $_POST['id_friend']);
            $info_friend = $this->add_friend_m->get_info_rule($where);    
            if(!$info_friend) {
                $data = array(
                    'user_id' => $user_id,
                    'friends_id' => $_POST['id_friend'],
                    'status' => 0
                );
                if ($this->add_friend_m->create($data))  $flag = 1; 
            }           
        }
        echo $flag;
    }

    public function ajax_add_friend() {
        $user_id = $_SESSION['id'];
        if($_POST['id_friend']) {             
            $input = array();
            $input['where'] = array('friends_id' => $_POST['id_friend'], 'status' => 0);

            $number = count($this->add_friend_m->get_list($input)); 

            $where = array('user_id' => $user_id, 'friends_id' => $_POST['id_friend']);
            $info_friend = $this->add_friend_m->get_info_rule($where);    
            if(!$info_friend) {
                $data = array(
                    'user_id' => $user_id,
                    'friends_id' => $_POST['id_friend'],
                    'status' => 0
                );
                if ($this->add_friend_m->create($data))  $flag = 1; 
                $number = $number + 1;
            }           
        }
        echo $number;
    }

    public function is_acept_friend() {
        $flag = 0;
        $user_id = $_SESSION['id'];
        if($_POST['type']) { 
            $info_friend = $this->add_friend_m->get_info($_POST['id_add_friend']); 
            if($_POST['type'] == 'acept') {
                if($info_friend) {
                    $data = array(
                        'status' => 1
                    );
                    if($this->add_friend_m->update($info_friend->id, $data)) {
                        $data_acept = array(
                            'user_id' => $info_friend->friends_id,
                            'friends_id' => $info_friend->user_id,
                            'status' => 1
                        );
                        if ($this->add_friend_m->create($data_acept))  $flag = 1; 
                    }
                }
            }else {
                $this->add_friend_m->delete($info_friend->id);
            }
        }
        echo $flag;
    }
    
    public function save_message() {
        $flag = 0;
        if ($_POST['msg'] || $_POST['list_image']) {
            $data = array(
                'pid' => 0,
                'vn_detail' => $_POST['msg'] ? $_POST['msg'] : '',
                'to_id' => $_POST['to_id'] ? $_POST['to_id'] : '',
                'from_id' => $_POST['from_id'] ? $_POST['from_id'] : '',
                'image_list' => $_POST['list_image'] ? $_POST['list_image'] : '',
                'created' => time()
            );
            if ($this->comment_m->create($data))  $flag = 1; 
        }
        echo $flag;
      }

    public function save_message_miss() {
        $result = array();
        if ($_POST['user_id']) {
            $user_id = $_POST['user_id'];
            $friends_id = $_POST['friends_id'];
            $where = array('user_id' => $user_id, 'friends_id' => $friends_id);
            $obj_add_friend = $this->add_friend_m->get_info_rule($where);
            $count_notifi = $obj_add_friend->count_notifi + 1;
            $data = array(
                'count_notifi' => $count_notifi,
            );
            if ($this->add_friend_m->update_rule($where, $data)) {
                $result['success'] = 1; 
                $result['countMsgMiss'] = $count_notifi;
            }        
        }
        echo json_encode($result);
    }
    
    public function create_mesage() {
        $xhtml = '';
        if($_POST) {           
            $id_curent = $_POST['id_curent'];
            $info_mesage = $_POST['msg'];
            $id = $id_curent == $info_mesage['from_id'] ? $info_mesage['from_id'] : $info_mesage['to_id'];
            $info_user = $this->users_m->get_info($id);
            $link_img = base_url().'public/img/default-user-'. ($info_user->sex ? $info_user->sex : 1) .'.jpg';
            if(!empty($obj_friend->image_link)){
                //$link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
            }
            // get list image
            $image_list = json_decode($info_mesage['list_image']);
            $xhtml_list_image = '';
            if($image_list) {
                $xhtml_list_image .= '<div class="image-message">';
                foreach($image_list as $value) {                    
                    $xhtml_list_image .=    '<div class="image-message-img">
                                                <img onclick="showImage(this)" src="'.base_url().'uploads/chat/'.$value.'" />
                                            </div>';
                }
                $xhtml_list_image .= '</div>';
            }

            $class_1 = $id_curent == $info_mesage['from_id'] ? 'end' : 'start';
            $class_2 = $id_curent == $info_mesage['from_id'] ? 'msg_cotainer_send' : 'msg_cotainer';
            $block_img =    '<div class="img_cont_msg">
    							<img src="'.$link_img.'" class="rounded-circle user_img_msg">
    						</div>';
            $block_content = '<div class="'.$class_2.'">
                                '.$xhtml_list_image.'
    							'.$_POST['msg']['msg'].' <span class="msg_time">8:40 AM, Today</span>
    						</div>';
            $str_restult = $id_curent == $info_mesage['from_id'] ? $block_content.$block_img : $block_img.$block_content;
            $xhtml .= '<div class="d-flex justify-content-'.$class_1.' mb-4">
                            '.$str_restult.'
    					</div>';
        }
        echo $xhtml;
    }
    
    
    public function load_broad_message() {
        $user_id = $_SESSION['id'];
        $xhtml = '';
        if ($_POST['id']) {
            $id = $_POST['id'];
            $obj_friend = $this->users_m->get_info($id);
            if ($obj_friend) {
                $link_img = base_url().'public/img/default-user-'.($info_user->sex ? $info_user->sex : 1) .'.jpg';
                if(!empty($obj_friend->image_link)){
                    //$link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
                }
                $xhtml_list_mesage = '';
                $idFriend =  $obj_friend->id;
                $sql = "SELECT * FROM `comment` WHERE ((`to_id` = '$idFriend' AND `from_id` = '$user_id') OR (`to_id` = '$user_id' AND `from_id` = '$idFriend'))
                ORDER BY `created` ASC;";   
                $list_mesage_first = $this->comment_m->query($sql);
                if($list_mesage_first) {                        
                    foreach($list_mesage_first as $row) {
                        $xhtml_list_mesage .= $this->create_one_mesage($user_id, $row->from_id, $row->to_id, $row->image_list, $row->vn_detail, $row->created);
                    }
                }
                $xhtml .= '<div class="card-header msg_head id-to" id-to="'.$obj_friend->id.'">
            					<div class="d-flex bd-highlight friend-box">
            						<div class="img_cont">
            							<img
            								src="'.$link_img.'"
            								class="rounded-circle user_img"> <span class="online_icon"></span>
            						</div>
            						<div class="user_info">
            							<span>Chat with '.$obj_friend->name.'</span>
            							<p>1767 Messages</p>
            						</div>
            					</div>
            				</div>
            				<div class="card-body msg_card_body">
                                '.$xhtml_list_mesage.'
            				</div>';
            }
        }
        echo $xhtml;
    }

    // uploads file
    public function uploads() {
        // path to derictery uploads
        $storeFolder = ROOT_PATH . '/uploads/chat/';
        // upload files to $storeFolder
        if (!empty($_FILES)) {
            $image_list = array();
            foreach($_FILES['file']['tmp_name'] as $key => $value) {
                $tempFile = $_FILES['file']['tmp_name'][$key];
                $file_name = time() . '_' . $_FILES['file']['name'][$key];
                $targetFile =  $storeFolder. $file_name;
                move_uploaded_file($tempFile,$targetFile);
                $image_list[] = $file_name;
            }
            echo json_encode($image_list);
        }
    } 
    
    // edit user
    public function edit_user() {
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

        $this->data['title'] = 'Quản lý thông tin';
        $this->data['temp'] = 'chat/edit_user';
        $this->load->view('site/index', $this->data);
    }

    // edit user
    public function change_pass() {
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

        $this->data['title'] = 'Quản lý thông tin';
        $this->data['temp'] = 'chat/change_pass';
        $this->load->view('site/index', $this->data);
    }


      // Logout from admin page
      public function logout() {
        unset($_SESSION['login']);
        unset($_SESSION['id']);
        unset($_SESSION['info']);
        redirect(base_url());
    }  
    
    
    
    
    
    
    
    
    
    
}
