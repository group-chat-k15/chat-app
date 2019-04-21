		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="back-btn">
					<a href="<?= base_url('chat') ?>">
						<i class="fas fa-arrow-left"></i>
					</a>
				</div>
				<div class=""><div class="card card-friend mb-sm-3 mb-md-0 contacts_card">
					
					<div class="card-header">
						<form id="form-search" action="" method="POST">
							<div class="input-group">						
								<input type="text" placeholder="Search..." name="search" class="form-control search">
								<div class="input-group-prepend">
									<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
								</div>							
							</div>
						</form>
					</div>
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
														<div class="accept-btn btn btn-primary add-friend" id-friend="'.$row->id.'">
															'.($row->status_add == 1 ? 'Đang chờ xác nhận' : 'Kết bạn').'
														</div>
													</div>
												</li>';
									}
								}else {
									$xhtml .= '<p>Không có bạn bè nào</p>';
								}
								echo $xhtml;
							?>
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
			</div>
		</div>