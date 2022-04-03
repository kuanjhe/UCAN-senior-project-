<?php 
session_start();
error_reporting( E_ALL&~E_NOTICE );
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Survey Result</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script> 
  <script type="text/javascript"
  src="http://120.113.174.19/MathJax-2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
  <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js"></script>

  <style type="text/css">
    .axis path,
    .axis line {
      fill:none;
      stroke:black;
      shape-rendering: crispEdges;
    }
    .axis text {
      font-family: sans-serif;
      font-size: 11px;
    }
  </style> 
  <style>
    table {
      border-collapse: collapse;
      width: 60%;
      margin:auto;
    }
    td, th {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
    }
    th {
      text-align: center;
    }
  </style>
</head>
    <div class="col-sm-4" style="background-color:lavenderblush;">
      <div>
        <?php 
          $Problem_array=array('溝通表達','持續學習','人際關係','團隊合作','問題解決','創新','工作責任與紀律','資訊科技應用');
        ?>

      <form method="post" action="">
        <div class="form-group">
              <label for="Problem">請選擇題號：</label> 
              <select class="form-control action" id="Problem" name="Problem" required onclick="produce_problem()">
              <option>請選擇</option>
<?php 
        foreach ($Problem_array as $array_name) 
                echo "<option value=\"{$array_name}\">{$array_name}</option>\n";
?>
              </select>
            </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">送出</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>  
<table>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Problem = $_POST["Problem"];
}

if ($Problem=='溝通表達'){
   include('survey_result_1.php');
}
if ($Problem=='持續學習'){
   include('survey_result_2.php');
}
if ($Problem=='人際關係'){
   include('survey_result_3.php');
}
if ($Problem=='團隊合作'){
   include('survey_result_4.php');
}
if ($Problem=='問題解決'){
   include('survey_result_5.php');
}
if ($Problem=='創新'){
   include('survey_result_6.php');
}
if ($Problem=='工作責任與紀律'){
   include('survey_result_7.php');
}
if ($Problem=='資訊科技應用'){
   include('survey_result_8.php');
}

?>
</script>
<?php
}
?>
</body>
</html>