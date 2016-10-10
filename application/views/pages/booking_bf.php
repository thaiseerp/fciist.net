<div class="login">
<?php 
$date = new DateTime('Tomorrow');
?>	
		<h2><span>Book your breakfast coupon for:<br /><p align="center" style="padding:10px;color:#EAEAEA"><?php echo($date->format('l, F dS, Y'));?></p></span> </h2>
		<div class="login-bottom">
		<?php echo form_open();?>
		<div class="text" style="border: 0px;background:none;color:red;padding-left:10px">
            <?php echo $message;?>
			<div class="clear"> </div>
		</div>       
		<div class="text">
			<?php echo form_input($user_email);?>
			<div class="clear"> </div>
		</div>
		<div class="text">		
			<?php echo form_input($user_sccode);?>
			<div class="clear"> </div>
		</div>	
		
        <div class="remember">   
			<div class="send">
                <?php $val = array("onclick" => "this.value='Please wait..'");
				 echo form_submit('submit', 'Book', $val); ?>
			</div>
		<div class="clear"> </div>
		</div>
		<?php echo form_close();?>
	</div>
	</div>
