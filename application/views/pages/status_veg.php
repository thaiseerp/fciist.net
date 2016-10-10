<link href="<?=base_url();?>contents/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" media="all"/>
<link href="<?=base_url();?>contents/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="all"/>
    <?php
    $date = new DateTime('Tomorrow'); ?>
    <div class="content">
        <div class="box">
            <div class="box-head">
                <h3>Booking Status - Veg. Special Booking</h3>
            </div>
        <div style="padding:20px">
            <table id="users_table" class="display cell-border" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th colspan="4">Veg. Special Booking for <?php echo($date->format('l, F dS, Y')); ?></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student Id</th>
                    </tr>
                </thead>
               <tbody>
    <?php
                $i=0;
                if($users)
                {
                    foreach($users as $row){
                        $i++;
                        echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td><label for='user_name'>".htmlspecialchars($row['user_name'])."</td>";
                            echo "<td><label for='user_sccode'>".htmlspecialchars($row['user_sccode'])."</td>";
                        echo "</tr>";
                    }
                }
                
                ?>
    </tbody></table></div></div></div>
   
    <script src="<?=base_url();?>contents/js/jquery.js" type="text/javascript"></script>
    <script src="<?=base_url();?>contents/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>contents/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
	$.fn.dataTable.TableTools.defaults.aButtons = [ "print"];
	$("#users_table").DataTable(
				{
					dom: 'T<"clear">lfrtip',
					"order": [[ 2, "asc" ]],
                    "pageLength": 100 ,
					"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0,1,2] }],
					"lengthChange": false,
					retrieve: true
				});
				
	$(".dataTable").each(function()
				{
					$(".dataTables_filter input").attr("placeholder", "Search your SC Code here...");
				});
	$(".DTTT_button_print").click(function () {
		$('.box').removeAttr('class');
   
	});
    </script>