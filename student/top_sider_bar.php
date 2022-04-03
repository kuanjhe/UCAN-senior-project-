    <!------------------------------left_sider_bar.php:begin------------------------------>
<?php
    if ($_SESSION['display_top_side_bar']==1){
?>    
    <div>
    	<table class="table table-hover">
    		<tbody>
			<div>
		<?php

            if (isset($_SESSION['login_RNuikEEFpDrrjTQ999'])){
                if ($_SESSION['login_RNuikEEFpDrrjTQ999']=="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999"){
                    include('menu00.php');
                    for($i=0; $i<count($link); $i++){
                        echo "<a href=\"{$link[$i]}\"><font size=\"5\">{$display_name[$i]}</font></a>\r";
                    }
                }
                if ($_SESSION['login_RNuikEEFpDrrjTQ999']=="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh"){
                    include('menu01.php');
                    for($i=0; $i<count($link); $i++){
                        echo "<tr><td>";
                        echo "<a href=\"{$link[$i]}\">{$display_name[$i]}</a>";
                        echo "</td></tr>\n";
                    }
                }
            if (isset($_SESSION['login_JVjsEZf4DQC8kAjL'])){
                if ($_SESSION['login_JVjsEZf4DQC8kAjL'] == "84gt2E2fUtrKIxCzHAtdjmNuKbpgPE1bPVOxezdv7wEeT3In"){
                    include('menu02.php');
                    for($i=0; $i<count($link); $i++){
                        echo "<tr><td>";
                        echo "<a href=\"120.113.174.17/student/s1042653/{$link[$i]}\">{$display_name[$i]}</a>";
                        echo "</td></tr>\n";
                    }
                }
            }                
            } else
                echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
    	?>
			</div>
    	    </tbody>
  		</table>
        <!--<table style="margin: auto">
            <tr><td style="text-align:center"><img src="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SESSION['home_dir']}/QRCode/site.png"?>"></td></tr>
            <tr><td style="text-align:center"><h8>網頁QRCode</h8></td></tr>
        </table>   -->
	</div>
<?php
}
?>
    <!------------------------------left_sider_bar.php:end-------------------------------->
