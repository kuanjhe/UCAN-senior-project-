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
  $sql = "SELECT * FROM `course_list` WHERE `Survey_ID`='{$_SESSION['Survey_ID']}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
  echo "學生 {$_SESSION['survey_student_id']} 並未修讀 {$row['Course_CName']}<br>";
  echo '請先登記修讀再填寫問卷<br>';
  unset($_SESSION['survey_student_id']);
  echo "<meta http-equiv=REFRESH CONTENT=6;url=../index.php>";
  echo '</font>';
  echo '</td>';
  echo '</table>';
?>