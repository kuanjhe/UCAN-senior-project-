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
<body style="font-family: DFKai-sb;" onload="produce_course()">
<?php
  include("header.php");
?>
<div class="container">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">     
    <div class="container">
      <h2 style="text-align:center;">課程問卷查詢</h2>
      <form id="course_table" action="create_radar.php" method="POST">
        <div class="form-group">
          <label for="Teacher_CName"><h4>請選擇任課老師:</h4></label>
          <select class="form-control" id="Teacher_CName" name="Teacher_CName" onclick="produce_course()">
          <?php
            $sql="SELECT Teacher_CName FROM `course_list` ";
            $result = mysqli_query($con,$sql);
            for($i=1; $i<=mysqli_num_rows($result); $i++){
              $row = mysqli_fetch_assoc($result);
              $_SESSION['Teacher_CName']=$row['Teacher_CName'];
              echo "<option value=\"".$row['Teacher_CName']."\">".$row['Teacher_CName']."</option>\n";
            }
          ?>
          </select>
        </div>
        <div class="form-group">
          <label for="Course_CName"><h4>請選擇課程名稱:</h4></label>
          <select class="form-control" id="Course_CName" name="Course_CName">
          <?php
            $sql="SELECT Course_CName FROM `course_list` WHERE `Teacher_CName` = '".$_SESSION['Teacher_CName']."'";
            $result = mysqli_query($con,$sql);
            for($i=1; $i<=mysqli_num_rows($result); $i++){
                  $row = mysqli_fetch_assoc($result);
                  $_SESSION['Course_CName']=$row['Course_CName'];
                  echo "            <option value=\"".$row['Course_CName']."\">".$row['Course_CName']."</option>\n";
                }
          ?>
          </select>
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
<script type="text/javascript">
  function produce_course(){
    var Teacher_CName = document.getElementById("Teacher_CName").value;
    document.getElementById("Course_CName").length=0;
    var x = document.getElementById("Course_CName");
<?php
    $sql = "SELECT `Teacher_CName` FROM `course_list` WHERE `Hide`='0'";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    $Teacher_CName = $row['Teacher_CName'];
    
    echo "if (Teacher_CName=='".$Teacher_CName."'){\n";
    $sql2 = "SELECT `Course_CName` FROM `course_list` WHERE `Hide`='0' AND `Teacher_CName` = '".$row['Teacher_CName']."'";
    $result2 = mysqli_query($con,$sql2);
    for($j=1; $j<=mysqli_num_rows($result2); $j++){
      $row2 = mysqli_fetch_assoc($result2);
      echo "var option=document.createElement(\"option\");\n";
      echo "option.text = \" {$row2['Course_CName']}\";\n";
      echo "option.value = \"{$row2['Course_CName']}\";\n";
      echo "x.add(option);\n";
    }
    if ((isset($_SESSION['Course_CName_2']))&(isset($_SESSION['Teacher_CName_2'])))
      if (($_SESSION['Teacher_CName_2']== $Teacher_CName)||($_SESSION['Year_2']== $Year))
        echo "document.getElementById(\"Course_CName\").value = {$_SESSION['Course_CName_2']};";
    echo "}\n";
  }
  
?>
  }
</script>