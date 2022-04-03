<?php session_start(); ?>
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
include('header.php');
include("mysql_connect_inc.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql1 = "SELECT * FROM `member` WHERE `username`='$username'";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);

      echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
      echo '<td align=center>';
      echo '<font size=5 face="微軟正黑體">';

    if ((mysqli_num_rows($result1)==0) or ($username!=$row1['username'])){
      echo "帳號不存在<br>";
      echo "請重新輸入<br>";
      echo "<meta http-equiv=REFRESH CONTENT=2;url=index.php>";
    } else{
      $sql2 = "SELECT * FROM `member` WHERE `username`='$username' and `password`='$password'";
      $result2 = mysqli_query($con,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      if ((mysqli_num_rows($result2)==0) or ($password!=$row2['password'])){
        echo "密碼不正確！<br>";
        echo "請重新輸入<br>";
        echo "<meta http-equiv=REFRESH CONTENT=2;url=index.php>";
      } else {
        if ($row2['adm_level']!='0'){
          $_SESSION['login_RNuikEEFpDrrjTQ']="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh";
          $_SESSION["display_top_side_bar"]=0;
          $_SESSION["left_side_bar"]=1;
          
          echo "歡迎 {$row2['name']} 登入<br><br>";
          echo "五秒後轉入首頁<br>";
          echo "<meta http-equiv=REFRESH CONTENT=5;url=index.php>";
          echo '(<a href="index.php">若畫面未跳轉，請點此跳轉。</a>)<br>';

        } else {
          $_SESSION['name'] = $row2['name'];
          $_SESSION['login_RNuikEEFpDrrjTQ']="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999";
          $_SESSION['Username'] = $username;
          $_SESSION["display_top_side_bar"]=1;
          $_SESSION["left_side_bar"]=0;

          echo "歡迎 {$row2['name']} 登入<br>";
          echo "三秒後轉入個人首頁<br><br>";        
          echo '<meta http-equiv=REFRESH CONTENT=3;url=student/user_interface.php>';
          echo '(<a href="student/user_interface.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
        }
        
      }
    }
  } else {
      echo "五秒後轉入首頁<br>";
    echo "<meta http-equiv=REFRESH CONTENT=0;url=index.php>";
  }
     echo '</font>';
         echo '</td>';
         echo '</table>';
?>