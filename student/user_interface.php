<?php session_start();
include('mysql_connect_inc.php');
if  (isset($_SESSION['login_RNuikEEFpDrrjTQ999'])){
  if ($_SESSION['login_RNuikEEFpDrrjTQ999']!="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh999")
    echo "<meta http-equiv=REFRESH CONTENT=0;url=../login.php>";
} else
    echo "<meta http-equiv=REFRESH CONTENT=0;url=../login.php>";
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
include('header.php');
?>
<div class="row">
  <div class="col-lg-1"></div>
  <div  class="col-lg-10" >
    <table width=100% border=2 align=center cellpadding=0 cellspacing=0>
      <tr>
      <td>學年度</td>
      <td>課名</td>
      <td>授課老師</td>
      <td>學生修課確認</td>
      <td>老師修課確認</td>
      <td>刪除</td></tr>
    <?php
      $sql="SELECT Course_ID,Survey,Student_check,Teacher_check,ID FROM `student_list` WHERE `StudentID` = '".$_SESSION['Username']."'";
      $result = mysqli_query($con,$sql);
      if(isset($_GET['del'])){
        $a=$_GET['del'];
        $s="delete from student_list where ID=$a";
      mysqli_query($con,$s);
      echo "<meta http-equiv=REFRESH CONTENT=0;url=user_interface.php>";
      }

      while($row = mysqli_fetch_array($result)){
        $sql2="SELECT Course_CName,Teacher_Cname,Year FROM `course_list` WHERE `Course_ID` = $row[0] AND Hide = 0";
        $result2 = mysqli_query($con,$sql2);
        while($row2 = mysqli_fetch_array($result2)){
          echo "<tr>
          <td>$row2[2]</td>
          <td>$row2[0]</td>
          <td>$row2[1]</td>";
          if($row[2]==0)
            echo "<td>尚未確認</td>";
          else
            echo "<td>已確認</td>";
          
          if($row[3]==0)
            echo "<td>尚未確認</td>";
          else
            echo"<td>已確認</td>";
          echo"<td><a href=user_interface.php?del=$row[4] onclick='return confirm(\"是否確定要執行這個動作？\")'>刪除</a></td></tr>";
        }
      }
    ?>
    </table>
  </div>
  <div class="col-lg-1"></div>
</div>
</body>
</html>



