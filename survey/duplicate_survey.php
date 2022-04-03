<?php
      session_start();
    include('mysql_connect_inc.php');
  //  include('header_php_1.php');
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
            include('header.php');

            $sql = "SELECT `Course_CName` FROM `course_list` WHERE `Course_ID`='{$_SESSION['Course_ID']}'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);

            $sql2 = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['survey_student_id']}'";
            $result2 = mysqli_query($con,$sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '<table border=0 background="register_back.png" width=480 height=380 align=center>';
            echo '<td align=center>';
            echo '<font size=5 face="微軟正黑體">';
            
            if($row2['Adm_Level']==0){
              echo "學號";
              echo ":{$_SESSION['survey_student_id']}<br>已填答，";
              echo $row['Course_CName'];
              echo "之課程調查<br>";
              echo "如欲修改請詢問工作人員!<br><br>";
            }elseif($row2['Adm_Level']==1){
              echo "{$row2['Name']}管理者<br>
                    完成{$row['Course_CName']}之課程能力設定<br>";
            }else{
              echo "{$row2['Name']}老師<br>
                    完成{$row['Course_CName']}之課程能力設定<br>
                    如欲修改請至課程能力頁面<br>";
            }
            
            unset($_SESSION['survey_student_id']);
    
            echo "五秒後轉入首頁<br>";
            echo "<meta http-equiv=REFRESH CONTENT=5;url=../index.php>";
            echo '</font>';
            echo '</td>';
            echo '</table>';
?>