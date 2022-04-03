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
<body style="font-family: DFKai-sb;" onload="default_teacher() ">
<?php
  include("header.php");
?>
<div class="container" style="height: 700px">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">     
    <div class="container">
      <h2 style="text-align:center;">課程確認</h2>
      <form id="course_table" action="" method="POST">
        <div class="form-group">
          <label for="Course_CName"><h4>請選擇有修課之課程:</h4></label>
          <select class="form-control" id="Course_CName" name="Course_CName" length="5">
          <?php
            $sql="SELECT Course_CName,Year FROM `course_list`where Hide = 0";
            $result = mysqli_query($con,$sql);
            for($i=1; $i<=mysqli_num_rows($result); $i++){
                  $row = mysqli_fetch_assoc($result);
                  echo "            <option value=\"".$row['Course_CName']."\">".$row['Year']."-".$row['Course_CName']."</option>\n";
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
  <?php
if(isset($_POST["Course_CName"])){
  $check=0;
  $sql1 = "SELECT `Course_ID`FROM `course_list` WHERE `Course_CName`='".$_POST['Course_CName']."'";
  $result = mysqli_query($con,$sql1);
  $row = mysqli_fetch_assoc($result);

  $sql2 = "SELECT `Course_ID`,`Student_check` FROM `student_list` WHERE `StudentID` = {$_SESSION['Username']}";
  $result2 = mysqli_query($con,$sql2);
  while($row2 = mysqli_fetch_assoc($result2)){
    if($row['Course_ID']==$row2['Course_ID']){
      if($row2['Student_check']==1)
      echo $_POST["Course_CName"]."已確認";
    else
    {
      $sql="UPDATE student_list SET Student_check=1 WHERE Course_ID={$row2['Course_ID']} and StudentID={$_SESSION['Username']}";
      mysqli_query($con,$sql);
      echo $_POST["Course_CName"]."完成確認";
    } 
      $check=1;
    }
  }
  if($check==0){
    $record_ime = date("Y:m:d H:i:s",time());
    $sql ="INSERT INTO `student_list` (`ID`, `StudentID`, `Course_ID`, `Student_check`, `Teacher_check`, `Survey`, `Survey_Teacher`, `Grade`, `Time`, `Hide`) VALUES (NULL, '{$_SESSION['Username']}', '{$row['Course_ID']}','1','0','0','0','0','$record_ime', '0')";
    mysqli_query($con,$sql);
    echo $_POST["Course_CName"]."已完成確認";
  }
}
?>
</div>
</body>

