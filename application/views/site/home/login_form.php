<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">                           
                        <form id="login-form" class="form" action="" method="post">
                            <div class="form-group">
                                <p class="text-center" style="color: red;"><?= $this->session->flashdata('message');?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info">Tên tài khoản:</label><br>
                                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ?>">
                                <div class="error"><?= form_error('username') ?></div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mật khẩu:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                                <div class="error"><?= form_error('password') ?></div>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Ghi nhớ</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Đăng nhập">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="<?= base_url('home/user_registration_show') ?>" class="text-info">Đăng ký</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>