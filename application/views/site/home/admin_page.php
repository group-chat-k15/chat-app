<html>
<?php
    //$username = ($this->session->userdata['logged_in']['username']);
    $_SESSION['username'] = ($this->session->userdata['logged_in']['username']);
    $_SESSION['email'] = ($this->session->userdata['logged_in']['email']);
    $_SESSION['image'] = ($this->session->userdata['logged_in']['image_link']);
    $_SESSION['name'] = ($this->session->userdata['logged_in']['name']);
?>
<head>
<title>Admin Page</title>
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
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://localhost/chat-app/Home/user_login_process"><?php echo $_SESSION['username']?></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Edit</a></li>
              <li><a href="http://localhost/chat-app/chat/add_friend"><span class="glyphicon glyphicon-plus"></span> Addfriend</a></li>
              <li><a href="http://localhost/chat-app/Chat"><span class="glyphicon glyphicon-inbox"></span> Chat</a></li>
            <li><a href="http://localhost/chat-app/Home/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
    </nav>
    <div id="profile">
    <?php $_SESSION['image_link']=base_url().'uploads/'.$_SESSION['image'];?>
    </div>
    <div id="profile">
    <div class="bg-1">
        <div class="container text-center">
        <h3>Welcome <?php echo $_SESSION['username']?></h3>
        <img src="<?php echo $_SESSION['image_link']?>" class="img-circle" alt="Bird" width="350" height="350">
        <h3><?php echo $_SESSION['email']?></h3>
        </div>
    </div>
    </div>
<br/>
</body>
</html>