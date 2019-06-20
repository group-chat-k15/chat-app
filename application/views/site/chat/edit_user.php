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
							<form id="login-form" class="form" action="" method="post" enctype="multipart/form-data">
								<div class="form-group" style="width: 60%; margin: auto;">
									<label for="name" class="text-info"  style="color: #d8e4e6!important;">Họ tên</label><br>
									<input style="background-color: #c7c7c7;" type="text" name="name" id="name" class="form-control" value="<?= $info->name ? $info->name : set_value('name') ?>">
									<div class="error"><?= form_error('name') ?></div>
								</div>
								<div class="form-group" style="width: 60%; margin: auto;">
									<label for="image_link" class="text-info" style="color: #d8e4e6!important;">Ảnh đại diện</label><br>
									<input style="background-color: #c7c7c7;" type="file" name="image_link" id="image_link" class="form-control">
									<?php if($info->image_link) { ?>
										<img src="<?= base_url('uploads/user/') . $info->image_link ?>" />
									<?php } ?>
								</div></br></br>
								<div class="form-group" style="width: 60%; margin: auto;">
									<input type="submit" name="submit" class="btn btn-info btn-md" value="Lưu thay đổi">
                            	</div>
							</form>
					</div>
					<div class="card-footer"></div>
				</div></div>
			</div>
		</div>