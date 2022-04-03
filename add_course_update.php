<?php
  session_start();
  include('mysql_connect_inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>學生課程意見調查</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="font-family: DFKai-sb;">
<?php
  include("header.php");

  echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
  echo '<td align=center>';
  echo '<font size=5 face="微軟正黑體">';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Year'])){
		  $Year = $_POST['Year'];
      $Course_Category = $_POST['Course_Category'];
      $Course_CName = $_POST['Course_CName'];
      $Course_ID = $_POST['Course_ID'];
      $Course_College = $_POST['Course_College'];
      $Course_Department = $_POST['Course_Department'];
      $Course_Grade = $_POST['Course_Grade'];
      $Course_Hour = $_POST['Course_Hour'];
      $Learn_Hour = $_POST['Learn_Hour'];
      $Teacher_CName = $_POST['Teacher_CName'];
      $Survey_ID = "{$Year}-{$Course_ID}";

      $sql = "SELECT * FROM `course_list` WHERE `Course_ID`='$Course_ID'";
      $result=mysqli_query($con,$sql);
      if (mysqli_num_rows($result)>=1){
        echo "課程名稱重複，請重新輸入!<br>";
        echo "<meta http-equiv=REFRESH CONTENT=5;url=add_course.php>";
        echo '(<a href="add_course.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
      } else {
        $sql2 = "INSERT INTO `course_list` (`ID`, `Year`, `Course_Category`, `Course_CName`, `Course_ID`, `Survey_ID`, `Course_College`, `Course_Department`, `Course_Grade`, `Course_Hour`,`Learn_Hour`, `Teacher_CName`, `Time`, `number_survey_items`) VALUES (NULL, '$Year', '$Course_Category', '$Course_CName', '$Course_ID', '$Survey_ID', '$Course_College', '$Course_Department', '$Course_Grade', '$Course_Hour','$Learn_Hour', '$Teacher_CName', CURRENT_TIME(), 53)";
        $_SESSION['success_insert_new_course']=mysqli_query($con,$sql2);
        if($_SESSION['success_insert_new_course']==1){
          $sql3 = "SELECT * FROM `course_list` WHERE `Course_ID`='$Course_ID'";
          $result3=mysqli_query($con,$sql3);
          $row3=mysqli_fetch_assoc($result3);
          echo "成功新增一門課程!<br>";
          echo "永久課號:";
          echo "{$row3['Course_ID']}<br>";
          echo "課程名稱:";
          echo "{$row3['Course_CName']}<br>";
          echo "<meta http-equiv=REFRESH CONTENT=5;url=add_course.php>";
          echo '(<a href="add_course.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
          unset($_SESSION['success_insert_new_course']);
        }else{
          echo "課程新增失敗!";
          echo "<meta http-equiv=REFRESH CONTENT=5;url=add_course.php>";
          echo '(<a href="add_course.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
        } 
      }
	}
}
  echo '</font>';
  echo '</td>';
  echo '</table>';
?>