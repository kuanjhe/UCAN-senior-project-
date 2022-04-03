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
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $User_ID = $_POST['username'];
  $Name = $_POST['name'];
  $Password = $_POST['password'];
  $password2 = $_POST['password2'];
  $Email = $_POST['email'];

  $sql = "SELECT * FROM `member` where `User_ID` = '$User_ID'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);

        echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
        echo '<td align=center>';
        echo '<font size=5 face="微軟正黑體">';

if($row['User_ID'] == $User_ID)
{
         echo '學號已經被註冊過<br>若您的學號仍未註冊請洽學務處<br>';
         echo '頁面將自動跳轉<br><br>';
         echo '<meta http-equiv=REFRESH CONTENT=7;url=register.php>';
         echo '(<a href="register.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
}
else if($Password == $password2)
{
        //新增資料進資料庫語法
        $sql = "INSERT INTO `member` (`User_ID`, `Name`, `Password`, `Adm_Level`,`Username`,`Email`,`Built_Time`) VALUES ('$User_ID', '$Name', '$Password', '0','$User_ID','$Email',CURRENT_TIME())";
        if(mysqli_query($con,$sql))
        {
                echo '帳號申請成功<br>';
                echo '頁面將自動跳轉<br><br>';
                echo '<meta http-equiv=REFRESH CONTENT=7;url=login.php>';
                echo '(<a href="login.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
                
        }
        else
        {
                echo '帳號申請失敗<br>';
                echo '頁面將自動跳轉<br><br>';
                echo '<meta http-equiv=REFRESH CONTENT=7;url=register.php>';
                echo '(<a href="register.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
        }
}
else if($Password != $password2)
{
                echo '密碼前後不相符<br>';
                echo '頁面將自動跳轉<br><br>';
                echo '<meta http-equiv=REFRESH CONTENT=7;url=register.php>';
                echo '(<a href="register.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
}
}
else
{
        echo '您無權限觀看此頁面<br>';
        echo '<meta http-equiv=REFRESH CONTENT=7;url=register.php>';
        echo '(<a href="register.php">若畫面未跳轉，請點此跳轉。</a>)<br>';
}
        echo '</font>';
        echo '</td>';
        echo '</table>';
?>
