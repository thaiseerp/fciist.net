<div class="login">
<?php
if ($this->ion_auth->logged_in())
redirect($this->session->flashdata('redirect_url'), 'refresh');
$this->session->keep_flashdata('redirect_url');
?>	
		<h2><span>For any queries, contact </span><i>support@fciist.net</i> </h2>
		<div class="login-bottom">
        <?php echo form_open();?>
        <div class="text" style="border: 0px;background:none;color:red;padding-left:10px">
           <?php echo $message;?>
			<div class="clear"> </div>
		</div> 
		<div class="text">
			<?php echo form_input($identity);?>
			<span class="men"></span>
			<div class="clear"> </div>
		</div>
		<div class="text">
            <?php echo form_input($password);?>		
			<span class="pass"></span>
			<div class="clear"> </div>
		</div>	
		
        <div class="remember">
			<div class="remember-top">
			<span class="checkbox1">
				 <label class="checkbox">
                 <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                 <i> </i>Remember me</label>
			</span>
			</div>
			<div class="send">
                <?php echo form_submit('submit', 'Log In', 'name="Sign In"');?>
			</div>
		<div class="clear"> </div>
		</div>
		<?php echo form_close();?>
	</div>
	</div>
