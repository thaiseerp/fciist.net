<div class="login">
<?php 
$date = new DateTime('Tomorrow');
?>
		<h2><span>Book your South Indian lunch for:<br /><p align="center" style="padding:10px;color:#EAEAEA"><?php echo($date->format('l, F dS, Y'));?></p></span> </h2>
		<div class="login-bottom">
		<form>
		<p align="center" class="text" style="border: 0px;background:none;color:#000;padding-left:10px;font-weight:600">
            Booking done successfully
			<div class="clear"> </div>
		</p>       
        Make sure your name is within first 90 of status <strong><a href="<?=base_url();?>status/southindianlunch">list</a></strong>
        </div>
</div>
