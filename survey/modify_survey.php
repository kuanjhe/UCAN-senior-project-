<?php
    session_start();
    include('mysql_connect_inc.php');
    include('header_php.php');
    if (!isset($_SESSION['Course_ID'])){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
    } else{
      $Course_ID = $_SESSION['Course_ID'];
      $additional_string = " and `Course_ID`='$Course_ID'";
      $sql = "SELECT `Course_CName`,`number_survey_items` FROM `course_list` WHERE `Course_ID`='$Course_ID'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      $site_name=$row['Course_CName'];
      $number_survey_items=$row['number_survey_items'];
      
      
      
    }
?>
<!DOCTYPE html>
<html>
<title>修改課程問卷</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		selected_index=NULL;
  		function radio_checked(ID){
  			var radio_name = "optradio" + ID;
  			document.getElementById(radio_name).checked = true;
  			selected_index=ID;
  		}
  		function radio_unchecked(){
  			var radio_name = "optradio" + selected_index;
  			document.getElementById(radio_name).checked = false;
  			selected_index=NULL;
  		}
  		function radioB_checked(ID){
  			var radio_name = "optradioB_" + ID;
  			document.getElementById(radio_name).checked = true;
  			selected_index=ID;
  		}
  		function radioB_unchecked(){
  			var radio_name = "optradioB_" + selected_index;
  			document.getElementById(radio_name).checked = false;
  			selected_index=NULL;
  		}
  	</script>
  	
</head>
<?php
	include('mysql_connect_inc.php');
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['number_survey_items'])){
			$sql = "UPDATE `course_list` SET `number_survey_items`='{$_POST['number_survey_items']}' WHERE `Course_ID`='{$Course_ID}'";
			//$sql = "UPDATE `parameters` SET `value`='".$_POST['number_prizes']."' WHERE Name='number_prizes'".$additional_string;
			mysqli_query($con,$sql); 
		}
		
		if (isset($_POST['optradio'])){
    		$ID = $_POST['optradio'];
        	for($j=0; $j<count($ID); $j++){
    	   		$Problem_CName = "Problem_CName".$ID[$j];
    	   		$Problem_CName = $_POST[$Problem_CName];
    	   		$item_type = "item_type".$ID[$j];
    	   		$item_type = $_POST[$item_type];
    	   		$number_items = "number_items".$ID[$j];
    	   		$number_items = $_POST[$number_items]; 
    	   		$sql = "UPDATE `survey_item_name` SET `Problem_CName`='$Problem_CName', `item_type`='$item_type',`number_items`='$number_items' WHERE `ID`='$ID[$j]' ";
    	   		mysqli_query($con,$sql);
    	   		$sql2 = "SELECT * FROM `survey_item_list` WHERE `survey_item_id`='$ID[$j]'";
    	   		//echo $sql2;
            	$result2 = mysqli_query($con,$sql2);
           		//echo mysqli_num_rows($result2);
           		//echo $number_items;
            	if (mysqli_num_rows($result2)<$number_items){
                	for($i=1; $i<=$number_items-mysqli_num_rows($result2); $i++){
                    	$sql3 = "INSERT INTO `survey_item_list`(`ID`,`survey_item_id`, `Option_CName`) VALUES (NULL,'$ID[$j]',NULL)";
                    	mysqli_query($con,$sql3);
                	}
            	}
    	   	}
		}
		

		if (isset($_POST['optradioB'])){
			$ID=$_POST['optradioB'];
			for($i=0; $i<count($ID); $i++){
        		$Option_CName = "Option_CName_".$ID[$i];
    	   		$Option_CName = $_POST[$Option_CName];
    	   		$sql = "UPDATE `survey_item_list` SET `Option_CName`='$Option_CName' WHERE `ID`='{$ID[$i]}'";
    	   		mysqli_query($con,$sql);
    	   	}
		}

	}
	$sql = "SELECT `number_survey_items` FROM `course_list` WHERE `Course_ID`='{$Course_ID}'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$number_survey_items=$row['number_survey_items'];
?>
<body style="font-family: DFKai-sb;">
<?php
include('header.php');
?>
	<div class="container">
		<div class="row">
        <?php 
        	include("left_side_bar.php");
        ?>
        <div class="col-sm-9">
        
      
		<form action="" method="post">
			<div class="form-group">
				<label for="number_prizes">問卷題目總數:</label>
				<input type="text" class="form-control" name="number_survey_items" id="number_survey_items" value="<?php echo $number_survey_items?>" required>
			</div>
  			<button type="submit" class="btn btn-info">修改總數</button>
		</form>
		<p></p>
		<form id="myForm" action="" method="post">
		<table class="table table-bordered table-hover table-condensed" style="background-color:lavender;">
			<tbody>
				<tr><th style="text-align: center" colspan=6>問卷清單(總數：<?php echo $number_survey_items?>)</th></tr>
				<tr><th style="text-align: center"></th><th style="text-align: center">問卷編號</th>
					<th style="text-align: center">問卷題目內容</th><th style="text-align: center" width="160">題目類型</th>
					<th style="text-align: center">選項總數</th>
				<th></th>
				</tr>
			</tbody>
<?php
	$sql = "SELECT * FROM survey_item_name WHERE 1";
	$result = mysqli_query($con,$sql);
	for($i=1; $i<=min(mysqli_num_rows($result),$number_survey_items); $i++){
		$row = mysqli_fetch_assoc($result);
		echo "<tr>\n";
		echo "<td style=\"text-align: center\"><div class=\"radio\"><label><input type=\"checkbox\" name=\"optradio[]\" id=\"optradio{$row['ID']}\" value=\"{$row['ID']}\"></label></div></td>\n";
		echo "<td style=\"text-align: center\"> $i </td>\n";
		

		echo "<td style=\"text-align: center\"><textarea class=\"form-control\" rows=\"2\" cols=\"50\" name=\"Problem_CName{$row['ID']}\" id=\"Problem_CName{$row['ID']}\" placeholder=\"請輸入問卷題目內容\" onclick=\"radio_checked('{$row['ID']}')\" onselect=\"radio_checked('{$row['ID']}')\" required >{$row['Problem_CName']}</textarea>";
    	
		
		echo "</td>\n";
		echo "<td style=\"text-align: center\" >
				<select class=\"form-control\" name=\"item_type{$row['ID']}\" id=\"item_type{$row['ID']}\" onclick=\"radio_checked('{$row['ID']}')\" onselect=\"radio_checked('{$row['ID']}')\" required>";
		$item_type_array=array('','選擇題','是非題','申論題','填充題','多選題','選擇+其他');

		for($j=1; $j<count($item_type_array); $j++){
			echo "<option value=\"".$j."\"";
			if ($row['item_type']==$j){echo "selected";}
				echo ">{$item_type_array[$j]}</option>\n";
		}
		echo "</select>";
		echo "</td>\n";
		echo "<td style=\"text-align: center\" ><input type=\"text\" class=\"form-control\" name=\"number_items{$row['ID']}\" id=\"number_items{$row['ID']}\" value=\"{$row['number_items']}\"";
		echo " onclick=\"radio_checked('{$row['ID']}')\" onselect=\"radio_checked('{$row['ID']}')\" required>";
		echo "</td>\n";
		echo "<td><input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"進行修改\"></td>";
		echo "</tr>\n";
	}
?>
		</table>
		<input class="btn btn-info" role="button" type="submit" value="進行修改">
		</form>
		<p></p>


<?php
	$sql = "SELECT * FROM `survey_item_name` WHERE 1";
	$result = mysqli_query($con,$sql);
	for($i=1; $i<=min(mysqli_num_rows($result),$number_survey_items); $i++){
		$row = mysqli_fetch_assoc($result);
		if (($row['item_type']=='1') or ($row['item_type']=='5') or ($row['item_type']=='6')){
?>
		<form id="myForm" action="" method="post">
		<table class="table table-bordered table-hover table-condensed" style="background-color:lavender;">
			<tbody>
				<tr><th></th><th style="text-align: center" colspan=4>第<?php echo $i?>題：<?php echo $row['Problem_CName']?></th></tr>
				<tr><th></th><th style="text-align: center">選項序號</th><th style="text-align: center" >選項內容</th><th></th>
				</tr>
			</tbody>
<?php
			$sql3 = "SELECT * FROM `survey_item_list` WHERE `survey_item_id` = '{$row['ID']}' ";
			$result3 = mysqli_query($con,$sql3);
			for($j=1; $j<=$row['number_items']; $j++){
				$row3 = mysqli_fetch_assoc($result3);
				echo "<tr>\n";
				echo "<td style=\"text-align: center\"><div class=\"radio\"><label><input type=\"checkbox\" name=\"optradioB[]\" id=\"optradioB_{$row3['ID']}\" value=\"{$row3['ID']}\"></label></div></td>\n";
				echo "<td style=\"text-align: center\"> $j </td>\n";
				echo "<td style=\"text-align: center\"><input type=\"text\" class=\"form-control\" name=\"Option_CName_{$row3['ID']}\" id=\"Option_CName_{$row3['ID']}\" value=\"{$row3['Option_CName']}\"";
				echo "onclick=\"radioB_checked('{$row3['ID']}')\" onselect=\"radioB_checked('{$row3['ID']}')\" required></td>\n";
				echo "<td><input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"進行修改第{$i}題詳細選項\"></td>";
				echo "</tr>\n";
			}
?>
		</table>
		<input class="btn btn-info" role="button" type="submit" value="進行修改第<?php echo $i?>題詳細選項">
		</form>        
<?php
		}
	}

?>
    </div>
	</div>
</div>
</body>
</html>