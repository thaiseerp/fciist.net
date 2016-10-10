<div class="login">
<?php 
$date = new DateTime('Tomorrow');
?>
		<h2><span>Book your special veg. dish for:<br /><p align="center" style="padding:10px;color:#EAEAEA"><?php echo($date->format('l, F dS, Y'));?></p></span> </h2>
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
        <br />
        If you are a default vegetarian, add your name to the default list. Once you are in the default list, online booking is not required (until you remove yourself from the default list).
        <br /><br />
        <a href="<?=base_url();?>vegspecial/veg_default">
	    <input type="submit" value="Add my name to the default list" id="Book" onclick="this.value='Please Wait..'">
        </a>
		
	</div>
	</div>
