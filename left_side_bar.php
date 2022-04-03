    <!------------------------------left_sider_bar.php:begin------------------------------>
<?php
if(isset($_SESSION['left_side_bar']))
    if ($_SESSION['left_side_bar']==1){
?>    
    <div class="col-sm-3">
    	<table class="table table-hover">
    		<tbody>
		<?php

            if (isset($_SESSION['login_RNuikEEFpDrrjTQ'])){
                if ($_SESSION['login_RNuikEEFpDrrjTQ']=="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999"){
                    include('menu00.php');
                    for($i=0; $i<count($link); $i++){
                        echo "<tr><td>";
                        echo "<a href=\"{$_SESSION['home_dir']}/{$link[$i]}\">{$display_name[$i]}</a>";
                        echo "</td></tr>\n";
                    }
                }
                if ($_SESSION['login_RNuikEEFpDrrjTQ']=="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh"){
                    include('menu01.php');
                    for($i=0; $i<count($link); $i++){
                        echo "<tr><td>";
                        echo "<a href=\"{$link[$i]}\">{$display_name[$i]}</a>";
                        echo "</td></tr>\n";
                    }
                }
            
                if ($_SESSION['login_RNuikEEFpDrrjTQ'] == "84gt2E2fUtrKIxCzAtdjmNuKbpgPE1bPOxezdv7wEe3In"){
                    include('menu02.php');
                    for($i=0; $i<count($link); $i++){
                        echo "<tr><td>";
                        echo "<a href=\"{$link[$i]}\">{$display_name[$i]}</a>";
                        echo "</td></tr>\n";
                    }
                }
                          
            } else
                echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
    	?>
    	    </tbody>
  		</table>
        
	</div>
<?php
}
?>
    <!------------------------------left_sider_bar.php:end-------------------------------->
