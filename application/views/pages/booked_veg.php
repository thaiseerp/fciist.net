<div class="login">
<?php 
$date = new DateTime('Tomorrow');
?>
		<h2><span>Book your special veg. dish for:<br /><p align="center" style="padding:10px;color:#EAEAEA"><?php echo($date->format('l, F dS, Y'));?></p></span> </h2>
		<div class="login-bottom">
		<form>
		<p align="center" class="text" style="border: 0px;background:none;color:#000;padding-left:10px;font-weight:600">
            Booking done successfully
			<div class="clear"> </div>
		</p>       
        Check your name in status <a href="<?=base_url();?>status/vegspecial">page</a>
        
		
	</div>
	</div>
