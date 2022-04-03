<?php
  session_start();
  include('mysql_connect_inc.php');
  include('header_php.php');
  if (!isset($_SESSION['Course_ID'])){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
  }else{
    $Course_ID = $_SESSION['Course_ID'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>課程能力設定</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    

    <script type="text/javascript">
      selected_index=NULL;
      function radio_checked(ID){
        var radio_name = "optradio" + ID;
        document.getElementById(radio_name).checked = true;
        selected_index=ID;
      }
      function radio_unchecked(){
        var radio_name = "optradio" + selected_index;
        document.getElementById(radio_name).checked = false;
        selected_index=NULL;
      }
      function radioB_checked(ID){
        var radio_name = "optradioB_" + ID;
        document.getElementById(radio_name).checked = true;
        selected_index=ID;
      }
      function radioB_unchecked(){
        var radio_name = "optradioB_" + selected_index;
        document.getElementById(radio_name).checked = false;
        selected_index=NULL;
      }
    </script>

    <style type="text/css">
      .additional{
        text-align: center;
        color: red;
      }
    </style>
</head>
<body style="font-family: DFKai-sb;">
<?php
  include("header.php");
?>
  
<div class="container">
  <div class="row">
    <?php include("left_side_bar.php");?>
    <div class="col-sm-9">
<?php
  $sql = "SELECT * FROM `course_list` WHERE `Course_ID`='{$Course_ID}'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
  $number_survey_items=$row['number_survey_items'];
  $Survey_ID = $row['Survey_ID'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['optradio'])){
      $ID = $_POST['optradio'];
      for($j=0; $j<count($ID); $j++){
        
        $number_item = "number_items".sprintf('%02d',$ID[$j]);
        $number_items = $_POST[$number_item]; 

        $sql = "UPDATE `survey_result` SET `item_".sprintf('%02d',$ID[$j])."`='$number_items' WHERE `UserID`='{$_SESSION['User_ID']}' AND `Survey_ID`='$Survey_ID' AND `Teacher`='1'";
        
        mysqli_query($con,$sql);
      }
    }
  }
?>
<?php 
  $sql2 = "SELECT * FROM survey_result WHERE `Survey_ID`='$Survey_ID' AND `Teacher`='1'";
  $result2 = mysqli_query($con,$sql2);
  if(mysqli_num_rows($result2)!=0){
    echo"<form id=\"myForm\" action=\"\" method=\"post\">
    <table width=\"800\" class=\"table table-bordered table-hover table-condensed\" style=\"background-color:lavender;\">
      <tbody>
        <tr>
          <th style=\"text-align: center\" colspan=15>問卷清單(總數："; echo $number_survey_items.")</th>
        </tr>
        <tr>
          <th style=\"text-align: center\"></th>
          <th style=\"text-align: center\">問卷編號</th>
          <th style=\"text-align: center\" width=\"500\">問卷題目內容</th>
          <th style=\"text-align: center\">分數<br>1~5分<br>(最不相關~最相關)</th>
        <th></th>
        </tr>
      </tbody>";
  }else{
    echo "<h2 style=\"text-align:center;\">尚未填寫課程問卷</h2>";
    echo "<center><a href=\"survey-single.php\" class=\"btn btn-info\">填寫課程問卷</a><center>";
  }
?>
  
<?php
  $sql = "SELECT * FROM survey_item_name WHERE 1";
  $result = mysqli_query($con,$sql);
  
  $sql2 = "SELECT * FROM survey_result WHERE `Survey_ID`='$Survey_ID' AND `Teacher`='1'";
  $result2 = mysqli_query($con,$sql2);
  if(mysqli_num_rows($result2)!=0){
    $row2 = mysqli_fetch_assoc($result2);
    for($i=1; $i<=$number_survey_items-1; $i++){
      $row = mysqli_fetch_assoc($result);
      
      echo "<tr>\n";
      echo "<td style=\"text-align: center\"><div class=\"radio\"><label><input type=\"checkbox\" name=\"optradio[]\" id=\"optradio{$row['ID']}\" value=\"{$row['ID']}\"></label></div></td>\n";
      echo "<td style=\"text-align: center\"> $i </td>\n";
      echo "<td style=\"text-align: center\"><textarea class=\"form-control\" rows=\"2\" cols=\"50\" readonly>{$row['Problem_CName']}</textarea>";
      echo "</td>\n";
      $num = sprintf('%02d',$i);
      $numm = $row2["item_".$num];
      echo "<td style=\"text-align: center\" ><select class=\"form-control\" id=\"number_items{$num}\" name=\"number_items{$num}\" onclick=\"radio_checked('{$row['ID']}')\" onselect=\"radio_checked('{$row['ID']}')\" required>";
      for($y=1;$y<=5;$y++){
        if($numm==$y){
          echo "<option value=\"".$numm."\" selected>".$numm."</option>\n";
        }else{
          echo "<option value=\"".$y."\">".$y."</option>\n";
        }
      }
      //echo "</select>";
      //echo "<td style=\"text-align: center\" ><input type=\"text\" class=\"form-control\" name=\"number_items{$num}\" id=\"number_items{$num}\" value=\"{$numm}\"";
      echo "</select>";
      echo "</td>\n";
      echo "<td><input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"進行修改\"></td>";
      echo "</tr>\n";
    }
  }
  
?>
<?php 
  $sql2 = "SELECT * FROM survey_result WHERE `Survey_ID`='$Survey_ID' AND `Teacher`='1'";
  $result2 = mysqli_query($con,$sql2);
  if(mysqli_num_rows($result2)!=0){
    echo "</table>
    <input class=\"btn btn-info\" role=\"button\" type=\"submit\" value=\"進行修改\">
  </form>";
  }
  ?>
    
    </div>
          
          
      </div>
    </div>
  </body>
</html>