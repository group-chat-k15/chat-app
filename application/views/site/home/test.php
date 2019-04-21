<html>
<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $_SESSION['image_name'] = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
       
      $expensions= array("jpeg","jpg","png");
       
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
      }
       
      if($file_size > 2097152) {
         $errors[]='Kích thước file không được lớn hơn 2MB';
      }
       
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"uploads/".$_SESSION['image_name']);
      }else{
         print_r($errors);
      }
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
<style>
  .bg-1 { 
    background-color: #1abc9c; /* Green */
    color: #ffffff;
  }
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #fff; /* White */
    color: #555555;
  }
</style>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand">ChatboxUser</a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost/chat-app/Home/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
    </nav>
    <div class="container">
        <div class="container-fluid bg-1 text-center">
            <h3>Who Am I?</h3>
            <img src="<?php echo "http://localhost/chat-app/uploads/defaults.png";?>" class="img-circle" alt="Bird" width="350" height="350">
            <h3>I'm an adventurer</h3>
        </div>

        <div class="container-fluid bg-2 text-center">
            <div class="col-sm-4 "></div>
            <div class="col-sm-8">
                <form action = '' method = "POST" enctype = "multipart/form-data">
                    <div class="col-sm-6">          
                        <input type="file" class="form-control" name="image" value="defaults.png">
                    </div>
                    <br/><br />
                    <div class="col-sm-6">
                        <input type = "submit" class="btn btn-third btn-lg"/>
                        <a href="http://localhost/chat-app/Home/user_registration_show" class="btn btn-primary btn-lg active" role="button">Next</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>