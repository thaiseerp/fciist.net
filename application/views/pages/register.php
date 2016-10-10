<div class="login">

		<h2><span>Register New User</span> </h2>
		<div class="login-bottom">
		<?php echo form_open("cpanel/add_user");?>
		<div class="text" style="border: 0px;background:none;color:red;padding-left:10px">
            <?php echo $message;?>
			<div class="clear"> </div>
		</div>
        <div class="text">
            <?php echo form_input($user_name);?>
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
        <div class="text">		
			<?php echo form_input($password);?>
			<div class="clear"> </div>
		</div>
        <div class="text">		
			<?php echo form_input($password_confirm);?>
			<div class="clear"> </div>
		</div>
        <div class="text">		
			<?php echo form_input($user_veg);?>
			<div class="clear"> </div>
		</div>	
		
        <div class="remember">   
			<div class="send">
                <?php $submit = array("onclick" => "this.value='Please wait..'");
				echo form_submit('submit','Register New User', $submit); ?>
			</div>
		<div class="clear"> </div>
		</div>
		</form>
        <br /><br />
        <a href="<?=base_url();?>cpanel">Back to Cpanel</a>
	</div>
	</div>
