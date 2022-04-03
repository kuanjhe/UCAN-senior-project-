<?php
    session_start();
    include('mysql_connect_inc.php');
    include('header_php.php');
    include("header.php");
    if (!isset($_SESSION['Course_ID'])){
      echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
    } else{
      $Course_ID = $_SESSION['Course_ID'];
      $sql = "SELECT * FROM `course_list` WHERE `Course_ID`='$Course_ID'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      $site_name=$row['Course_CName'];
      $number_survey_items=$row['number_survey_items']-1;
      if (empty($row['Survey_ID'])){
        echo "<meta http-equiv=REFRESH CONTENT=0;url=undefined.php>";
      }else{
        $Survey_ID=$row['Survey_ID'];
      }
    }
?>
<!DOCTYPE html>
<html>
<title>課程問卷</title>
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
        $sql = "SELECT * FROM `survey_result` WHERE `Survey_ID`='{$Survey_ID}' AND `UserID`='{$_SESSION['survey_student_id']}'";
        $result = mysqli_query($con,$sql);
        $sql3 = "SELECT * FROM `student_list` WHERE `Course_ID`='{$Course_ID}' AND `StudentID`='{$_SESSION['survey_student_id']}'";
        $result3 = mysqli_query($con,$sql3);
        $row3 = mysqli_fetch_assoc($result3);

        $sql4 = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['survey_student_id']}'";
        $result4 = mysqli_query($con,$sql4);
        $row4 = mysqli_fetch_assoc($result4);

        
        if(mysqli_num_rows($result)>=1){

          echo "<meta http-equiv=REFRESH CONTENT=0;url=duplicate_survey.php>";
        }
        

        

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
    if (isset($_POST['fill'])){
      if ($_POST['fill']!='')
      $_SESSION['survey_item_results'][]=$_POST['fill'];
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

	<div class="container">
		<div class="row">
      <?php 
        include("left_side_bar.php");
      ?>
        <div class="col-sm-9"><p style="font-size: x-large">
<?php
  if (empty($_SESSION['survey_student_id'])){
    unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
  }
  if (!isset($_SESSION['survey_item_results'])){
    $_SESSION['survey_item_results']=array();
    $_SESSION['survey_item_no_id']=array();
    $sql = "SELECT * FROM survey_item_name WHERE 1";
    $result = mysqli_query($con,$sql);
    if(isset($number_survey_items)){
      for($i=1; $i<=min(mysqli_num_rows($result),$number_survey_items); $i++){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['survey_item_no_id'][]=$row['ID'];
      }
    }

    $sql4 = "SELECT * FROM member WHERE `User_ID`='{$_SESSION['User_ID']}'";
    $result4 = mysqli_query($con,$sql4);
    $row4 = mysqli_fetch_assoc($result4);

    $sql5 = "SELECT * FROM course_list WHERE `Course_ID`='{$Course_ID}'";
    $result5 = mysqli_query($con,$sql5);
    $row5 = mysqli_fetch_assoc($result5);

    $sql = "SELECT * FROM `survey_result` WHERE `Survey_ID`='{$Survey_ID}' AND `UserID`='{$_SESSION['User_ID']}'";
    $result = mysqli_query($con,$sql);

    if($row4['Adm_Level']!=0){
      if(mysqli_num_rows($result)>=1){
        echo "  <div class=\"form-group\" style=\"font-size: x-large\" align=\"center\">";
        echo "<h4>{$row4['Name']}";if($row4['Adm_Level']==1){echo "管理者";}else{echo "老師";}echo "已填寫 {$row5['Course_CName']}    課程問卷</h4><br><br>";
      }else{
        echo "<form id=\"myForm\" action=\"\" method=\"post\">";
        echo "  <div class=\"form-group\" style=\"font-size: x-large\" align=\"center\">";
        echo "{$row4['Name']}";if($row4['Adm_Level']==1){echo "管理者";}else{echo "老師";}echo "填寫 {$row5['Course_CName']} 課程問卷<br><br>";
        echo "    <input type=\"hidden\" class=\"form-control form-control-lg\" name=\"survey_student_id\" value=\"{$_SESSION['User_ID']}\" id=\"survey_student_id\" required>";
        echo "  <input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"填寫問卷\">";
?>
&nbsp;&nbsp;
<?php
        echo "</div>";
        echo "</form>";
      }
      
    }else{
      echo "<form id=\"myForm\" action=\"\" method=\"post\">";
      echo "  <div class=\"form-group\" style=\"font-size: x-large\">";
      echo "      <label for=\"survey_student_id\">學號:（範例:1042688）</label>";
      echo "      <input type=\"text\" class=\"form-control form-control-lg\" name=\"survey_student_id\" id=\"survey_student_id\" required>";
      echo "  </div>";
      echo "  <input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"開始\">";
?>
&nbsp;&nbsp;
<?php
      echo "</form>";
      }
    
  } else {
    if ($number_survey_items<=count($_SESSION['survey_item_results'])) {
      

      echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
      echo '<td align=center>';
      echo '<font size=5 face="微軟正黑體">';
      echo "恭喜您完成{$site_name}的問卷，<br>";
      echo "在此感謝您的協助!<br><br>";
      echo "十秒後轉入首頁<br>";
      echo "<meta http-equiv=REFRESH CONTENT=5;url=../index.php>";
      echo '(<a href="../index.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
      echo '</font>';
      echo '</td>';
      echo '</table>';
      date_default_timezone_set("Asia/Taipei");
      $record_ime = date("Y:m:d H:i:s",time());

      $sql2 = "SELECT * FROM member WHERE `User_ID`='{$_SESSION['survey_student_id']}'";
      $result2 = mysqli_query($con,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $Adm_Level=$row2['Adm_Level'];
      if($Adm_Level=='2'){
        $sql ="INSERT INTO `survey_result` (`ID`, `Survey_ID`, `UserID`,`Teacher`, `Time`, `Hide`) VALUES (NULL, '$Survey_ID', '{$_SESSION['survey_student_id']}','1','$record_ime','0')";
      }else{
        $sql ="INSERT INTO `survey_result` (`ID`, `Survey_ID`, `UserID`, `Time`, `Hide`) VALUES (NULL, '$Survey_ID', '{$_SESSION['survey_student_id']}','$record_ime', '0')";
      }
      
      mysqli_query($con,$sql);
      $sql = "UPDATE `survey_result` SET `item_".sprintf('%02d',1)."`='{$_SESSION['survey_item_results'][0]}'";
      for ($i=1; $i < $number_survey_items; $i++) {
        $sql =$sql.", `item_".sprintf('%02d',$i+1)."`='{$_SESSION['survey_item_results'][$i]}'";
      }
      $sql = $sql ." WHERE `ID`='".mysqli_insert_id($con)."'";
      mysqli_query($con,$sql);
      unset($_SESSION['survey_item_results']);
      unset($_SESSION['survey_student_id']);
    } else {
  $survey_item_results=$_SESSION['survey_item_results'];
  $survey_item_no=count($_SESSION['survey_item_results']);
?>
          <h2><?php if(isset($_SESSION['survey_student_id'])){
            $sql = "SELECT * FROM member WHERE `User_ID`='{$_SESSION['survey_student_id']}'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            if($row['Adm_Level']==0){
              echo "學生 ".$row['Name'];
            }elseif ($row['Adm_Level']==1) {
              echo "管理者 ".$row['Name'];
            }else{
              echo $row['Name']." 老師";
            }
            }?>
           </h2><h2>第<?php echo ($survey_item_no+1)?>題</h2>
<?php   
  $sql = "SELECT * FROM survey_item_name WHERE `ID`='{$_SESSION['survey_item_no_id'][$survey_item_no]}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
?>   
          <h2><?php echo $row['Problem_CName']?></h2>
          <form id="myForm" action="" method="post">
<?php  
  $number_items = $row['number_items'];
  $item_type = $row['item_type'];
  if ($item_type==1){
    $sql = "SELECT * FROM `survey_item_list` WHERE `survey_item_id`='{$row['ID']}'";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items; $i++) {
      $row = mysqli_fetch_assoc($result); 
      $j=$i+1;
      echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt1\" value=\"$j\" required>{$row['Option_CName']}</label>\n";
    }
  } 
  if($item_type==2){
        $Option_CName=array('否','是');
        $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
        $result = mysqli_query($con,$sql);
        for ($i=0; $i < 2; $i++) {
          $row = mysqli_fetch_assoc($result); 
          $j=$i+1;
          echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt2\" value=\"$j\" required>{$Option_CName[$i]}</label>\n";
        }
  } 
  if($item_type==3){
        echo "<div class=\"form-group\">";
        echo "<label for=\"comment\"></label>";
        echo "<textarea class=\"form-control form-control-lg\" rows=\"5\" name=\"comment\" id=\"comment\"></textarea>";
        echo "</div>";
  } 
  if ($item_type==4){

    echo "<div class=\"form-group\">";
    echo "<label for=\"fill\"></label>";
    echo "<input type=\"text\" name=\"fill\" id=\"fill\">";
    echo "</div>";
    
  }
  if ($item_type==5){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items-1; $i++) {
      $row = mysqli_fetch_assoc($result); 
      $j=$i+1;
      echo "<label class=\"checkbox-inline form-control form-control-lg\"><input type=\"checkbox\" name=\"opt5[]\" value=\"$j\">{$row['Option_CName']}</label>\n";
    }
    $row = mysqli_fetch_assoc($result);
    $i = $number_items;
    echo "<label class=\"checkbox-inline form-control form-control-lg\"><input type=\"checkbox\" name=\"opt5[]\" value=\"$i\" onclick=\"myFunction5()\">{$row['Option_CName']}</label>\n";
    echo "<input type=\"text\" class=\"form-control form-control-lg\" name=\"additional5\" id=\"additional5\" style=\"visibility:hidden\">\n";
  }
  if ($item_type==6){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items; $i++) {
      $row = mysqli_fetch_assoc($result); 
      $j=$i+1;
      echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt6\" value=\"$j\" onclick=\"myFunction6($j)\" required>{$row['Option_CName']}</label>\n";
      echo "<input type=\"text\" class=\"form-control form-control-lg\" name=\"additional6{$j}\" id=\"additional6{$j}\" style=\"visibility:hidden\">\n";
    }
  }
?>
          </p>
          <p><input class="btn btn-info" role="button" type="submit" value="下一題"></p>
          </form>
          <p><a href="reset_survey_single_result.php?Course_ID=<?php echo $Course_ID?>" class="btn btn-info">重新填寫</a></p>

<?php
    }
  }
?>

			  </div>
			  <p></p>
		</div>
	</div>
</body>
</html>