<?php
	session_start();
    include('mysql_connect_inc.php');
    include('header_php.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>學生課程意見調查</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="font-family: DFKai-sb;">
<?php
    $Course_ID=$_SESSION['Course_ID'];
    $sql = "SELECT `Course_CName`,`number_survey_items` FROM `course_list` WHERE `Course_ID`='$Course_ID'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    $site_name=$row[0];
    include('header.php');
    
	echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
    echo '<td align=center>';
    echo '<font size=5 face="微軟正黑體">';
    echo "{$site_name}問卷系統關閉中，<br>";
    echo "請詢問工作人員!<br><br>";
    
    echo "五秒後轉入首頁<br>";
    echo "<meta http-equiv=REFRESH CONTENT=5;url=../index.php>";
    echo '(<a href="../index.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
    echo '</font>';
    echo '</td>';
    echo '</table>';
?>
