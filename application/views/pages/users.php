<link href="<?=base_url();?>contents/css/users.css" rel="stylesheet" type="text/css"/>
<div class="about">
    <div class="table">
    <table>
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>SCcode</td>
                    <td>Edit</td>
                </tr>
                <?php
                $i=0;
                foreach($users as $row){
                    $i++;
                    echo "<tr>";
                        echo "<td>$i</td>";
                        //echo "<td>".$row['user_id']."</td>";
                        echo "<td>".htmlspecialchars($row['name'])."</td>";
                        echo "<td>".htmlspecialchars($row['email'])."</td>";
                        echo "<td>".htmlspecialchars($row['sccode'])."</td>";
                        echo "<td>".anchor("cpanel/edit_user/".$row['id'], 'Change')."</td>";
                    echo "</tr>";
                }
                ?>
        </table>
        </div>
    <ul class="pagination">
    <?=$page_links ?>
    </ul>
    <div class="back">
        <a href="<?=base_url();?>cpanel">Back to Cpanel</a>
    </div>
</div>
