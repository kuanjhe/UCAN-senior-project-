<?php
  session_start();
  include('mysql_connect_inc.php');
  if  (isset($_SESSION['login_RNuikEEFpDrrjTQ'])){
    if ($_SESSION['login_RNuikEEFpDrrjTQ']!="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh"&&$_SESSION['login_RNuikEEFpDrrjTQ']!="84gt2E2fUtrKIxCzAtdjmNuKbpgPE1bPOxezdv7wEe3In"){
      echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
    }
  } else
    echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>選擇課程</title>
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
<body style="font-family: DFKai-sb;" onload="default_course()">
<?php
  include("header.php");
?>
  
<div class="container">
  <div class="row">
    <?php include("left_side_bar.php");?>
    <div class="col-sm-8">
      <?php
      if (isset($_SESSION['change_course'])){
        if ($_SESSION['change_course'] == "1"){
          $sql2 = "SELECT `Course_CName` FROM `course_list` WHERE `Course_CName` = '".$_SESSION['Course_CName_2']."'";
          $result2 = mysqli_query($con,$sql2);
          $row2 = mysqli_fetch_assoc($result2);
          echo "<h2 style=\"text-align:center;\">已經更改課程為</h2><h2 style=\"color:red;text-align:center\">{$row2['Course_CName']}</h2>";
          unset($_SESSION['change_course']);
        } 
      } else{
        if (isset($_SESSION['Course_CName_2'])){
          $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Course_CName` = '".$_SESSION['Course_CName_2']."'";
          $result3 = mysqli_query($con,$sql3);
          $row3 = mysqli_fetch_assoc($result3);
          echo "<h2 style=\"text-align:center;\">目前課程為</h2><h2 style=\"color:red;text-align:center\">{$row3['Course_CName']}</h2>";
        } else 
          echo "<h2 style=\"text-align:center;\">目前尚未選定任何課程</h2>";
      }
      ?>      
    <div class="container">
      <h2 style="text-align:center;">請選擇課程</h2>
      <form id="course_table" action="" method="POST">
          <div class="form-group">
              <label for="Year"><h4>請選擇課程學年度:</h4></label>
              <select class="form-control" id="Year" name="Year" onclick="produce_course()">
<?php
    $sql = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=mysqli_num_rows($result); $i++){
      $row = mysqli_fetch_assoc($result);
      if (isset($_SESSION['Year_2'])){
        if ($row['Year']==$_SESSION['Year_2']){
          echo "            <option value=\"".$row['Year']."\" selected>".$row['Year']."</option>\n";
        } else {
          echo "            <option value=\"".$row['Year']."\">".$row['Year']."</option>\n";
        } 
    } else{
        echo "            <option value=\"".$row['Year']."\">".$row['Year']."</option>\n";
      } 
    }
?>
              </select>
          </div>



          <div class="form-group">
              <label for="Course_CName"><h4>請選擇課程名稱:</h4></label>
              <select class="form-control" id="Course_CName" name="Course_CName">
<?php
  $sql = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['User_ID']}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);

  $sql = "SELECT `Course_CName` FROM `course_list` WHERE `Teacher_CName` = '".$row['Name']."'";
  $result = mysqli_query($con,$sql);
  for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    if (isset($_SESSION['Course_CName_2'])){
      if ($row['Course_CName']==$_SESSION['Course_CName_2']){
        echo "            <option value=\"".$row['Course_CName']."\" selected>".$row['Course_CName']."</option>\n";
      } else {
        echo "            <option value=\"".$row['Course_CName']."\">".$row['Course_CName']."</option>\n";
      } 
    }
  }
?>
              </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">送出選擇</button>
          </div>
      </form>
    </div>

</body>
</html>
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $Year = $_POST['Year'];
    $Course_CName = $_POST['Course_CName'];
    $_SESSION['change_course'] = "1";    
    $_SESSION['Year_2'] = $Year;
    $_SESSION['Course_CName_2'] = $Course_CName;
    if ((isset($_SESSION['Year_2']))&(isset($_SESSION['Course_CName_2']))){
      $sql = "SELECT `Course_ID`,`Survey_ID` FROM `course_list` WHERE `Year` = '{$_SESSION['Year_2']}' AND `Course_CName` = '{$_SESSION['Course_CName_2']}'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['Course_ID'] = $row['Course_ID'];
      $_SESSION['Survey_ID'] = $row['Survey_ID'];

    }
    echo "<meta http-equiv=REFRESH CONTENT=0;url=\"{$_SERVER['PHP_SELF']}\">";
  }
?>
<script type="text/javascript">
  function default_course(){
    <?php
      if ((isset($_SESSION['Year_2']))&(isset($_SESSION['Course_CName_2']))){
        echo "document.getElementById(\"Year\").value = \"{$_SESSION['Year_2']}\";\n";
        echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_2']}\";\n";
      } else {
        echo "document.getElementById(\"Year\").selectedIndex = \"0\";\n";
        echo "document.getElementById(\"Course_CName\").selectedIndex = \"0\";\n";
      }
    ?>
    produce_course();
  }

</script>
<script type="text/javascript">
  function produce_course(){
    var Year = document.getElementById("Year").value;
    document.getElementById("Course_CName").length=0;
    var x = document.getElementById("Course_CName");
<?php
    $sql = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['User_ID']}'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    if($row['Adm_Level']=='2'){
      $sql2 = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC ";
      $result2 = mysqli_query($con,$sql2);
      for($i=1; $i<=mysqli_num_rows($result2); $i++){
        $row2 = mysqli_fetch_assoc($result2);
        $Year = $row2['Year'];
      

        echo "if(Year=='".$Year."'){\n";
              
                $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Hide`='0' AND `Year` = '$Year' AND `Teacher_CName` = '".$row['Name']."'";
                $result3 = mysqli_query($con,$sql3);
                for($j=1; $j<=mysqli_num_rows($result3); $j++){
                  $row3 = mysqli_fetch_assoc($result3);
                  echo "var option=document.createElement(\"option\");\n";
                  echo "option.text = \" {$row3['Course_CName']}\";\n";
                  echo "option.value = \"{$row3['Course_CName']}\";\n";
                  echo "x.add(option);\n";
                }
                if (isset($_SESSION['Year_2']))
                  if ($_SESSION['Year_2']== $Year)
                    echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_2']}\";";
              echo "}\n";
      }    
    } elseif ($row['Adm_Level']=='1') {
      $sql2 = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC ";
      $result2 = mysqli_query($con,$sql2);
      for($i=1; $i<=mysqli_num_rows($result2); $i++){
        $row2 = mysqli_fetch_assoc($result2);
        $Year = $row2['Year'];
      

        echo "if(Year=='".$Year."'){\n";
              
                $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Hide`='0' AND `Year` = '$Year'";
                $result3 = mysqli_query($con,$sql3);
                for($j=1; $j<=mysqli_num_rows($result3); $j++){
                  $row3 = mysqli_fetch_assoc($result3);
                  echo "var option=document.createElement(\"option\");\n";
                  echo "option.text = \" {$row3['Course_CName']}\";\n";
                  echo "option.value = \"{$row3['Course_CName']}\";\n";
                  echo "x.add(option);\n";
                }
                if (isset($_SESSION['Year_2']))
                  if ($_SESSION['Year_2']== $Year)
                    echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_2']}\";";
              echo "}\n";
      }    
    }
?>
  }
</script>