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
    <div class="col-lg-4" style="background-color: lightblue">
      <div style="width:300px;">
        <h2 style="text-align:center;">工作職能查詢：</h2><br>
        <select class="form-control" id="career_typt" name="career_typt">
          <option>-工作類型-</option>
        </select><br>
        <select class="form-control" id="career_option" name="career_option">
          <option>-工作項目-</option>
        </select><br>
        <button onclick="">確認</button>
        <div style="font-size: 22px">
        <p>顯示資料:</p>
        <label><input type="checkbox" id="person_grade" onclick="" checked>自評</label><br>
        <label><input type="checkbox" id="semester_grade" onclick="" checked>學期成績</label><br>
        <label><input type="checkbox" id="career_grade" onclick="" checked>職能圖</label>
        </div>
      </div>
    </div>
    <div class="col-lg-7" style="background-color: lightyellow"> 
      <div class="container" style="text-align: right;">
        <div class="row" style="text-align: right;"> 
        <p style="font-size: 22px">如何增進能力:</p>
        <select style="width: 200px" class="form-control" id="ability" name="ability">
          <option>-八大能力-</option>
        </select><br>
        </div>
        <button onclick="">確認</button>
      </div>
    <div class="col-lg-1"></div>
   </div>
  </div>
</div>
</body>