<div class="login">
<?php 
$date = new DateTime('Tomorrow');
?>
		<h2><span>Book your special veg. dish for:<br /><p align="center" style="padding:10px;color:#EAEAEA"><?php echo($date->format('l, F dS, Y'));?></p></span> </h2>
		<div class="login-bottom">
		<p align="center" class="text" style="border: 0px;background:none;color:#000;padding-left:10px;font-weight:600">
            Already Booked
			<div class="clear"> </div>
		</p>       
        Check your name in status <a href="#">page</a>
        <br /><br />
        You are in the default list (Online booking is not required).
        <br /><br />
	    <a href="<?=base_url();?>vegspecial/veg_default">
        <input type="submit" value="Remove my name from the default list*" id="Book" onclick="this.value='Please Wait..'">
        </a>
        <br /><br /><p style="font-size:13px">*You can add yourself back to the default list.</p>
	</div>
	</div>
