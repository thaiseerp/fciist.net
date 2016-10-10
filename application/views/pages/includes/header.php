<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1"> 
		<title><?=$title?></title>
        <link rel="shortcut icon" href="<?=base_url();?>favicon.ico" />
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>contents/css/style.css" />
		<script src="<?=base_url();?>contents/js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">

			<div class="cbp-af-header">
				<div class="cbp-af-inner">
					<a href="<?=base_url();?>">
                    <h1>FCIIST</h1><img src="<?=base_url();?>contents/images/fciist_logo.png"></a>
					<nav>
						<a href="<?=base_url();?>about_us">About Us</a>
						<a href="<?=base_url();?>status">Booking Status</a>
                        <?php 
                        if (!$this->ion_auth->logged_in())
                        { ?>
						<a href="<?=base_url();?>login">Login</a>
                        <?php 
                        }else {
                        ?>
                        <a href="<?=base_url()?>logout">Logout</a>
                        <a href="#" style="pointer-events: none;"><img src="<?=base_url()?>contents/images/man.png">&nbsp; <?=$this->session->userdata('user_name')?></a>
                        <?php
                        }
                        ?>
					</nav>
				</div>
			</div>
