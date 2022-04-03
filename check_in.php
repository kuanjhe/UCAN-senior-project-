<?php
	session_start();
	include('mysql_connect_inc.php');
	include('survey/header_php.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<title>登記學生修讀課程</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.additional{
  			text-align: center;
  			color: red;
  		}
  	</style>
</head>
<body style="font-family: DFKai-sb;" onload="default_course()">
<?php
	include("header.php");
?>
  
<div class="container">
  <div class="row">
    <?php include("left_side_bar.php");?>
    <div class="col-sm-5">      
		<div class="container">
			<h2 style="text-align:center;">登記學生修讀課程頁面</h2>
			<form action="" method="POST">
		    	<div class="form-group">
		      		<label for="Year"><h4>請選擇課程學年度：</h4></label>
		      		<select class="form-control" id="Year" name="Year" onclick="produce_course()">
		      			<!--option value=""></option-->		      			
		      			<!--option value="107">107</option-->
<?php
  	$sql = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC";
	$result = mysqli_query($con,$sql);
	for($i=1; $i<=mysqli_num_rows($result); $i++){
		$row = mysqli_fetch_assoc($result);
		if (isset($_SESSION['Year_3'])){
			if ($row['Year']==$_SESSION['Year_3']){
				echo "						<option value=\"".$row['Year']."\" selected>".$row['Year']."</option>\n";
			} else {
				echo "						<option value=\"".$row['Year']."\">".$row['Year']."</option>\n";
			}	
		} else {
			echo "						<option value=\"".$row['Year']."\">".$row['Year']."</option>\n";
		}	
	}
?>
		      		</select>
		    	</div>
		    	


          <div class="form-group">
              <label for="Course_CName"><h4>請選擇課程名稱:</h4></label>
              <select class="form-control" id="Course_CName" name="Course_CName">
<?php
  $sql = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['User_ID']}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);

  $sql = "SELECT `Course_CName` FROM `course_list` WHERE `Teacher_CName` = '".$row['Name']."'";
  $result = mysqli_query($con,$sql);
  for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    if (isset($_SESSION['Course_CName_3'])){
      if ($row['Course_CName']==$_SESSION['Course_CName_3']){
        echo "            <option value=\"".$row['Course_CName']."\" selected>".$row['Course_CName']."</option>\n";
      } else {
        echo "            <option value=\"".$row['Course_CName']."\">".$row['Course_CName']."</option>\n";
      } 
    }
  }
?>
              </select>
          </div>
		    	<div class="form-group">
		      		<label for="StudentID"><h4>請輸入學生學號：</h4></label>
		      		<input type="text" class="form-control" id="StudentID" placeholder="1061234" name="StudentID" required>
		    	</div>
		    	<!--div class="form-check">
		      		<label class="form-check-label">
		        	<input class="form-check-input" type="checkbox" name="remember"> Remember me
		      		</label>
		    	</div-->
		    	<div class="text-center">
		    		<button type="submit" class="btn btn-primary">送出選擇</button>
		    	</div>
		  	</form>
		  	
		</div>
    </div>
    <div class="col-sm-4">
<?php
 
  
	if (isset($_SESSION['duplicate'])){
    $sql2 = "SELECT * FROM `course_list` WHERE `Course_ID` = '{$_SESSION['Course_ID_2']}' AND `Hide`='0'";
    $result2 = mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
		
    if(isset($_SESSION['success_update'])){
      if($_SESSION['success_update']=='1'){
        echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID']."</h2><h2 style=\"text-align:center;\">完成登記</h2><h2 class=\"additional\">{$_SESSION['Year_3']}學年度</h2><h2 class=\"additional\">{$_SESSION['Course_CName_3']}</h2><h2 style=\"text-align:center;\">之手續!</h2>";
      }
    }
		if ($_SESSION['duplicate']==1){
			echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID']."</h2><h2 style=\"text-align:center;\">已經登記修讀過</h2><h2 class=\"additional\">{$_SESSION['Year_3']}學年度</h2><h2 class=\"additional\">{$_SESSION['Course_CName_3']}</h2>";
		} else {
			
			if ($_SESSION['success_insert']=='1'){
				echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID']."</h2><h2 style=\"text-align:center;\">完成登記</h2><h2 class=\"additional\">{$_SESSION['Year_3']}學年度</h2><h2 class=\"additional\">{$_SESSION['Course_CName_3']}</h2><h2 style=\"text-align:center;\">之手續!</h2>";
			} 
			
			if (($_SESSION['success_insert']!='1') and ($_SESSION['success_insert']!='2')){
				echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID']."</h2><h2 style=\"text-align:center;\">未完成登記修讀</h2><h2 class=\"additional\">{$_SESSION['Year_3']}學年度</h2><h2 class=\"additional\">{$row2['Course_CName']}</h2><h2 style=\"text-align:center;\">之手續!</h2>";
			}
			unset($_SESSION['success_insert']);
		}
		unset($_SESSION['duplicate']);
	}
?>

    </div>
  </div>
</div>

</body>
</html>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		include('mysql_connect_inc.php');
		  $Year = $_POST['Year'];
    	$Course_CName = $_POST['Course_CName']; 
    	$StudentID = $_POST['StudentID']; 
    	$_SESSION['Year_3'] = $Year;
    	$_SESSION['Course_CName_3'] = $Course_CName;
		  $_SESSION['StudentID'] = $StudentID;
		  date_default_timezone_set("Asia/Taipei");
  		$record_ime = date("Y:m:d H:i:s",time());
      
    	if ((isset($_SESSION['Year_3']))&(isset($_SESSION['Course_CName_3']))){
      		$sql = "SELECT `Course_ID`,`Survey_ID` FROM `course_list` WHERE `Year` = '{$_SESSION['Year_3']}' AND `Course_CName` = '{$_SESSION['Course_CName_3']}'";
      		$result = mysqli_query($con,$sql);
      		$row = mysqli_fetch_assoc($result);
          $_SESSION['Survey_ID_2'] = $row['Survey_ID'];
          $Survey_ID=$_SESSION['Survey_ID_2'];
      		$_SESSION['Course_ID_2'] = $row['Course_ID'];
      		$Course_ID=$_SESSION['Course_ID_2'];
      	}
		  
  		$sql = "SELECT * FROM `student_list` WHERE `StudentID`='$StudentID' and `Survey_ID` = '$Survey_ID' AND `Hide`='0'";
  		//echo $sql;
  		$result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
  		if (mysqli_num_rows($result)==0){
  			$_SESSION['duplicate'] = 0;
  			$sql2 = "INSERT INTO `student_list` (`ID`, `StudentID`, `Name`, `Survey_ID`, `Student_check`, `Teacher_check`, `Survey`, `Survey_Teacher`,`ability`,`Time`,`Hide`) VALUES (NULL, '$StudentID', NULL, '$Survey_ID', '0','1','0','0','0','$record_ime','0');";
			
  		if (mysqli_query($con,$sql2)){
				$_SESSION['success_insert']='1';
      }
					
  		} else {
  			if(mysqli_num_rows($result)==1){
          if($row['Teacher_check']=='1'){
            $_SESSION['duplicate'] = 1;
          }else{
            $sql = "UPDATE `student_list` SET `Teacher_check` = '1' WHERE `StudentID`='$StudentID' AND `Survey_ID`='$Survey_ID';";
            if (mysqli_query($con,$sql)){
              $_SESSION['success_update']='1';
            }
          }

          
        }
  		}
  		//echo $sql;
		echo "<meta http-equiv=REFRESH CONTENT=0.01;url=check_in.php>";
	}
?>

<script type="text/javascript">
  function default_course(){
    <?php
      if ((isset($_SESSION['Year_2']))&(isset($_SESSION['Course_CName_3']))){
        echo "document.getElementById(\"Year\").value = \"{$_SESSION['Year_3']}\";\n";
        echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_3']}\";\n";
      } else {
        echo "document.getElementById(\"Year\").selectedIndex = \"0\";\n";
        echo "document.getElementById(\"Course_CName\").selectedIndex = \"0\";\n";
      }
    ?>
    produce_course();
  }

</script>
<script type="text/javascript">
  function produce_course(){
    var Year = document.getElementById("Year").value;
    document.getElementById("Course_CName").length=0;
    var x = document.getElementById("Course_CName");
<?php
    $sql = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['User_ID']}'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    if($row['Adm_Level']=='2'){
      $sql2 = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' AND `Teacher_CName` = '".$row['Name']."' GROUP BY `Year` ORDER BY `Year` ASC";
      $result2 = mysqli_query($con,$sql2);
      for($i=1; $i<=mysqli_num_rows($result2); $i++){
        $row2 = mysqli_fetch_assoc($result2);
        $Year = $row2['Year'];
      

        echo "if(Year=='".$Year."'){\n";
              
                $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Hide`='0' AND `Teacher_CName` = '".$row['Name']."'  AND `Year` = '".$Year."'";
                $result3 = mysqli_query($con,$sql3);
                for($j=1; $j<=mysqli_num_rows($result3); $j++){
                  $row3 = mysqli_fetch_assoc($result3);
                  echo "var option=document.createElement(\"option\");\n";
                  echo "option.text = \" {$row3['Course_CName']}\";\n";
                  echo "option.value = \"{$row3['Course_CName']}\";\n";
                  echo "x.add(option);\n";
                }
                if (isset($_SESSION['Year_2']))
                  if ($_SESSION['Year_2']== $Year)
                    echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_2']}\";";
              echo "}\n";
      }    
    } elseif ($row['Adm_Level']=='1') {
      $sql2 = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC ";
      $result2 = mysqli_query($con,$sql2);
      for($i=1; $i<=mysqli_num_rows($result2); $i++){
        $row2 = mysqli_fetch_assoc($result2);
        $Year = $row2['Year'];
      

        echo "if(Year=='".$Year."'){\n";
              
                $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Hide`='0'  AND `Year` = '".$Year."'";
                $result3 = mysqli_query($con,$sql3);
                for($j=1; $j<=mysqli_num_rows($result3); $j++){
                  $row3 = mysqli_fetch_assoc($result3);
                  echo "var option=document.createElement(\"option\");\n";
                  echo "option.text = \" {$row3['Course_CName']}\";\n";
                  echo "option.value = \"{$row3['Course_CName']}\";\n";
                  echo "x.add(option);\n";
                }
                if (isset($_SESSION['Year_3']))
                  if ($_SESSION['Year_3']== $Year)
                    echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_3']}\";";
              echo "}\n";
      }    
    }
?>
  }
</script>