<style>
    ul {
        padding:0px 10px;
    }
    li {
        padding:10px 0px;
        list-style-type:none;
    } 
</style>
<div class="login">
		<h2><span>FCIIST Control Panel</span> </h2>
		<div class="login-bottom">
            <div class="text" style="border: 0px;background:none;color:red;padding-left:10px">
           <?php echo $message;?>
			<div class="clear"> </div>
		</div> 
		<ul>
            <li><a href="<?=base_url();?>cpanel/clear_booking/1">Clear South Indian Lunch Booking</a></li>
            <li><a href="<?=base_url();?>cpanel/clear_booking/2">Clear Breakfast Booking</a></li>
            <li><a href="<?=base_url();?>cpanel/clear_booking/3">Clear Veg. Special Booking</a></li>
        </ul>
        <br />
        <a href="<?=base_url();?>cpanel">Back to Cpanel</a>
        </div>
</div>