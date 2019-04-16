<div class="container-fluid h-100">
	<div class="row justify-content-center h-100">
		
		<div class="col-md-4 col-xl-3 chat">
			<div class="card mb-sm-3 mb-md-0 contacts_card">
			<div class="card-header">
					<div class="input-group">
						<input type="text" placeholder="Search..." name=""
							class="form-control search">
						<div class="input-group-prepend">
							<span class="input-group-text search_btn"><i
								class="fas fa-search"></i></span>
						</div>
					</div>
				</div>
				<div class="card-body contacts_body">
					<ui class="contacts">
						<?php 
						      $xhtmlListFiend= '';
						      $xhtmlBlockMessage = '';
						      if(@$list_friend) { 
						          foreach ($list_friend as $k => $row) {
						              $link_img = base_url().'public/img/default-user-'.$row->sex.'.jpg';
						              if(!empty($friend->image_link)){
						                  //$link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
						              }
						              $xhtmlListFiend .= '<li> 
                                    						<div class="d-flex bd-highlight friend-box" '. ($k == 0 ? 'active="1"' : '') .' id-user="'.$row->id.'">
                                    							<div class="img_cont">
                                    								<img
                                    									src="'.$link_img.'"
                                    									class="rounded-circle user_img"> <span
                                    									class="online_icon offline"></span>
                                    							</div>
                                    							<div class="user_info">
                                    								<span>'.$row->name.'</span>
                                    								<p>Khadija left 50 mins ago</p>
                                    							</div>
                                    						</div>
    					                               </li>';
						              if ($k == 0) {
						                  $xhtmlBlockMessage .= '<div class="card-header msg_head">
                                                					<div class="d-flex bd-highlight friend-box">
                                                						<div class="img_cont">
                                                							<img
                                                								src="'.$link_img.'"
                                                								class="rounded-circle user_img"> <span class="online_icon"></span>
                                                						</div>
                                                						<div class="user_info">
                                                							<span>Chat with '.$row->name.'</span>
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
                                                							<li><a href="'.base_url('chat/add_friend').'"><i
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
                                                							<span class="input-group-text attach_btn">
                                                					           <i class="fas fa-paperclip"></i>
                                                					           <i class="fas fa-image ml-2"></i>
                                                					        </span>
                                                						</div>
                                                						<textarea id-to="'.$row->id.'" name="" class="form-control type_msg"
                                                							placeholder="Type your message..."></textarea>
                                                						<div class="input-group-append">
                                                							<span class="input-group-text send_btn" onclick="send_message(\''.BROADCAST_URL.'\', \''.BROADCAST_PORT.'\');"><i
                                                								class="fas fa-location-arrow"></i></span>
                                                						</div>
                                                					</div>
                                                				    <div class="image-area">
                                                				        <div class="image-area-box">
                                        					               <img src="'.$link_img.'">
                                                						  <i class="fas fa-times"></i>
                                        					            </div>
                                                					   <div class="image-area-box">
                                        					               <img src="'.$link_img.'">
                                                						  <i class="fas fa-times"></i>
                                        					            </div>
                                                					    <div class="image-area-box">
                                        					               <img src="'.$link_img.'">
                                                						  <i class="fas fa-times"></i>
                                        					            </div>
                                                						<div class="image-area-box">
                                        					               <img src="'.$link_img.'">
                                                						  <i class="fas fa-times"></i>
                                        					            </div>
                                    					            </div>
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
    					
    					<a href="#"><i class="fas fa-user"></i>View Profile</a>
    				</li>
    				<li>
    					
    					<a href="#"><i class="fas fa-lock"></i>Change Password</a>
    				</li>
    				<li>
    					
    					<a href="#"><i class="fas fa-sign-out-alt"></i>Sign out</a>
    				</li>
    			</ul>
    		</div>
			<div class="card message-board">
				<div class="loading-message d-none">
					<img src="<?= base_url('public/img/loading.gif') ?>" />
				</div>
				<div class="block-message">
					<?= $xhtmlBlockMessage ?>
					<!-- block mesage -->
				</div>
			</div>
		</div>
	</div>
</div>