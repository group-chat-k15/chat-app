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
							<form id="login-form" class="form" action="" method="post">
								<div class="form-group" style="width: 60%; margin: auto;">
									<label for="username" class="text-info"  style="color: #d8e4e6!important;">Nhập mật khẩu cũ</label><br>
									<input style="background-color: #c7c7c7;" type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ?>">
									<div class="error"><?= form_error('username') ?></div>
								</div>
								<div class="form-group" style="width: 60%; margin: auto;">
									<label for="username" class="text-info"  style="color: #d8e4e6!important;">Nhập mật khẩu mới</label><br>
									<input style="background-color: #c7c7c7;" type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ?>">
									<div class="error"><?= form_error('username') ?></div>
								</div>
								<div class="form-group" style="width: 60%; margin: auto;">
									<label for="username" class="text-info"  style="color: #d8e4e6!important;">Nhập lại mật khẩu mới</label><br>
									<input style="background-color: #c7c7c7;" type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ?>">
									<div class="error"><?= form_error('username') ?></div>
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