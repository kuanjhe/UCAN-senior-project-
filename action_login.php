<?php session_start();
session_unset(); ?>
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
    $User_ID = $_POST['username'];
    $Password = $_POST['password'];
    $sql1 = "SELECT * FROM `member` WHERE `User_ID`='$User_ID'";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);

      echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
      echo '<td align=center>';
      echo '<font size=5 face="微軟正黑體">';

    if ((mysqli_num_rows($result1)==0) or ($User_ID!=$row1['User_ID'])){
      echo "帳號不存在<br>";
      echo "請重新輸入<br>";
      echo "<meta http-equiv=REFRESH CONTENT=2;url=login.php>";
    } else{
      $sql2 = "SELECT * FROM `member` WHERE `User_ID`='$User_ID' and `Password`='$Password'";
      $result2 = mysqli_query($con,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      if ((mysqli_num_rows($result2)==0) or ($Password!=$row2['Password'])){
        echo "密碼不正確！<br>";
        echo "請重新輸入<br>";
        echo "<meta http-equiv=REFRESH CONTENT=2;url=login.php>";
      } else {
        if ($row2['Adm_Level']=='1'){
          $_SESSION['User_ID'] = $User_ID;
          $_SESSION['login_RNuikEEFpDrrjTQ']="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh";
          $_SESSION["display_top_side_bar"]=0;
        //  $_SESSION['survey_student_id'] = $username;
          $_SESSION["left_side_bar"]=1;
          $_SESSION['o5H4KY3Uz2']="V7oaOTu2xG";
          
          echo "歡迎 {$row2['Name']} 登入<br><br>";
          echo "三秒後轉入首頁<br>";
          echo "<meta http-equiv=REFRESH CONTENT=3;url=index.php>";
          echo '(<a href="index.php">若畫面未跳轉，請點此跳轉。</a>)<br>';

        } else if($row2['Adm_Level']=='0') {
          $_SESSION['name'] = $row2['Name'];
          $_SESSION['login_RNuikEEFpDrrjTQ999']="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999";
          $_SESSION['Username'] = $User_ID;
          $_SESSION["display_top_side_bar"]=1;
          $_SESSION["left_side_bar"]=0;
          $_SESSION['o5H4KY3Uz2']="V7oaOTu2xG";
          $_SESSION['survey_student_id'] = $User_ID;

          echo "歡迎 {$row2['Name']} 登入<br>";
          echo "三秒後轉入個人首頁<br><br>";        
          echo '<meta http-equiv=REFRESH CONTENT=3;url=student/user_interface.php>';
          echo '(<a href="student/user_interface.php">若畫面未跳轉，請點此跳轉。</a>)<br>';

        } else if($row2['Adm_Level']=='2') {
          //$_SESSION['name'] = $row2['name'];
          $_SESSION['login_RNuikEEFpDrrjTQ']="84gt2E2fUtrKIxCzAtdjmNuKbpgPE1bPOxezdv7wEe3In";
          $_SESSION['User_ID'] = $User_ID;
          $_SESSION["display_top_side_bar"]=0;
        //  $_SESSION['survey_student_id'] = $username;
          $_SESSION["left_side_bar"]=1;
          $_SESSION['o5H4KY3Uz2']="V7oaOTu2xG";

          echo "歡迎 {$row2['Name']} 登入<br>";
          echo "三秒後轉入個人首頁<br><br>";        
          echo '<meta http-equiv=REFRESH CONTENT=3;url=index.php>';
          echo '(<a href="index.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
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