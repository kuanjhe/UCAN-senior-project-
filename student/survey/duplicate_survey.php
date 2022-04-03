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
    
  echo "<div class=\"jumbotron text-center\">\n";
  echo "<h1>國立嘉義大學應用數學系</h1>\n";
  include_once('../phpqrcode/qrlib.php');
  if (!file_exists("../QRCode/QRCode_System.png")){
    QRcode::png("http://120.113.174.17/student/s1042653/M20180503/index.php", "QRCode/QRCode_System.png");
  }
  echo "<p style=\"text-align:center\"><img src=\"../QRCode/QRCode_System.png\"></p>"; 
  if ($_SESSION['login_RNuikEEFpDrrjTQ999']=="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999"){
      echo "<a href=../user_interface.php>個人首頁</a>\r";
      echo "<a href=../user_interface.php>確認已填寫之課程問卷</a>\r";
      echo "<a href=../choose_teacher.php>查詢各課程評量分數</a>\r";
      echo "<a href=../logout.php>登出</a>\r";
  }
  echo "</div>\n";
    $sql = "SELECT `Course_CName` FROM `course_list` WHERE `Survey_ID`='{$_SESSION['Course_ID']}'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
	  echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
    echo '<td align=center>';
    echo '<font size=5 face="微軟正黑體">';
    echo "學號:{$_SESSION['Username']}<br>已填答，";
    echo $row[0];
    echo "之課程調查<br>";
    echo "如欲修改請詢問工作人員!<br><br>";
    unset($_SESSION['survey_student_id']);
    
    echo "五秒後轉入首頁<br>";
    echo "<meta http-equiv=REFRESH CONTENT=5;url=../user_interface.php>";
    echo '(<a href="../user_interface.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
    echo '</font>';
    echo '</td>';
    echo '</table>';
?>