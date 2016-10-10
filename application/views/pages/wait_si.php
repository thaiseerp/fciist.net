<?php
$server_time = time()*1000;
echo "
<script>
var serverTime =".$server_time.";
var localTime = Date.now();
var timeDiff = serverTime - localTime;

setInterval(function () {
    var d = Date.now() + timeDiff;
    var dt = new Date(d);

    var hours = dt.getHours();
    var minutes = dt.getMinutes();
    var seconds = dt.getSeconds();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; 
    minutes = minutes < 10 ? '0'+minutes : minutes;
    seconds = seconds < 10 ? '0'+seconds : seconds;
    var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    document.getElementById('clock').innerHTML = strTime;
}, 1000);
</script>";
?>
<div class="login">
		<h2><span><p align="center">NOTICE</p></span> </h2>
		<div class="login-bottom">
		<p align="center" class="text" style="border: 0px;background:none;color:#000;margin:-20px 0 10px 10px;font-weight:600">
            <span id="clock"></span>
			<div class="clear"> </div>
		</p>
        <p align="center">Booking time 9:30 PM - 11:00 PM</p><br />
        <!-- <p align="center">No Booking for Sundays</p><br /> -->
        <p align="center">For new registration, drop a mail to <i style="color:blue">support@fciist.net</i></p>
	</div>
	</div>
