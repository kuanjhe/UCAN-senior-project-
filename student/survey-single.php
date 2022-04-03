<?php
    session_start();
    include('mysql_connect_inc.php');
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   if(isset($_POST['Course_CName'])){
      $sql = "SELECT `Course_ID`FROM `course_list` WHERE `Course_CName`='".$_POST['Course_CName']."'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_row($result);
      $_SESSION['Course_ID']=$row[0];
      $Course_ID =$row[0];}

      $sql = "SELECT `Course_CName`,`number_survey_items` FROM `course_list` WHERE `Course_ID`='".$_SESSION['Course_ID']."'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_row($result);
      $site_name=$row[0];
      $number_survey_items=$row[1];

      $sql = "SELECT `Survey` FROM `course_list` WHERE `Course_ID`='".$_SESSION['Course_ID']."'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_row($result);
      if ($row[0]==0){
       
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
        $sql = "SELECT * FROM `survey_result` WHERE `Course_ID`='{$Course_ID}' AND `StudentID`='{$_SESSION['Username']}'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>=1){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=duplicate_survey.php>";
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
<?php
  echo "<div class=\"jumbotron text-center\">\n";
  echo "<h1>國立嘉義大學應用數學系</h1>\n";
  echo "<h3>{$site_name}問卷系統</h3>\n";
  include_once('../phpqrcode/qrlib.php');
  if (!file_exists("../QRCode/QRCode_System.png")){
    QRcode::png("http://120.113.174.17/student/s1042653/M20180503/index.php", "QRCode/QRCode_System.png");
  }
  echo "<p style=\"text-align:center\"><img src=\"../QRCode/QRCode_System.png\"></p>"; 
  if ($_SESSION['login_RNuikEEFpDrrjTQ999']=="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999"){
      echo "<a href=../user_interface.php>個人首頁</a>\r";
      echo "<a href=../user_interface.php>確認已填寫之課程問卷</a>\r";
      echo "<a href=../user_interface.php>查詢各課程評量分數</a>\r";
      echo "<a href=../logout.php>登出</a>\r";
  }
  echo "</div>\n";
?>
	<div class="container">
		<div class="row">
        
<?php
  if (!isset($_SESSION['survey_item_results'])){
    $_SESSION['survey_item_results']=array();
    $_SESSION['Usernamer']=array();
    $sql = "SELECT * FROM survey_item_name WHERE `Course_ID`='$Course_ID'";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=min(mysqli_num_rows($result),$number_survey_items); $i++){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['Usernamer'][]=$row['ID'];
      }
    } 
?>
&nbsp;&nbsp;
<?php
    if ($number_survey_items<=$_SESSION['quction']) {
      $_SESSION['quction']=0;
      echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
      echo '<td align=center>';
      echo '<font size=5 face="微軟正黑體">';
      echo "恭喜您完成{$site_name}的問卷，<br>";
      echo "在此感謝您的協助!<br><br>";
      echo "十秒後轉入首頁<br>";
      echo "<meta http-equiv=REFRESH CONTENT=5;url=../user_interface.php>";
      echo '(<a href="../user_interface.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
      echo '</font>';
      echo '</td>';
      echo '</table>';

      date_default_timezone_set("Asia/Taipei");
      $record_ime = date("Y:m:d H:i:s",time());

      $sql ="INSERT INTO `survey_result` (`ID`, `Course_ID`, `StudentID`, `Time`, `Hide`) VALUES (NULL, '$Course_ID', '{$_SESSION['Username']}','$record_ime', '0')";
      mysqli_query($con,$sql);
      $sql="UPDATE studentlist SET Survey=1 WHERE Course_ID='$Course_ID' AND StudentID='".$_SESSION['Username']."'";
      mysqli_query($con,$sql);
      $sql = "UPDATE `survey_result` SET `item_".sprintf('%02d',1)."`='{$_SESSION['survey_item_results'][0]}'";
      for ($i=1; $i < $number_survey_items; $i++) {
        $sql =$sql.", `item_".sprintf('%02d',$i+1)."`='{$_SESSION['survey_item_results'][$i]}'";
      }
      $sql = $sql ." WHERE `Course_ID`='$Course_ID' AND `StudentID`='{$_SESSION['Username']}'";
      mysqli_query($con,$sql);
      unset($_SESSION['survey_item_results']);
    } else {
  $survey_item_results=$_SESSION['survey_item_results'];}

  $sql = "SELECT * FROM `survey_result` WHERE `Course_ID`='{$Course_ID}' AND `StudentID`='{$_SESSION['Username']}'";
  $result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result)<1){
    echo"<div class='col-sm-9'><p style='font-size: x-large'>";
    echo "<h2>";
    if(isset($_SESSION['Username'])) echo "學生".$_SESSION['Username'];
    echo "</h2><h2>第";
    echo $_SESSION['quction']+1;
    echo "題</h2>";
 
  $sql = "SELECT * FROM survey_item_name WHERE `Course_ID`='$Course_ID' AND `ID`='{$_SESSION['Usernamer'][$_SESSION['quction']]}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
  
  echo "<h2>";
  echo $row['Problem_CName'];
  echo "</h2>";
  echo "<form id='myForm' action='' method='post'>";
  
  $_SESSION['quction']=$_SESSION['quction']+1;
  $number_items = $row['number_items'];
  $item_type = $row['item_type'];
  if ($item_type==1){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
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
          //echo $row['Option_CName']."\n";
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
    echo "<input type=\"text\" name=\"fill\" id=\"fill\" required>";
    echo "</div>";
  }
  if ($item_type==5){
    $sql = "SELECT * FROM survey_item_list WHERE survey_item_id = {$row['ID']}";
    $result = mysqli_query($con,$sql);
    for ($i=0; $i < $number_items-1; $i++) {
      $row = mysqli_fetch_assoc($result); 
      //echo $row['Option_CName']."\n";
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
      //echo $row['Option_CName']."\n";
      $j=$i+1;
      echo "<label class=\"radio-inline form-control form-control-lg\"><input type=\"radio\" name=\"opt6\" value=\"$j\" onclick=\"myFunction6($j)\" required>{$row['Option_CName']}</label>\n";
      echo "<input type=\"text\" class=\"form-control form-control-lg\" name=\"additional6{$j}\" id=\"additional6{$j}\" style=\"visibility:hidden\">\n";
    }
  }
echo" </p>
      <p><input class='btn btn-info' role='button' type='submit' value='下一題''></p>
      </form>
      <p><a href='reset_survey_single_result.php?Course_ID=<?php echo $Course_ID?>'' class='btn btn-info'>重新填寫</a></p>
			 </div>";
 }
?>
			  <p></p>
		</div>
	</div>
</body>
</html>