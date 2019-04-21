		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="back-btn">
					<a href="<?= base_url('chat') ?>">
						<i class="fas fa-arrow-left"></i>
					</a>
				</div>
				<div class="">
					<div class="card card-friend mb-sm-3 mb-md-0 contacts_card" style="width: 600px;">
						<div class="card-body contacts_body">
							<ui class="contacts">
								<?php 
									$xhtml = '';
									if($list_user) {
										foreach($list_user as $row) {
											$link_img = base_url().'public/img/default-user-'.($row->sex ? $row->sex : 1).'.jpg';
											if(!empty($friend->image_link)){
												//$link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
											}
											$xhtml .= '<li class="active">
														<div class="d-flex bd-highlight">
															<div class="img_cont">
																<img src="'.$link_img.'" class="rounded-circle user_img">
															</div>
															<div class="user_info">
																<span>'.$row->name.'</span>
															</div>
															<div onclick="isAcept(\'acept\', this);" class="accept-btn btn btn-primary" id-friend="'.$row->id.'">
																Chấp nhận
															</div>
															<div onclick="isAcept(\'cancel\', this);" class="ml-3 accept-btn btn btn-primary" id-friend="'.$row->id.'">
																Hủy bỏ
															</div>
														</div>
													</li>';
										}
									}else {
										$xhtml .= '<p>Không có thông báo nào</p>';
									}
									echo $xhtml;
								?>
							</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
			</div>
		</div>