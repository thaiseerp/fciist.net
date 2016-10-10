<div class="login">

		<h2><span>Change details of: <?=$user_name['value']?></span> </h2>
		<div class="login-bottom">
		<?php echo form_open(uri_string());?>
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
        Veg. User or Normal User (1 for veg.)	
        <div class="text">
			<?php echo form_input($user_veg);?>
			<div class="clear"> </div>
		</div>		

        <div class="remember">
		<?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" style="position:static" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
              <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>  
			<div class="send">
				<?php $submit = array("onclick" => "this.value='Please wait..'");
				echo form_submit('submit','Update User Details', $submit); ?>
			</div>
		<div class="clear"> </div>
		</div>
		</form>
        <br /><br />
        <a href="<?=base_url();?>cpanel/users">Back to Users</a> <br /><br />
        <a href="<?=base_url();?>cpanel">Back to Cpanel</a>
	</div>
	</div>
