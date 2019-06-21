<div class="container-fluid h-100">
	<div class="row justify-content-center h-100">
		<div class="show-image">
			<img src="http://localhost/project-hao/chat/chat-app/uploads/chat/1555733381_banner-1 (2).png" />
		</div>
		<div class="col-md-4 col-xl-3 chat">
			<div class="card mb-sm-3 mb-md-0 contacts_card">
				<div class="card-header">
					<a title="Thông báo" href="<?= base_url('chat/acept_friend') ?>"><i class="fas fa-bell noti-add-friend"></i></a>
					<a title="Thêm bạn bè" class="ml-2" href="<?= base_url('chat/add_friend') ?>"><i class="fas fa-plus"></i></a>
					<a title=" <?= $info_user->name ?>" class="ml-2" href="<?= base_url('chat/add_friend') ?>"><?= $info_user->name ?></a>
				</div>
				<div class="card-body contacts_body">
					<ui class="contacts list-friend">
						<?php 
						      $xhtmlListFiend= '';
						      $xhtmlBlockMessage = '';
						      if(@$list_friend) { 
									$this->load->model('user_online_m');
						          foreach ($list_friend as $k => $row) {
										//get info time online
										$where = array('users_id' => $row->id);
										$info_user_online = $this->user_online_m->get_info_rule($where);
										//sau 10 phút nếu không load lại trang thì sẽ k online
										$class_online = ($info_user_online->time + 600) < time() ? 'offline' : '';
										//image
										$link_img = base_url().'public/img/default-user-'.($row->sex ? $row->sex : 1).'.jpg';
										if(!empty($friend->image_link)){
											$link_img = base_url().'uploads/user/'.$row->image_link;
										}
						              $xhtmlListFiend .= '<li> 
                                    						<div class="d-flex bd-highlight friend-box" '. ($k == 0 ? 'active="1"' : '') .' id-user="'.$row->id.'">
						                                         <p class="notifi-'.$row->id.'"></p>
                                    							<div class="img_cont">
                                    								<img
                                    									src="'.$link_img.'"
                                    									class="rounded-circle user_img"> <span
                                    									class="online_icon '.$class_online.'"></span>
                                    							</div>
                                    							<div class="user_info">
                                    								<span>'.$row->name.'</span>
                                    								
                                    							</div>
                                    						</div>
    					                               </li>';
						              if ($k == 0) {
						                  $xhtmlBlockMessage .= '<div class="card-header msg_head id-to" id-to="'.$row->id.'">
                                                					<div class="d-flex bd-highlight friend-box">
                                                						<div class="img_cont">
                                                							<img
                                                								src="'.$link_img.'"
                                                								class="rounded-circle user_img">
                                                						</div>
                                                						<div class="user_info">
                                                							<span>'.$row->name.'</span>
                                                							
                                                						</div>
                                                					</div>
                                                				</div>
                                                				<div class="card-body msg_card_body">
																	'                       .@$xhtml_list_mesage.'
                                                				</div>';
						              }
						          }
						      }
						      echo $xhtmlListFiend;
						?>
					</ui>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
		<div class="col-md-8 col-xl-6 chat">
    		<div class="my-profile">
    			<i class="fas fa-users"></i>
    			Quản lý tài khoản
    		</div>
    		<div class="my-profile-zone">
    			<ul>
    				<li>
    					
    					<a href="<?= base_url('chat/edit_user') ?>"><i class="fas fa-user"></i>Quản lý thông tin</a>
    				</li>
    				<li>
    					
    					<a href="<?= base_url('chat/logout') ?>"><i class="fas fa-sign-out-alt"></i>Đắng xuất</a>
    				</li>
    			</ul>
    		</div>
			<div class="card message-board">
				<div class="loading-message d-none">
					<img src="<?= base_url('public/img/loading.gif') ?>" />
				</div>
				<div class="block-message">
					<div class="header-body">
              <!-- block mesage -->
              <?= $xhtmlBlockMessage ?>
					</div>
					<div class="card-footer">
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text attach_btn">
									<i class="fas fa-image ml-2 fileinput-button"></i>
								</span>
							</div>
							<input class="form-control type_msg" type="text" placeholder="Nhập tin nhắn">
							<div class="input-group-append">
								<span class="input-group-text send_btn" onclick="send_message('<?= BROADCAST_URL ?>', '<?= BROADCAST_PORT ?>');"><i
									class="fas fa-location-arrow"></i></span>
							</div>
						</div>
						<div class="image-area" id="previews">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>