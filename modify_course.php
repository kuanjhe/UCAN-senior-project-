<?php
    session_start();
    include('mysql_connect_inc.php');
    include('survey/header_php.php');
    include('department_script.php');
    if (!isset($_SESSION['Course_ID'])){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
    } else{
      $Course_ID = $_SESSION['Course_ID'];
      $sql = "SELECT `Course_CName` FROM `course_list` WHERE `Course_ID`='$Course_ID'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_assoc($result);
      $site_name=$row['Course_CName'];
    }
?>
<!DOCTYPE html>
<html>
<title>修改<?php echo $site_name?>課程頁面</title>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="font-family: DFKai-sb;">
<?php
  include("header.php");
?>
<div class="container">
  <div class="row">
<?php 
  include("left_side_bar.php");
  $Course_Department_array=array('教育學系暨研究所','輔導與諮商學系暨研究所','體育與健康休閒學系暨研究所','特殊教育學系暨研究所','幼兒教育學系暨研究所','教育行政與政策發展研究所','數理教育研究所','數位學習設計與管理學系暨研究所','教學專業國際碩士學位學程','中國文學系暨研究所','視覺藝術學系暨研究所','應用歷史學系暨研究所','外國語言學系暨研究所','音樂學系暨研究所','企業管理學系暨研究所','應用經濟學系暨研究所','生物事業管理學系暨研究所','資訊管理學系暨研究所','財務金融學系','行銷與觀光管理學系暨研究所','管院碩士在職專班','全英文授課觀光暨管理碩士學位學程','農藝學系暨研究所','園藝學系暨研究所','森林暨自然資源學系暨研究所','木質材料與設計學系暨研究所','動物科學系暨研究所','生物農業科技學系','景觀學系','農業科學博士學位學程','植物醫學系','農學院農業科技全英碩士學位學程','生物技術學程','蘭花生技學程','有機農業學程','農場管理進修學士學位學程','農學碩士在職專班','電子物理學系光電暨固態電子研究所','應用化學系暨研究所','應用數學系暨研究所','資訊工程學系暨研究所','生物機電工程學系暨研究所','土木與水資源工程學系暨研究所','電機工程學系暨研究所','機械與能源工程學系','食品科學系暨研究所','水生生物科學系暨研究所','生物資源學系暨研究所','生化科技學系暨研究所','微生物免疫與生物藥學系暨研究所','生命科學全英文碩士學位學程','獸醫學系暨研究所','公共政策研究所');
    $Course_College_array=array('理工學院','師範學院','人文藝術學院','管理學院','農學院','生命科學院','獸醫學院');
    $Course_Category_array=array('一般專業課程(含專業必修及專業選修課程)','通識教育課程(含
      90學年度以前共同必修科目)','暑修A班','暑修B班','專門課程共同選修(師院體系)','專門課程(大學部)及國小學程(各系所)','教育學程','語中專業學程','校內必修、或校訂選修','專業學程(除教育學程外');
    $Course_Grade_array=array('大一','大二','大三','大四','碩一','碩二');
    $Course_Hour_array=array('0','1','2','3','4','5');
    $Year_array=array('106-01','106-02','107-01','107-02');
    $Learn_Hour_array=array('0','1','2','3','4','5');
?>
    <div class="col-sm-8">
      <h2 style="text-align:center;">更改課程內容</h2>
        <form action="modify_course_updata.php" method="POST">
          <div class="form-group">
              <label for="Year"><h4>請選擇課程學年度：</h4></label>
              <select class="form-control" id="Year" name="Year" required>
<?php
  $sql2 = "SELECT * FROM `course_list` WHERE `Course_ID`='$Course_ID'";
  $result2 = mysqli_query($con,$sql2);
  $row2=mysqli_fetch_assoc($result2);
  $_SESSION['ID'] = $row2['ID'];
  for($i=0; $i<count($Year_array); $i++){
    if ($row2['Year']==$Year_array[$i]){
      echo "            <option value=\"".$Year_array[$i]."\" selected>".$Year_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Year_array[$i]."\">".$Year_array[$i]."</option>\n";
    }  
  }
?> 
              </select>
            </div>
            <div class="form-group">
              <label for="Course_Category"><h4>請選擇課程類別：</h4></label> 
              <select class="form-control action" id="Course_Category" name="Course_Category" required>

<?php 
  for($i=0; $i<count($Course_Category_array); $i++){
    if ($row2['Course_Category']==$Course_Category_array[$i]){
      echo "            <option value=\"".$Course_Category_array[$i]."\" selected>".$Course_Category_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Course_Category_array[$i]."\">".$Course_Category_array[$i]."</option>\n";
    }  
  }
?>
              </select>
            </div>
            <div class="form-group">
              <label for="Course_CName"><h4>請輸入課程名稱：</h4></label>
              <input type="text" class="form-control" id="Course_CName" name="Course_CName" value=<?php echo "\"".$row2['Course_CName']."\""; ?> required>
            </div>
            <div class="form-group">
              <label for="Course_ID"><h4>請輸入永久課號：</h4></label>
              <input type="text" class="form-control" id="Course_ID" name="Course_ID" value=<?php echo "\"".$row2['Course_ID']."\""; ?> required>
            </div>
            <div class="form-group">
              <label for="Course_College"><h4>請選擇上課學院：</h4></label> 
              <select class="form-control action" id="Course_College" name="Course_College" onchange="produce_department()" required>

<?php 
  for($i=0; $i<count($Course_College_array); $i++){
    if ($row2['Course_College']==$Course_College_array[$i]){
      echo "            <option value=\"".$Course_College_array[$i]."\" selected>".$Course_College_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Course_College_array[$i]."\">".$Course_College_array[$i]."</option>\n";
    }  
  }
?>
              </select>
            </div>
            <div class="form-group">
              <label for="Course_Department"><h4>請選擇上課系所：</h4></label> 
              <select class="form-control action" id="Course_Department" name="Course_Department" require>

<?php 
  for($i=0; $i<count($Course_Department_array); $i++){
    if ($row2['Course_Department']==$Course_Department_array[$i]){
      echo "            <option value=\"".$Course_Department_array[$i]."\" selected>".$Course_Department_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Course_Department_array[$i]."\">".$Course_Department_array[$i]."</option>\n";
    }  
  }
?>
              </select>
            </div>
          <div class="form-group">
              <label for="Course_Grade"><h4>請選擇授課年級：</h4></label> 
              <select class="form-control action" id="Course_Grade" name="Course_Grade">
<?php 
  for($i=0; $i<count($Course_Grade_array); $i++){
    if ($row2['Course_Grade']==$Course_Grade_array[$i]){
      echo "            <option value=\"".$Course_Grade_array[$i]."\" selected>".$Course_Grade_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Course_Grade_array[$i]."\">".$Course_Grade_array[$i]."</option>\n";
    }  
  }
?>
              </select>
          </div>
          <div class="form-group">
              <label for="Course_Hour"><h4>請選擇學分數：</h4></label> 
              <select class="form-control action" id="Course_Hour" name="Course_Hour">
<?php 
  for($i=0; $i<count($Course_Hour_array); $i++){
    if ($row2['Course_Hour']==$Course_Hour_array[$i]){
      echo "            <option value=\"".$Course_Hour_array[$i]."\" selected>".$Course_Hour_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Course_Hour_array[$i]."\">".$Course_Hour_array[$i]."</option>\n";
    }  
  }
?>
              </select>
          </div>
          <div class="form-group">
              <label for="Learn_Hour"><h4>請選擇學習時數：</h4></label> 
              <select class="form-control action" id="Learn_Hour" name="Learn_Hour">
<?php 
  for($i=0; $i<count($Learn_Hour_array); $i++){
    if ($row2['Learn_Hour']==$Learn_Hour_array[$i]){
      echo "            <option value=\"".$Learn_Hour_array[$i]."\" selected>".$Learn_Hour_array[$i]."</option>\n";
    } else {
      echo "            <option value=\"".$Learn_Hour_array[$i]."\">".$Learn_Hour_array[$i]."</option>\n";
    }  
  }
?>
              </select>
          </div>
          <div class="form-group">
              <label for="Teacher_CName"><h4>請輸入授課教師：</h4></label>
              <input type="text" class="form-control" id="Teacher_CName" name="Teacher_CName" value=<?php echo "\"".$row2['Teacher_CName']."\""; ?> required>
            </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">修改</button>
          </div>
      </form>
     </div>
    </div>
  </div>
</body>
</html>

