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
    
    public function save_message() {
        if ($_POST['msg']) {
            $data = array(
                'pid' => 0,
                'vn_detail' => $_POST['msg'],
                'to_id' => $_POST['to_id'],
                'from_id' => $_POST['id_form'],
                'created' => now(),
            );
            $this->comment_m->create($data);
            
        }
    }
    
    public function load_broad_message() {
        $xhtml = '';
        if ($_POST['id']) {
            $id = $_POST['id'];
            $obj_friend = $this->users_m->get_info($id);
            if ($obj_friend) {
                $link_img = base_url().'public/img/default-user-'.$obj_friend->sex.'.jpg';
                if(!empty($obj_friend->image_link)){
                    //$link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
                }
                $xhtml .= '<div class="card-header msg_head">
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
            						<div class="video_cam">
            							<span><i class="fas fa-video"></i></span> <span><i
            								class="fas fa-phone"></i></span>
            						</div>
            					</div>
            					<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
            					<div class="action_menu">
            						<ul>
            							<li><i class="fas fa-user-circle"></i> View profile</li>
            							<li><a href="'.$link_img.'"><i
            									class="fas fa-users"></i> Add to close friends</a></li>
            							<li><i class="fas fa-plus"></i> Add to group</li>
            							<li><i class="fas fa-ban"></i> Block</li>
            						</ul>
            					</div>
            				</div>
            				<div class="card-body msg_card_body">
            					<div class="d-flex justify-content-start mb-4">
            						<div class="img_cont_msg">
            							<img
            								src="'.$link_img.'"
            								class="rounded-circle user_img_msg">
            						</div>
            						<div class="msg_cotainer">
            							Hi, how are you samim? <span class="msg_time">8:40 AM, Today</span>
            						</div>
            					</div>
            					<div class="d-flex justify-content-end mb-4">
            						<div class="msg_cotainer_send">
            							Hi Maryam i am good tnx how about you? <span
            								class="msg_time_send">8:55 AM, Today</span>
            						</div>
            						<div class="img_cont_msg">
            							<img
            								src="'.$link_img.'"
            								class="rounded-circle user_img_msg">
            						</div>
            					</div>
            				</div>
            				<div class="card-footer">
            					<div class="input-group">
            						<div class="input-group-append">
            							<span class="input-group-text attach_btn"><i
            								class="fas fa-paperclip"></i></span>
            						</div>
            						<textarea name="" id-to="" id-form="'.$id.'" class="form-control type_msg"
            							placeholder="Type your message..."></textarea>
            						<div class="input-group-append">
            							<span class="input-group-text  send_btn" onclick="send_message(\''.BROADCAST_URL.'\', \''.BROADCAST_PORT.'\');"><i
            								class="fas fa-location-arrow"></i></span>
            						</div>
            					</div>
            				</div>';
            }
        }
        echo $xhtml;
    }

    
    
    
    
    
    
    
    
    
    
    
    
}
