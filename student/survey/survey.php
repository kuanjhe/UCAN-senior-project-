<?php
    session_start();
    include('mysql_connect.inc.php');
    include('header_php.php');
    $activity = $_SESSION['activity_id'];
    $additional_string = " and `Activity`='$activity'";
    $sql = "SELECT `CName`,`number_survey_items` FROM `activity_list` WHERE `ID`='$activity'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    $site_name=$row[0];
    $number_survey_items=$row[1];
    $sql = "SELECT `Survey` FROM `activity_list` WHERE `ID`='{$activity}'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    if ($row[0]==0){
    	echo "<meta http-equiv=REFRESH CONTENT=0;url=../add_survey.php>";
    }
?>
<!DOCTYPE html>
<html>
<title><?php echo $site_name?>問卷</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function myFunction4() {
        document.getElementById("additional4").style.visibility = "visible";
      }
      function myFunction41() {
        document.getElementById("additional4").style.visibility = "hidden";
        document.getElementById("additional4").value = "";
      }
      function myFunction5() {
        document.getElementById("additional5").style.visibility = "visible";
      }
      function myFunction6(a) {
        if (a==1){
          document.getElementById("additional61").style.visibility = "visible";
          document.getElementById("additional62").style.visibility = "hidden";
          document.getElementById("additional62").value = "";
        } else {
          document.getElementById("additional61").style.visibility = "hidden";
          document.getElementById("additional62").style.visibility = "visible";
          document.getElementById("additional61").value = "";
        }
      }      
    </script>
</head>
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['survey_student_id'])){
      if ($_POST['survey_student_id']!=''){
        $_SESSION['survey_student_id']=$_POST['survey_student_id'];
      } else {
        unset($_SESSION['survey_item_results']);
        unset($_SESSION['survey_student_id']);
      }
    }
    if (isset($_POST['opt1'])){
      if ($_POST['opt1']!='')
      $_SESSION['survey_item_results'][]=$_POST['opt1'];
    }
    if (isset($_POST['opt2'])){
      if ($_POST['opt2']!='')
      $_SESSION['survey_item_results'][]=$_POST['opt2'];
    }    
    if (isset($_POST['comment'])){
      if ($_POST['comment']!='')
      $_SESSION['survey_item_results'][]=$_POST['comment'];
    }
    if (isset($_POST['opt4'])){
      if ($_POST['opt4']!='')
      if (!empty($_POST['additional4'])){
        $_SESSION['survey_item_results'][]=$_POST['opt4'].';'.$_POST['additional4'];
      } else{
        $_SESSION['survey_item_results'][]=$_POST['opt4'];
      }

    }
    if (isset($_POST['opt5'])){
      if ($_POST['opt5']!=''){
        $opt5=implode("@",$_POST['opt5']);       
        if (!empty($_POST['additional5'])){
          $_SESSION['survey_item_results'][]=$opt5.';'.$_POST['additional5'];
        } else{
          $_SESSION['survey_item_results'][]=$opt5;
        }
      }
    }
    if (isset($_POST['opt6'])){
      if ($_POST['opt6']!=''){
        $opt6 = $_POST['opt6'].";".$_POST['additional61'].$_POST['additional62'];
        $_SESSION['survey_item_results'][]=$opt6;
      }
    }    
  }
?>


<body style="font-family: DFKai-sb;">
<?php
include('header.php');
?>
	<div class="container">
		<div class="row">
        <?php 
          include("../left_side_bar.php");
        ?>
        <div class="col-sm-9">
<?php
  //echo implode("@",array('test1','test2'));
  if (empty($_SESSION['survey_student_id'])){
    unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
  }
  if (!isset($_SESSION['survey_item_results'])){
    $_SESSION['survey_item_results']=array();
    $_SESSION['survey_item_no_id']=array();
    $sql = "SELECT * FROM survey_item_name WHERE `Activity`='$activity'";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=min(mysqli_num_rows($result),$number_survey_items); $i++){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['survey_item_no_id'][]=$row['ID'];
    }
    echo "<form id=\"myForm\" action=\"\" method=\"post\">";
    echo "<div class=\"form-group\">";
echo "      <label for=\"survey_student_id\">學號:（範例:1042688）</label>";
echo "      <input type=\"text\" class=\"form-control form-control-lg\" name=\"survey_student_id\" id=\"survey_student_id\" required>";
echo "    </div>";
echo "          <input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"開始\">";
echo "          </form>";
  } else {
    if ($number_survey_items<=count($_SESSION['survey_item_results'])) {
      echo "恭喜您完成{$site_name}的問卷，在此感謝您的協助!";
      //echo $survey_item_results_list;
      date_default_timezone_set("Asia/Taipei");
      $record_ime = date("Y:m:d H:i:s",time());
      $sql ="INSERT INTO `survey_result` (`ID`, `Activity`, `StudentID`, `Time`, `Hide`) VALUES (NULL, '$activity', '{$_SESSION['survey_student_id']}','$record_ime', '0')";
      mysqli_query($con,$sql);
      $sql = "UPDATE `survey_result` SET `item_".sprintf('%02d',1)."`='{$_SESSION['survey_item_results'][0]}'";
      for ($i=1; $i < $number_survey_items; $i++) {
        $sql =$sql.", `item_".sprintf('%02d',$i+1)."`='{$_SESSION['survey_item_results'][$i]}'";
      }
      $sql = $sql ." WHERE `ID`='".mysqli_insert_id($con)."'";
      //echo $sql;
      mysqli_query($con,$sql);
      unset($_SESSION['survey_item_results']);
      unset($_SESSION['survey_student_id']);
    } else {
        $survey_item_results=$_SESSION['survey_item_results'];
        $survey_item_no=count($_SESSION['survey_item_results']);
?>
          <h2><?php echo$_SESSION['survey_student_id']?>第<?php echo ($survey_item_no+1)?>題</h2>
<?php   
  $sql = "SELECT * FROM survey_item_name WHERE `Activity`='$activity' AND `ID`='{$_SESSION['survey_item_no_id'][$survey_item_no]}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
?>   
          <h2><?php echo $row['CName']?></h2>
          <form id="myForm" action="" method="post">
<?php  //echo $survey_item_no;
  $number_items = $row['number_items'];
  $value_template = "item_".($survey_item_no+1)."_";
  $item_type = $row['item_type'];
  if ($item_type==1){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items; $i++) {
      $row = mysqli_fetch_assoc($result); 
      //echo $row['chinese_name']."\n";
      $j=$i+1;
      echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt1\" value=\"$value_template$j\" required>{$row['chinese_name']}</label>\n";
    }
  } 
  if($item_type==2){
        $chinese_name=array('否','是');
        $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
        $result = mysqli_query($con,$sql);
        for ($i=0; $i < 2; $i++) {
          $row = mysqli_fetch_assoc($result); 
          //echo $row['chinese_name']."\n";
          $j=$i+1;
          echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt2\" value=\"$value_template$j\" required>{$chinese_name[$i]}</label>\n";
        }
  } 
  if($item_type==3){
        echo "<div class=\"form-group\">";
        echo "<label for=\"comment\"></label>";
        echo "<textarea class=\"form-control form-control-lg\" rows=\"5\" name=\"comment\" id=\"comment\"></textarea>";
        echo "</div>";
  } 
  if ($item_type==4){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items-1; $i++) {
      $row = mysqli_fetch_assoc($result); 
      //echo $row['chinese_name']."\n";
      $j=$i+1;
      echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt4\" value=\"$value_template$j\" onclick=\"myFunction41()\" required>{$row['chinese_name']}</label>\n";
    }
    $row = mysqli_fetch_assoc($result);
    $i = $number_items;
    echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt4\" value=\"$value_template$i\" onclick=\"myFunction4()\" required>{$row['chinese_name']}</label>\n";
    echo "<input type=\"text\" class=\"form-control form-control-lg\" name=\"additional4\" id=\"additional4\" style=\"visibility:hidden\">\n";
  }
  if ($item_type==5){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items-1; $i++) {
      $row = mysqli_fetch_assoc($result); 
      //echo $row['chinese_name']."\n";
      $j=$i+1;
      echo "<label class=\"checkbox-inline form-control form-control-lg\"><input type=\"checkbox\" name=\"opt5[]\" value=\"$value_template$j\">{$row['chinese_name']}</label>\n";
    }
    $row = mysqli_fetch_assoc($result);
    $i = $number_items;
    echo "<label class=\"checkbox-inline form-control form-control-lg\"><input type=\"checkbox\" name=\"opt5[]\" value=\"$value_template$i\" onclick=\"myFunction5()\">{$row['chinese_name']}</label>\n";
    echo "<input type=\"text\" class=\"form-control form-control-lg\" name=\"additional5\" id=\"additional5\" style=\"visibility:hidden\">\n";
  }
  if ($item_type==6){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items; $i++) {
      $row = mysqli_fetch_assoc($result); 
      //echo $row['chinese_name']."\n";
      $j=$i+1;
      echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt6\" value=\"$value_template$j\" onclick=\"myFunction6($j)\" required>{$row['chinese_name']}</label>\n";
      echo "<input type=\"text\" class=\"form-control\" name=\"additional6{$j}\" id=\"additional6{$j}\" style=\"visibility:hidden\">\n";
    }
  }
?>
          <p><input class="btn btn-info" role="button" type="submit" value="下一題"></p>
          </form>
          <p><a href="reset_survey_result.php" class="btn btn-info">重新填寫</a></p>
<?php
  /*echo "<h4>目前的結果:</h4>";
  for ($i=0; $i < $survey_item_no; $i++) { 
    echo "<h4>第".($i+1)."題為".$survey_item_results[$i]."</h4>\n";
  }
  //print_r($survey_item_results);
  
  /*if ($number_survey_items<=count($_SESSION['survey_item_results'])) {
    echo "恭喜您完成{$site_name}的問卷，在此感謝您的協助!";
    unset($_SESSION['survey_item_results']);
  } else {
    //$_SESSION['survey_item_results'][]="1";
    echo "<a href=\"survey.php\">下一題</a>";
  }*/
  //unset($_SESSION['survey_item_results']);
    }
  }
?>

			  </div>
			  <p></p>
		</div>
	</div>
</body>
</html>