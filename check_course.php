<?php
  session_start();
  include('mysql_connect_inc.php');
  include('survey/header_php.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>查詢課程</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="//d3js.org/d3.v3.js"></script>
  <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="radar-chart.js"></script>
    <style type="text/css">
      .additional{
        text-align: center;
        color: red;
      }
    </style>
</head>
  <style type="text/css">
    path:hover{
    fill: orange;
  }
  text.pie_text{
    font-size: 12px;
    opacity: 0;
  }
  .arc:hover text.pie_text{
    opacity: 1;
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
    <div class="container">
      <h2 style="text-align:center;">查詢課程能力</h2>
     <form method="post" action="">
          <div class="form-group">
              <label for="Year"><h4>請選擇課程學年度：</h4></label>
              <select class="form-control" id="Year" name="Year" onclick="produce_course()">
               
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
              <label for="Course_CName"><h4>請選擇課程名稱:</h4></label>
              <select class="form-control" id="Course_CName" name="Course_CName">
<?php

  $sql = "SELECT * FROM `course_list` WHERE 1";
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
          <div class="text-center">
            <button class="btn btn-primary" tpye="submit"">送出選擇</button>
          </div>
        </form>
    </div>
<?php  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $Course_CName = $_POST["Course_CName"];
    $Year = $_POST["Year"];
    $_SESSION['Course_CName_5']=$Course_CName;
    $_SESSION['Year_5']=$Year;

    $sql = "SELECT * FROM `course_list` WHERE `Year`='$Year' AND `Course_CName`='$Course_CName'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $Survey_ID=$row['Survey_ID'];

    $sql="SELECT * FROM `survey_result` WHERE Survey_ID='$Survey_ID' AND Teacher = 1";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==0){
      echo"<p><h2 style=\"text-align:center;\">老師尚未完成課程能力設定</h2></p>";
    } else{
        
      //include('survey_result_1.php');

      $sql3="SELECT * FROM `survey_result` WHERE Survey_ID='$Survey_ID' AND Teacher = 1";
      $result3 = mysqli_query($con,$sql3);
      $j=1;
      while($row3=mysqli_fetch_array($result3)){
        $Tsurres[$j]=array();
        $Tsurres[$j][]=$row3;
        $j+=1;
      }
      //echo"<label><input type=\"checkbox\" id=\"student\" onclick=\"fun()\">學生資料</label>";
      echo"<label><input type=\"checkbox\" id=\"teacher\" onclick=\"fun()\">老師資料</label>";
      echo"<div id=\"chart\">";
      echo"</div>";
    }
      
  }
?>


    </div>
</body>
</html>



<script type="text/javascript">

    function fun(){
      
      var b=new Array(9);
      
<?php
      

  for($k=1;$k<$j;$k++){
      echo "b[".$k."]=new Array();
      ";
      for($i=1;$i<=8;$i++)
        echo "b[".$k."][".$i."]=0;
      ";

       for($i=1;$i<=7;$i++){
        echo" b[".$k."][1]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=8;$i<=14;$i++){
        echo" b[".$k."][2]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=15;$i<=20;$i++){
        echo" b[".$k."][3]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=21;$i<=27;$i++){
        echo" b[".$k."][4]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=28;$i<=33;$i++){
        echo" b[".$k."][5]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=34;$i<=39;$i++){
        echo" b[".$k."][6]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=40;$i<=46;$i++){
        echo" b[".$k."][7]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=47;$i<=51;$i++){
        echo" b[".$k."][8]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
  }
?>

var t;

var e = new Array();
var d = new Array();
   /*if(document.getElementById("student").checked==true){
    e[1]=<?php echo (int)$m1;?>;
    e[2]=<?php echo (int)$m2;?>;
    e[3]=<?php echo (int)$m3;?>;
    e[4]=<?php echo (int)$m4;?>;
    e[5]=<?php echo (int)$m5;?>;
    e[6]=<?php echo (int)$m6;?>;
    e[7]=<?php echo (int)$m7;?>;
    e[8]=<?php echo (int)$m8;?>;    
    }
    else
      e=["0","0","0","0","0","0","0","0","0"];*/
    if(document.getElementById("teacher").checked==true){
      for(j=1;j<9;j++){
        d[j]=b[1][j];
      }
    }else{
      d=["0","0","0","0","0","0","0","0","0"];
    }
      
      
  t = [
  [
    {axis:"溝通表達",value: e[1],maxvalue:35},
    {axis:"持續學習",value: e[2],maxvalue:35},
    {axis:"人際關係",value: e[3],maxvalue:30},
    {axis:"團隊合作",value: e[4],maxvalue:35},
    {axis:"問題解決",value: e[5],maxvalue:30},
    {axis:"創新",value: e[6],maxvalue:30},
    {axis:"工作責任與紀律",value: e[7],maxvalue:35},
    {axis:"資訊科技應用",value: e[8],maxvalue:30}
    ],
    [
    {axis:"溝通表達",value: d[1],maxvalue:35},
    {axis:"持續學習",value: d[2],maxvalue:35},
    {axis:"人際關係",value: d[3],maxvalue:30},
    {axis:"團隊合作",value: d[4],maxvalue:35},
    {axis:"問題解決",value: d[5],maxvalue:30},
    {axis:"創新",value: d[6],maxvalue:30},
    {axis:"工作責任與紀律",value: d[7],maxvalue:35},
    {axis:"資訊科技應用",value: d[8],maxvalue:30}
    ]
  ];
    
    var mycfg = {
       radius: 5,
       w: 600,
       h: 600,
       factor: .65,
       factorLegend: .8,
       levels: 4,
       maxValue: 0,
       radians: 2 * Math.PI,
       opacityArea: 0.5,
       fontSize: 14,
       color: d3.scale.category10()
      };
  
    d3.select("svg").remove();
    RadarChart.draw("#chart", t, mycfg);
  };
</script>

<script type="text/javascript">
  function default_course(){
    <?php
      if ((isset($_SESSION['Year_5']))&(isset($_SESSION['Course_CName_5']))){
        echo "document.getElementById(\"Year\").value = \"{$_SESSION['Year_5']}\";\n";
        echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_5']}\";\n";
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

    $sql2 = "SELECT `Year` FROM `course_list` WHERE `Hide`='0' GROUP BY `Year` ORDER BY `Year` ASC ";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      $Year = $row2['Year'];
      

      echo "if(Year=='".$Year."'){\n";
              
              $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Hide`='0' AND `Year` = '".$Year."'";
              $result3 = mysqli_query($con,$sql3);
              for($j=1; $j<=mysqli_num_rows($result3); $j++){
                $row3 = mysqli_fetch_assoc($result3);
                echo "var option=document.createElement(\"option\");\n";
                echo "option.text = \" {$row3['Course_CName']}\";\n";
                echo "option.value = \"{$row3['Course_CName']}\";\n";
                echo "x.add(option);\n";
              }
              if (isset($_SESSION['Year_5']))
                if ($_SESSION['Year_5']== $Year)
                  echo "document.getElementById(\"Course_CName\").value = \"{$_SESSION['Course_CName_5']}\";";
              echo "}\n";
      }    
    
?>
  }
</script>