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
		<ul>
            <li><a href="<?=base_url();?>cpanel/add_user">Register New Users</a></li>
            <li><a href="<?=base_url();?>cpanel/users">Show All Users</a></li>
            <li><a href="<?=base_url();?>cpanel/clear_booking">Clear Booking</a></li>
            <?php
            if($bf_state)
            { ?>
                <li><a href="<?=base_url();?>cpanel/toggle_bf_state">Deactivate Breakfast Booking</li>
            <?php 
            }
            else
            { ?>
                <li><a href="<?=base_url();?>cpanel/toggle_bf_state">Activate Breakfast Booking</li>
            <?php 
            } ?>
            
        </ul>
        </div>
</div>