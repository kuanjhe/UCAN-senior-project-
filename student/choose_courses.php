<?php
  session_start();
  include('mysql_connect_inc.php');
  if  (isset($_SESSION['login_RNuikEEFpDrrjTQ999'])){
    if ($_SESSION['login_RNuikEEFpDrrjTQ999']!="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999"){
      echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
    }
  } else
    echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
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
    <style type="text/css">
      .additional{
        text-align: center;
        color: red;
      }
    </style>
</head>
<body style="font-family: DFKai-sb;" onload="default_teacher()">
<?php
  include("header.php");
?>
<div class="container">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">     
    <div class="container">
      <h2 style="text-align:center;">課程問卷調查</h2>
      <form id="course_table" action="survey/survey-single.php" method="POST">
        <div class="form-group">
          <label for="Course_CName"><h4>請選擇課程名稱:</h4></label>
          <select class="form-control" id="Course_CName" name="Course_CName">
          <?php
            $sql="SELECT Course_ID FROM `student_list` WHERE `StudentID` = '".$_SESSION['Username']."' AND Hide = 1";/*Hide:1(總評),0(各課程)*/
            $result = mysqli_query($con,$sql);
            for($i=1; $i<=mysqli_num_rows($result); $i++){
                  $row = mysqli_fetch_assoc($result);
                  $sql2="SELECT Course_CName,Year FROM `course_list` WHERE `Course_ID` ='".$row['Course_ID']."'";
                  $result2 = mysqli_query($con,$sql2);
                  $row2 = mysqli_fetch_assoc($result2);
                  echo "            <option value=\"".$row2['Course_CName']."\">".$row2['Year']."-".$row2['Course_CName']."</option>\n";
                  $_SESSION['quction']=0;
                }
          ?>
          </select>
          <?php
          if(0==mysqli_num_rows($result))
              echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
            ?>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">送出選擇</button>
        </div>
      </form>
    </div>
   </div>
  </div>
</div>
</body>