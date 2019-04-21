<html>
<?php
    if (isset($this->session->userdata['logged_in'])) {
        header("location: http://localhost/chat-app/user_login_process");
    }
?>
<head>
<title>Registration Form</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="user_login_process">ChatboxUser</a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost/chat-app/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
    </nav>
    <div class="container">
        <div id="main">
            <div id="login">
            <h2>Registration Form</h2>
            <hr/>
            <?php
                echo "<div class='error_msg'>";
                echo validation_errors();
                echo "</div>";
                echo form_open('Home/new_user_registration');
            ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Create UserName:</label><br/><br/>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>
                <br/><br />
            </div>
            <div class='error_msg'>
                <?php if (isset($message_display)) {
                    echo $message_display;
                }?>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Create Email:</label><br/><br/>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="email" class="form-control" name="email_value" placeholder="Email">
                    </div>
                </div>
                <br/><br />
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Create Password:</label><br/><br/>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                </div>
                <br/><br />
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Choose Image:</label><br/><br/>
                <div class="col-sm-4">   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                        <input id="image" type="text" value='<?php echo $_SESSION['image_name'];?>' class="form-control" name="image_link" placeholder="image_file">
                    </div>
                </div>
                <br/><br />
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-0 col-sm-2">
                    <button type="submit" class="btn btn-default">Sign Up</button>
                </div>
            </div>
            <br/><br />
            <?php echo form_close();?>
            </div>
        </div>
    </div>
        
</body>
</html>