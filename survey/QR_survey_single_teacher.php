<?php
    session_start();
    include('mysql_connect_inc.php');
    if (!isset($_SESSION['Course_ID'])){
      if (!$_GET['Course_ID']=='' && !$_GET['Survey_Teacher']==''){
        $Course_ID = $_GET['Course_ID'];
        $Survey_Teacher = $_GET['Survey_Teacher'];
        $_SESSION['Course_ID'] = $Course_ID;
        $sql = "SELECT `Course_CName`,`number_survey_teacher_items` FROM `course_list` WHERE `Course_ID`='$Course_ID'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_row($result);
        $site_name=$row[0];
        $number_survey_items=$row[1];
        $sql = "SELECT `Survey_Teacher` FROM `course_list` WHERE `Course_ID`='{$Course_ID}'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_row($result);
        if ($row[0]==0){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=undefined.php>";
        }
      }else{
        echo "<meta http-equiv=REFRESH CONTENT=10;url=jump_course.php>";
      }
    } else{
        $Course_ID = $_SESSION['Course_ID'];
        $sql = "SELECT `Course_CName`,`number_survey_teacher_items` FROM `course_list` WHERE `Course_ID`='$Course_ID'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_row($result);
        $site_name=$row[0];
        $number_survey_items=$row[1];
        $sql = "SELECT `Survey_Teacher` FROM `course_list` WHERE `Course_ID`='{$Course_ID}'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_row($result);
       if ($row[0]==0){
         echo "<meta http-equiv=REFRESH CONTENT=0;url=undefined.php>";
       }
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
  //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['survey_teacher_id'])){
      if ($_SESSION['survey_teacher_id']!=''){
       // $_SESSION['survey_teacher_id']=$_POST['survey_teacher_id'];
        $sql = "SELECT * FROM `survey_result` WHERE `Course_ID`='{$Course_ID}' AND `StudentID`='{$_SESSION['survey_teacher_id']}' AND `Teacher`='1'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>=1){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=duplicate_survey_teacher.php>";
        }

      }
    }
    if (isset($_POST['survey_teacher_id'])){
      if ($_POST['survey_teacher_id']!=''){
        $_SESSION['survey_teacher_id']=$_POST['survey_teacher_id'];
        $sql = "SELECT * FROM `survey_result` WHERE `Course_ID`='{$Course_ID}' AND `StudentID`='{$_SESSION['survey_teacher_id']}' AND `Teacher`='1'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>=1){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=duplicate_survey_teacher.php>";
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
  //}
?>


<body style="font-family: DFKai-sb;">
<?php
  echo "<div class=\"jumbotron text-center\">\n";
  echo "<h1>國立嘉義大學應用數學系</h1>\n";
  echo "<h3>{$site_name}問卷系統</h3>\n";
  include_once('../phpqrcode/qrlib.php');
  if (!file_exists("../QRCode/QRCode_System.png")){
    QRcode::png("http://120.113.174.17/student/s1042653/M20180517/index.php", "QRCode/QRCode_System.png");
  }
  echo "<p style=\"text-align:center\"><img src=\"../QRCode/QR_survey_{$_SESSION['Course_ID']}.png\"></p>"; 
  echo "</div>\n";
?>
  <div class="container">
    <div class="row">
      <?php 
        //include("left_side_bar.php");
      ?>
        <div class="col-sm-9"><p style="font-size: x-large">
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['username'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql1 = "SELECT * FROM `member` WHERE `username`='$username'";
      $result1 = mysqli_query($con,$sql1);
      $row1 = mysqli_fetch_assoc($result1);

      if ((mysqli_num_rows($result1)==0) or ($username!=$row1['username'])){
        echo "帳號不存在<br>";
        echo "請重新輸入<br>";
        echo "<meta http-equiv=REFRESH CONTENT=2;url=QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}>";
      } else{
        $sql2 = "SELECT * FROM `member` WHERE `username`='$username' and `password`='$password'";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
      if ((mysqli_num_rows($result2)==0) or ($password!=$row2['password'])){
        echo "密碼不正確！<br>";
        echo "請重新輸入<br>";
        echo "<meta http-equiv=REFRESH CONTENT=2;url=QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}>";
      } else {
        if ($row2['adm_level']!='0'){
          $_SESSION["display_top_side_bar"]=0;
          $_SESSION['survey_teacher_id'] = $username;
          $_SESSION["left_side_bar"]=1;
          $_SESSION['o5H4KY3Uz2']="V7oaOTu2xG";
          $_SESSION['o5H4KY3Uz2789']="V7oaOTu2xG789";
          $_SESSION['login_RNuikEEFpDrrjTQ']="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh";
          
          //echo "<meta http-equiv=REFRESH CONTENT=2;url=QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}>";
        } else {
          $_SESSION['name'] = $row2['name'];
          $_SESSION['survey_teacher_id'] = $username;
          $_SESSION['Username'] = $username;
          $_SESSION["display_top_side_bar"]=1;
          $_SESSION["left_side_bar"]=0;
          $_SESSION['o5H4KY3Uz2']="V7oaOTu2xG";
          $_SESSION['o5H4KY3Uz2789']="V7oaOTu2xG789";
          $_SESSION['login_RNuikEEFpDrrjTQ999']="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999";
            
          //echo "<meta http-equiv=REFRESH CONTENT=3;url=QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}>";
          }
        echo "<meta http-equiv=REFRESH CONTENT=0;url=QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}>";
        }
      }
    }
  }



  if  (!isset($_SESSION['o5H4KY3Uz2'])){
    
      echo "<form action=\"\" method=\"post\">";
        echo "<div class=\"form-group\">";
          echo "<label for=\"username\">使用者:</label>";
          echo "<input type=\"username\" class=\"form-control\" id=\"username\" name=\"username\">";
        echo "</div>";
        echo "<div class=\"form-group\">";
          echo "<label for=\"password\">密碼:</label>";
          echo "<input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\">";
        echo "</div>";
        echo "<button type=\"submit\" class=\"btn btn-default\">登入</button>";
?>&nbsp;&nbsp;
<?php
        echo "<a href=\"register.php\" class=\"btn btn-outline-info\" role=\"button\">申請帳號</a>";
?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
        echo "<a href=\"forget_pw.php\" class=\"btn btn-outline-dark\" role=\"button\">忘記密碼</a>";
     echo "</form>";
     
  }
  

  if (empty($_SESSION['survey_teacher_id'])){
    unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
  }

  if(isset($_SESSION['o5H4KY3Uz2'])){
    if($_SESSION['o5H4KY3Uz2']="V7oaOTu2xG"){
      if (!isset($_SESSION['survey_item_results'])){
    $_SESSION['survey_item_results']=array();
    $_SESSION['survey_item_no_id']=array();
    $sql = "SELECT * FROM survey_item_name WHERE `Course_ID`='$Course_ID' AND `Survey_Teacher`='1'";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=min(mysqli_num_rows($result),$number_survey_items); $i++){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['survey_item_no_id'][]=$row['ID'];
    }
    if((!isset($_SESSION['o5H4KY3Uz2789'])&&empty($_SESSION['survey_teacher_id']))||empty($_SESSION['survey_teacher_id'])){
      echo "<form id=\"myForm\" action=\"\" method=\"post\">";
      echo "<div class=\"form-group\" style=\"font-size: x-large\">";
      echo "      <label for=\"survey_teacher_id\">學號:（範例:1042688）</label>";
      echo "      <input type=\"text\" class=\"form-control form-control-lg\" name=\"survey_teacher_id\" id=\"survey_teacher_id\" required>";
      echo "    </div>";
      echo "          <input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"開始\">";
?>
      &nbsp;&nbsp;
<?php
      echo "          </form>";
}

  } else {
    if ($number_survey_items<=count($_SESSION['survey_item_results'])) {
      

      echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
      echo '<td align=center>';
      echo '<font size=5 face="微軟正黑體">';
      echo "恭喜您完成{$site_name}的問卷，<br>";
      echo "在此感謝您的協助!<br><br>";
      echo "五秒後轉入首頁<br>";
      if(isset($_SESSION['name'])){
        echo "<meta http-equiv=REFRESH CONTENT=5;url=../student/user_interface.php>";
      }else{
        echo "<meta http-equiv=REFRESH CONTENT=5;url=../index.php>";
      }
      echo '</font>';
      echo '</td>';
      echo '</table>';
      date_default_timezone_set("Asia/Taipei");
      $record_ime = date("Y:m:d H:i:s",time());

      $sql ="INSERT INTO `survey_result` (`ID`, `Course_ID`, `StudentID`,`Teacher`, `Time`, `Hide`) VALUES (NULL, '$Course_ID', '{$_SESSION['survey_teacher_id']}','1','$record_ime', '0')";
      mysqli_query($con,$sql);
      $sql = "UPDATE `survey_result` SET `item_".sprintf('%02d',1)."`='{$_SESSION['survey_item_results'][0]}'";
      for ($i=1; $i < $number_survey_items; $i++) {
        $sql =$sql.", `item_".sprintf('%02d',$i+1)."`='{$_SESSION['survey_item_results'][$i]}'";
      }
      $sql = $sql ." WHERE `ID`='".mysqli_insert_id($con)."'";
      mysqli_query($con,$sql);
      unset($_SESSION['survey_item_results']);
      unset($_SESSION['survey_teacher_id']);
    } else {
  $survey_item_results=$_SESSION['survey_item_results'];
  $survey_item_no=count($_SESSION['survey_item_results']);
?>
          <h2><?php if(isset($_SESSION['survey_teacher_id'])) echo "學生".$_SESSION['survey_teacher_id']?></h2><h2>第<?php echo ($survey_item_no+1)?>題</h2>
<?php   
  $sql = "SELECT * FROM survey_item_name WHERE `Course_ID`='$Course_ID' AND `ID`='{$_SESSION['survey_item_no_id'][$survey_item_no]}' AND `Survey_Teacher`='1'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
?>   
          <h2><?php echo $row['Problem_CName']?></h2>
          <form id="myForm" action="" method="post">
<?php  
  $number_items = $row['number_items'];
  $item_type = $row['item_type'];
  if ($item_type==1){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']} AND `Survey_Teacher`='1'";
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
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']} AND `Survey_Teacher` = '1'";
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
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']} AND `Survey_Teacher`='1'";
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
          <p><a href="reset_teacher_survey_result.php?Course_ID=<?php echo $Course_ID?>" class="btn btn-info">重新填寫</a></p>
<?php
    }
  }

    }
  }
?>

        </div>
        <p></p>
    </div>
  </div>
</body>
</html>