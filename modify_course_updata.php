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

      $sql = "UPDATE `course_list` SET `Year` = '$Year', `Course_Category` = '$Course_Category',`Learn_Hour`='$Learn_Hour', `Course_CName` = '$Course_CName', `Course_ID` = '$Course_ID', `Course_College` = '$Course_College', `Course_Department` = '$Course_Department', `Course_Grade` = '$Course_Grade', `Course_Hour` = '$Course_Hour', `Teacher_CName` = '$Teacher_CName' WHERE `ID` = '".$_SESSION['ID']."'";
      if (mysqli_query($con,$sql)){
        $sql = "SELECT * FROM `course_list` WHERE `ID`='".$_SESSION['ID']."'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        echo "課程內容修改成功!<br>";
        echo "永久課號:";
        echo "{$row['Course_ID']}<br>";
        echo "課程名稱:";
        echo "{$row['Course_CName']}<br>";
        echo "<meta http-equiv=REFRESH CONTENT=5;url=index.php>";
        echo '(<a href="index.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
      } else {
        echo "課程內容修改失敗!<br><br>";
        echo "<meta http-equiv=REFRESH CONTENT=5;url=modify_course.php>";
        echo '(<a href="modify_course.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
      }
}
  echo '</font>';
  echo '</td>';
  echo '</table>';
?>