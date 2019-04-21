<div class="container">
    <form id="login-form" class="form" action="" method="post">
        <div id="main">
            <div id="login">
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Họ hên:</label>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Nhập họ tên" value="<?= set_value('name') ?>">                       
                    </div>
                    <div class="error"><?= form_error('name') ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Tên đăng nhập:</label>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Tên đăng nhập" value="<?= set_value('username') ?>">                       
                    </div>
                    <div class="error"><?= form_error('username') ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Mật khẩu:</label>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">                       
                    </div>
                    <div class="error"><?= form_error('password') ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Nhập lại mật khẩu:</label>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="re_password" placeholder="Nhập lại mật khẩu">                       
                    </div>
                    <div class="error"><?= form_error('re_password') ?></div>
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-0 col-sm-2">
                    <button type="submit" class="btn btn-default">Đăng ký</button>
                </div>
            </div>
            <div class="form-group">    
                <div class="col-sm-4">   
                    <div class="input-group ml-3" style="color: #d10b26; font-size: 14px;">
                        Bạn đã có tài khoản đăng nhập tại <a class="ml-1" style="color: #0543f2; font-size: 14px;" href="<?= base_url() ?>">đây</a>                   
                    </div>
                </div>    
            </div>
            </div>
        </div>
    </form>
</div>
