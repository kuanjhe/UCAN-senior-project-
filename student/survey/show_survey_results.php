<?php
  session_start();
  include('mysql_connect.inc.php');
  include('header_php.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>國立嘉義大學學生事務處</title>
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
<body style="font-family: DFKai-sb;" onload="default_activity()">
<?php
  include("header.php");
?>
  
<div class="container">
  <div class="row">
    <?php include("../left_side_bar.php");?>
    <div class="col-sm-6">
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['optradio'])){
      $ID = $_POST['optradio'];
      for($i=0; $i<count($ID); $i++){
        $sql = "UPDATE `survey_result` SET `Hide` = '1' WHERE `ID` ='{$ID[$i]}'";
         //$sql = "DELETE FROM `activity_list` WHERE `ID`='{$ID[$i]}'";
        mysqli_query($con,$sql);
      }
    }
    echo "<meta http-equiv=REFRESH CONTENT=0.01;url=\"{$_SERVER[PHP_SELF]}\">";
  } else {
    if ((isset($_SESSION['activity_id']))&(isset($_SESSION['year']))){
      $year = $_SESSION['year'];
      $activity_name = $_SESSION['activity_id'];    
      echo "      <div class=\"container\">";
      echo "        <h2>學生參加活動清單</h2>";
      echo "        <p>以下為學生清單:</p>";
      $sql = "SELECT * FROM `activity_list` WHERE `ID` = '$activity_name'";
      $row =mysqli_fetch_assoc(mysqli_query($con,$sql));
      echo "<div class=\"text-center\">";
      if (!is_null($row['survey_excel_name'])){
        echo "<a href=\"xlsx/{$row['survey_excel_name']}\" class=\"btn btn-info\" role=\"button\">下載學生參加活動清單Excel檔</a>";
        
      } else{
        echo "尚未產生學生參加活動清單Excel檔";
      }
      echo "</div>";
      echo "        <form action=\"\" method=\"POST\">";
      echo "        <table class=\"table table-hover\">";
      echo "          <thead>";
      echo "            <tr>";
      echo "              <th></th>";
      echo "              <th>學生編號</th>";
      echo "              <th>學號</th>";
      echo "              <th>登入時間</th>";
      echo "              <th></th>";
      echo "            </tr>";
      echo "          </thead>";
      echo "          <tbody>";
      $DataTable="";
      $DataTable[0][0]="人員編號";
      //$DataTable[0][1]="總答題成功數";
      $sql = "SELECT * FROM `survey_result` WHERE `activity` = '$activity_name'";
      $result = mysqli_query($con,$sql);
      for($i=1; $i<=mysqli_num_rows($result); $i++){
        $row=mysqli_fetch_assoc($result);
        $DataTable[$i][0]=$row['StudentID'];
        echo "<tr>";
        if ($row['Hide']==0){
          echo "<td><input type=\"checkbox\" name=\"optradio[]\" id=\"optradio{$row['ID']}\" value=\"{$row['ID']}\"></label></td>";
        } else {
          echo "<td>已隱藏</td>";
        }
        echo "<td>{$i}</td>";
        echo "<td>{$row['StudentID']}</td>";
        echo "<td>{$row['Time']}</td>";
        echo "<td><input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"隱藏已勾選之學生\"></td>";
        echo "</tr>\n";    
      }
      echo "</form>";

      /*include("xlsxwriter.class.php");
      $writer = new XLSXWriter();
      $format = array('font'=>'Arial','font-size'=>10,'halign'=>'center');
      foreach($DataTable as $row_data)
        $writer->writeSheetRow("list",$row_data,$format);
      $ResultName="attendence_list_activity_".$activity_name."_".date("Y_m_d").".xlsx";
      $writer->writeToFile($ResultName);*/
      //$_SESSION['year'] = $year;
      //$_SESSION['activity_id'] = $activity_name;
    } else {
      if (!isset($_SESSION['activity_id'])){
            echo "<meta http-equiv=REFRESH CONTENT=0.01;url=../choose_activity.php>";
      }
    }
  }
?>
          
          </tbody>
        </table>
<?php  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<div class=\"text-center\">";
    echo "<a href=\"output_survey_results.php?year={$year}&activity_name={$activity_name}\" class=\"btn btn-info\" role=\"button\">產生學生參加活動清單Excel檔</a>";
    echo "</div>";
  } else if ((isset($_SESSION['activity_id']))&(isset($_SESSION['year']))){
    echo "<div class=\"text-center\">";
    echo "<a href=\"output_survey_results.php?year={$year}&activity_name={$activity_name}\" class=\"btn btn-info\" role=\"button\">產生學生參加活動清單Excel檔</a>";
    echo "</div>";
  }
?>        
      </div>
    </div>
  </div>
</div>

</body>
</html>