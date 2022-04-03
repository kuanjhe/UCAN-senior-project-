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
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="radar-chart.js"></script>
    <style type="text/css">
      .additional{
        text-align: center;
        color: red;
      }
    </style>
</head>
<body style="font-family: DFKai-sb;" onload="produce_course()">
<?php
  include("header.php");
?>
<div class="container">
  <div style="height: 600px">
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-4">
    <div style="width:300px;" class="container">
      <?php
  $surres=array();
  $sql="SELECT * FROM `survey_result` WHERE UserID='".$_SESSION['Username']."'";
  $result = mysqli_query($con,$sql);
  $j=1;
  while($row=mysqli_fetch_assoc($result)){
    $surres[$j]=array();
    $surres[$j][]=$row;
    $j+=1;
  }
?>
      <h2 style="text-align:center;">課程問卷查詢</h2>
        <div class="form-group">
          <label for="Teacher_CName"><h4>請選擇課程:</h4></label>
          <select class="form-control" id="Course_CName" name="Teacher_CName">
          <option>-請選擇-</option>
          <?php
            $sql2 = "SELECT `Survey_ID` FROM `survey_result` WHERE `UserID` = '".$_SESSION['Username']."'";
            $result = mysqli_query($con,$sql2);
            
            for($z=1; $z<=mysqli_num_rows($result); $z++){
             $row = mysqli_fetch_assoc($result); 
            $sql3 = "SELECT `Course_CName` FROM `course_list` WHERE `Survey_ID` = '".$row['Survey_ID']."'";
            $result2 = mysqli_query($con,$sql3);
            $row2 = mysqli_fetch_assoc($result2);
            echo "<option value=$z>".$row2['Course_CName']."</option>\n";
            }
          ?>
          </select>
        </div>
        <button onclick="fun()">確認</button>

        <?php
           $sql4 = "SELECT `Survey_ID` FROM `survey_result` WHERE `UserID` = '".$_SESSION['Username']."'";
            $result4 = mysqli_query($con,$sql4);
              $d=1;
            while($row4=mysqli_fetch_array($result4)){
              $sql3="SELECT * FROM `survey_result` WHERE Survey_ID='".$row4['Survey_ID']."'AND Teacher = 1";
              $result5 = mysqli_query($con,$sql3);
              while($row6=mysqli_fetch_array($result5)){
                $Tsurres[$d]=array();
                $Tsurres[$d][]=$row6;
                $d+=1;
            }
          }
        ?>


        <br><br>
        <div style="font-size: 22px">
        <p>顯示資料:</p>
        <label><input type="checkbox" id="student" onclick="fun()" checked>學生資料(藍)</label>
        <br><label><input type="checkbox" id="teacher" onclick="fun()" checked>老師資料(橘)</label><br>
        (若老師資料為空，可能為老師尚未輸入資料)
        </div>
    </div>
   </div>
   <div class="col-lg-5" id="chart">
    </div>
  </div>
  </div>
  <div class="row" style="height: 100px">
  <div class="col-lg-1"></div>
  <div class="col-lg-4"></div>
  <div class="col-lg-5" style="text-align: right;">
    <div class="container" style="text-align: right;">
        <div class="row" style="text-align: right;"> 
        <p style="font-size: 22px">如何增進能力:</p>
        <select style="width: 200px" class="form-control" id="ability" name="ability">
          <option value="0">-八大能力-</option>
          <option value="1">溝通表達</option>
          <option value="2">問題解決</option>
          <option value="3">持續學習</option>
          <option value="4">創新</option>
          <option value="5">人際互動</option>
          <option value="6">工作責任跟紀律</option>
          <option value="7">團隊合作</option>
          <option value="8">資訊科技應用</option>
        </select><br>
        </div>
        <button onclick="creat()">確認</button>
        <p id="ability_name">ABC</p>
      </div>
  </div>
</div>
</div>
</body>
<script type="text/javascript">
function creat(){
  var ability = document.getElementById("ability").value;
  var ability_name = document.getElementById("ability_name").text;

if(ability==1){
  ability_name="A";
}
  
}

    function fun(){
      
      var a=new Array(9);
      var b=new Array(9);
      
<?php
    for($k=1;$k<$j;$k++){
      echo "a[".$k."]=new Array();
      ";
      for($i=1;$i<=8;$i++)
        echo "a[".$k."][".$i."]=0;
      ";

       for($i=1;$i<=7;$i++){
        echo" a[".$k."][1]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=8;$i<=14;$i++){
        echo" a[".$k."][2]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=15;$i<=20;$i++){
        echo" a[".$k."][3]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=21;$i<=27;$i++){
        echo" a[".$k."][4]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=28;$i<=33;$i++){
        echo" a[".$k."][5]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=34;$i<=39;$i++){
        echo" a[".$k."][6]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=40;$i<=46;$i++){
        echo" a[".$k."][7]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
      for($i=47;$i<=52;$i++){
        echo" a[".$k."][8]+=".(int)$surres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
  }

  for($k=1;$k<$d;$k++){
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
      for($i=47;$i<=52;$i++){
        echo" b[".$k."][8]+=".(int)$Tsurres[$k][0]["item_".sprintf('%02d',$i).""].";
        ";
      }
  }
?>
var i =document.getElementById("Course_CName").value;
var t;

var e = new Array();
var d = new Array();
   if(document.getElementById("student").checked==true){
      for(j=1;j<9;j++){
        e[j]=a[i][j];
      }
    }
    else
      e=["0","0","0","0","0","0","0","0","0"];
    if(document.getElementById("teacher").checked==true){
      for(j=1;j<9;j++){
        if (typeof b[i] !== 'undefined')
        d[j]=b[i][j];
      else
        d=["0","0","0","0","0","0","0","0","0"];
      }
    }
    else
      d=["0","0","0","0","0","0","0","0","0"];
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
