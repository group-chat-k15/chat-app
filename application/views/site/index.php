<!DOCTYPE html>
<html>
<head>
	<title><?= $title ? $title : 'Chat online group 13' ?></title>
	<link href="<?=base_url('public/')?>css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/style.css">
</head>
<body id="<?= $_SESSION['id'] ? $_SESSION['id'] : 3 ?>">
	<script type="text/javascript">
	 	var base_url = '<?= base_url() ?>';
	 	var BROADCAST_URL       = '<?= BROADCAST_URL ?>';
	 	var BROADCAST_PORT       = '<?= BROADCAST_PORT ?>';
	 </script>
	<?php $this->load->view('site/header'); ?>
	<?php $this->load->view('site/' . $temp); ?>
	<?php $this->load->view('site/footer'); ?>
	
	<script src="<?=base_url('public/')?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url('public/')?>js/layout.js"></script>
	<script src="<?=base_url('public/')?>my-js/main.js"></script>
</body>
</html>
