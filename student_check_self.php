<?php
  session_start();
  include('mysql_connect_inc.php');
  if(isset($_GET['Course_ID'])){
    $_SESSION['Course_ID']=$_GET['Course_ID'];
  }
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
      <?php 
        include_once('phpqrcode/qrlib.php');
          if (!file_exists("QRCode/QR_survey_{$_SESSION['Course_ID']}.png")){
            QRcode::png("http://120.113.174.17/student/s1042653/M20180517/student_check_self.php?Course_ID={$_SESSION['Course_ID']}", "QRCode/QR_survey_{$_GET['Course_ID']}.png");
          }
            //echo "<a href=\"http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}?year={$_GET['year']}&activity_id={$_GET['activity_id']}\">web site</a>";
            echo "<p style=\"text-align:center\"><img src=\"QRCode/QR_survey_{$_SESSION['Course_ID']}.png\" alt=\"http://120.113.174.17/student/s1042653/M20180517/student_check_self.php?Course_ID={$_SESSION['Course_ID']}\"></p>";
      ?>
    </div>
    <div class="col-sm-4">
  <?php
  if (isset($_SESSION['duplicate'])){
    if ($_SESSION['duplicate']==1){
      echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID_4']."</h2><h2 style=\"text-align:center;\">已經完成課程登記!</h2>";
    } else {
      echo "<h2 style=\"text-align:center;\">學生".$_SESSION['StudentID_4']."</h2><h2 style=\"text-align:center;\">未完成課程登記!</h2>";
    }
    unset($_SESSION['duplicate']);
    echo "<meta http-equiv=REFRESH CONTENT=5;url=\"{$_SERVER[PHP_SELF]}\">";
  } else {
?>
<?php
  if (isset($_SESSION['Course_ID'])){
    $sql = "SELECT * FROM `course_list` WHERE `Course_ID` = '{$_SESSION['Course_ID']}'";
    $row = mysqli_fetch_assoc(mysqli_query($con, $sql));
  }
?>       
    <div class="container">
      <h2 style="text-align:center;">課程學年度：<?php echo "{$row['Year']}";?></h2>
      <h2 style="text-align:center;">課程名稱：<?php echo "{$row['Course_CName']}";?></h2>
      <h2 style="text-align:center;">學生確認修讀課程頁面</h2>
        <form action="" method="POST">
              <input type="text" class="form-control action" id="Year" name="Year" value="<?php echo "{$row['Year']}";?>" readonly style="visibility: hidden"> 
              <input type="text" class="form-control" id="Course_ID" name="Course_ID" value="<?php echo "{$_SESSION['Course_ID']}";?>" readonly style="visibility: hidden">
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
      $Course_ID = $_POST['Course_ID'];
      $StudentID = $_POST['StudentID'];
      date_default_timezone_set("Asia/Taipei");
      $record_ime = date("Y:m:d H:i:s",time());
      $sql = "SELECT * FROM `studentlist` WHERE `StudentID`='$StudentID' and `Course_ID` = '$Course_ID'";
      $result = mysqli_query($con,$sql);
      if (mysqli_num_rows($result)==0){
        $_SESSION['duplicate'] = 0;
      } else {
        $_SESSION['duplicate'] = 1;
      }
      $_SESSION['Year_4'] = $Year;
      $_SESSION['Course_ID'] = $Course_ID;
      $_SESSION['StudentID_4'] = $StudentID;
      //echo $sql;
    echo "<meta http-equiv=REFRESH CONTENT=0;url=\"{$_SERVER[PHP_SELF]}\">";
  }
?>
