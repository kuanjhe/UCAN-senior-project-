<?php
  session_start();
  include('mysql_connect_inc.php');
  //include('survey/header_php.php');
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
<body style="font-family: DFKai-sb;" onload="default_teacher()">
<?php
  //include("header.php");
  //echo "<div class=\"jumbotron text-center\">\n";
  //echo "<h1>國立嘉義大學學生事務處</h1>\n";
  //echo "<h3>活動紀錄系統</h3>\n";
  //echo "<h3>活動頁面</h3>\n";
?>

<div class="jumbotron text-center">
  <h1>國立嘉義大學應用數學系</h1>
  <h3>學生課程意見調查</h3>
  <h3>確認課程修讀頁面</h3>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
  <?php
  if (isset($_SESSION['duplicate'])){
    if ($_SESSION['duplicate']==1){
      echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID_5']."</h2><h2 style=\"text-align:center;\">已經完成課程登記!</h2>";
    } else {
      echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID_5']."</h2><h2 style=\"text-align:center;\">未完成課程登記!</h2>";
    }
    unset($_SESSION['duplicate']);
    echo "<meta http-equiv=REFRESH CONTENT=5;url=\"{$_SERVER[PHP_SELF]}\">";
  } else {
?>      
    <div class="container">
      <h2 style="text-align:center;">學生確認報到頁面</h2>
        <form action="" method="POST">
          <div class="form-group">
              <label for="Year"><h4>請選擇課程學年度：</h4></label>
              <select class="form-control" id="Year" name="Year" onclick="produce_teacher()" onchange="clean_course()">
                <!--option value=""></option-->               
                <!--option value="107">107</option-->
<?php
  $sql = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC";
  $result = mysqli_query($con,$sql);
  for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    if (isset($_SESSION['Year_5'])){
      if ($row['Year']==$_SESSION['Year_5']){
        echo "            <option value=\"".$row['Year']."\" selected>".$row['Year']."</option>\n";
      } else {
        echo "            <option value=\"".$row['Year']."\">".$row['Year']."</option>\n";
      } 
    } else {
      echo "            <option value=\"".$row['Year']."\">".$row['Year']."</option>\n";
    } 
  }
?>
              </select>
          </div>
          <div class="form-group">
              <label for="Teacher_CName"><h4>請選擇任課老師:</h4></label>
              <select class="form-control" id="Teacher_CName" name="Teacher_CName" onclick="produce_course()">
<?php
  $sql = "SELECT `Teacher_CName` FROM `course_list` WHERE `Year` = '".$_SESSION['Year_5']."'";
  $result = mysqli_query($con,$sql);
  for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    if (isset($_SESSION['Teacher_CName_5'])){
      if ($row['Teacher_CName']==$_SESSION['Teacher_CName_5']){
        echo "            <option value=\"".$row['Teacher_CName']."\" selected>".$row['Teacher_CName']."</option>\n";
      } else {
        echo "            <option value=\"".$row['Teacher_CName']."\">".$row['Teacher_CName']."</option>\n";
      } 
    }
  }
?>
              </select>
          </div>


          <div class="form-group">
              <label for="Course_CName"><h4>請選擇課程名稱:</h4></label>
              <select class="form-control" id="Course_CName" name="Course_CName">
<?php
  $sql = "SELECT `Course_CName` FROM `course_list` WHERE `Teacher_CName` = '".$_SESSION['Teacher_CName_5']."'";
  $result = mysqli_query($con,$sql);
  for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    if (isset($_SESSION['Course_CName_5'])){
      if ($row['Course_CName']==$_SESSION['Course_CName_5']){
        echo "            <option value=\"".$row['Course_CName']."\" selected>".$row['Course_CName']."</option>\n";
      } else {
        echo "            <option value=\"".$row['Course_CName']."\">".$row['Course_CName']."</option>\n";
      } 
    }
  }
?>
              </select>
          </div>
          <div class="form-group">
              <label for="StudentID"><h4>請輸入學生學號：</h4></label>
              <input type="text" class="form-control" id="StudentID" placeholder="1061234" name="StudentID" required>
          </div>
          <!--div class="form-check">
              <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="remember"> Remember me
              </label>
          </div-->
          <div class="text-center">
            <button type="submit" class="btn btn-primary">送出選擇</button>
          </div>
        </form>
    </div>
    <?php
     };
     ?>
    </div>
    <div class="col-sm-4">
    </div>
  </div>
</div>
</body>
</html>
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $Year = $_POST['Year'];
      $Teacher_CName = $_POST['Teacher_CName'];
      $Course_CName = $_POST['Course_CName'];
      $StudentID = $_POST['StudentID'];
      $sql = "SELECT * FROM `course_list` WHERE `Teacher_CName` = '$Teacher_CName' AND `Year` = '$Year' AND `Course_CName` = '$Course_CName'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      $Course_ID=$row['Course_ID'];

      $sql = "SELECT * FROM `studentlist` WHERE `StudentID`='$StudentID' and `Course_ID` = '$Course_ID'";
      $result = mysqli_query($con,$sql);
      if (mysqli_num_rows($result)==0){
        $_SESSION['duplicate'] = 0;
      } else {
        $_SESSION['duplicate'] = 1;
      }
      $_SESSION['Year_5'] = $Year;
      $_SESSION['StudentID_5'] = $StudentID;
      $_SESSION['Teacher_CName_5'] = $Teacher_CName;
      $_SESSION['Course_CName_5'] = $Course_CName;
      //echo $sql;
    echo "<meta http-equiv=REFRESH CONTENT=0;url=\"{$_SERVER[PHP_SELF]}\">";
  }
?>


<script type="text/javascript">
  function default_teacher(){
    <?php
      if ((isset($_SESSION['Teacher_CName_5']))&(isset($_SESSION['Year_5']))&(isset($_SESSION['Course_CName_5']))){
        echo "document.getElementById(\"Year\").value = \"{$_SESSION['Year_5']}\";\n";
        echo "document.getElementById(\"Teacher_CName\").value = \"{$_SESSION['Teacher_CName_5']}\";\n";
        echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_5']}\";\n";
      } else {
        echo "document.getElementById(\"Year\").selectedIndex = \"0\";\n";
        echo "document.getElementById(\"Teacher_CName\").selectedIndex = \"0\";\n";
        echo "document.getElementById(\"Course_CName\").selectedIndex = \"0\";\n";
      }
    ?>
    produce_teacher();
    produce_course();
  }
</script>
<script type="text/javascript">
  function clean_course(){
    document.getElementById("Course_CName").value = null;
  }
</script>


<script type="text/javascript">
  function produce_teacher(){
    var Year = document.getElementById("Year").value;
    document.getElementById("Teacher_CName").length=0;
    var x = document.getElementById("Teacher_CName");
<?php
    $sql = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` DESC ";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=mysqli_num_rows($result); $i++){
    $row = mysqli_fetch_assoc($result);
    $Year = $row['Year'];
    
    echo "if (Year=='".$Year."'){\n";
    $sql2 = "SELECT `Teacher_CName` FROM `course_list` WHERE `Hide`='0' AND `Year` = '".$row['Year']."'";
    $result2 = mysqli_query($con,$sql2);
    for($j=1; $j<=mysqli_num_rows($result2); $j++){
      $row2 = mysqli_fetch_assoc($result2);
      echo "var option=document.createElement(\"option\");\n";
      echo "option.text = \" {$row2['Teacher_CName']}\";\n";
      echo "option.value = \"{$row2['Teacher_CName']}\";\n";
      echo "x.add(option);\n";
    }
    if (isset($_SESSION['Year_5']))
      if ($_SESSION['Year_5']== $Year)
        echo "document.getElementById(\"Teacher_CName\").value = \"{$_SESSION['Teacher_CName_5']}\";";
    echo "}\n";
  }

  
?>
  }
</script>
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
    if ((isset($_SESSION['Course_CName_5']))&(isset($_SESSION['Teacher_CName_5'])))
      if (($_SESSION['Teacher_CName_5']== $Teacher_CName)||($_SESSION['Year_5']== $Year))
        echo "document.getElementById(\"Course_CName\").value = {$_SESSION['Course_CName_5']};";
    echo "}\n";
  }
  
?>
  }
</script>