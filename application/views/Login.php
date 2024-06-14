<!DOCTYPE html>
<html>
<head>
	<title>Criminal Face Recognition</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand topnav" href="<?php echo base_url();?>">
    <img class="logoimg" src="<?php echo base_url();?>assets/img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Criminal Face Recognition
  </a>
</nav>
	
	<div class="container">
		<!-- <div class="img">
			 <img src="<?php //echo base_url();?>assets/img/bg.svg">
		</div> -->
		<div class="login-content">
			<?php echo form_open('Login/Valid_Login'); ?>
      <!-- <h2 class="title1"> Criminal Face Recognition </h2> -->
				<img src="<?php echo base_url();?>assets/img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            
        </div>
    </div>
    <img class="wave" src="<?php echo base_url();?>assets/img/log1.png">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/main.js"></script>
</body>
</html>
