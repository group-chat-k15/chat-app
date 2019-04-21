<html>
<?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: http://localhost/chat-app/user_login_process");
    }
?>
<head>
<title>Login Form</title>
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
            <a class="navbar-brand">ChatboxUser</a>
          </div>
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost/chat-app/Home/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
    </nav>
    <div class="container">
        <?php
        if (isset($logout_message)) {
        echo "<div class='message'>";
        echo $logout_message;
        echo "</div>";
        }
        ?>
        <?php
        if (isset($message_display)) {
        echo "<div class='message'>";
        echo $message_display;
        echo "</div>";
        }
        ?>
        <div id="main">
            <div id="login">
            <h2>Login Form</h2>
            <hr/>
            <?php echo form_open('Home/user_login_process'); ?>
            <?php
                echo "<div class='error_msg'>";
                if (isset($error_message)) {
                    echo $error_message;
                }
                echo validation_errors();
                echo "</div>";
            ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">UserName:</label><br/><br />
                <div class="col-sm-4">          
                    <input type="text" class="form-control" name="username" id="pwd" placeholder="username" name="pwd">
                </div>
                <br/><br />
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label><br/><br />
                <div class="col-sm-4"> 
                    <input type="password" class="form-control" name="password" id="password" placeholder="**********"/>
                </div>
                <br/><br />
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-0 col-sm-2">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </div>
            <br/><br />
            <a href="http://localhost/chat-app/Home/do_upload"><h4>To Sign Up Click Here</a></h4>
            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>