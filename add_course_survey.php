<?php
    session_start();
    include('mysql_connect_inc.php');
if (isset($_SESSION['login_RNuikEEFpDrrjTQ'])){
    if ($_SESSION['login_RNuikEEFpDrrjTQ']!="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh"){
      echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
    } else {
        if (!isset($_SESSION['Course_ID'])){
          echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
        } else{
            $Course_ID = $_SESSION['Course_ID'];
            $sql = "SELECT * FROM `course_list` WHERE `Course_ID`='$Course_ID'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $site_name=$row['Course_CName'];
            $Course_CName=$row['Course_CName'];
            $Survey=$row['Survey'];
            $Survey_Teacher=$row['Survey_Teacher'];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['Survey'])){
                    $Survey = $_POST['Survey'];
                    $sql = "UPDATE `course_list` SET `Survey`='$Survey' WHERE `Course_ID`='$Course_ID'";
                    mysqli_query($con,$sql);

                    if ($Survey==1){
                        for($i=1; $i<=60; $i++){
                            $sql = "INSERT INTO `survey_item_name` (`ID`, `Problem_CName`, `Course_ID`) VALUES (NULL,NULL, '$Course_ID')";
                            mysqli_query($con,$sql);
                        }
                    }
                }
                if (isset($_POST['Survey_Teacher'])){
                    $Survey_Teacher = $_POST['Survey_Teacher'];
                    $sql = "UPDATE `course_list` SET `Survey_Teacher`='$Survey_Teacher' WHERE `Course_ID`='$Course_ID'";
                    mysqli_query($con,$sql);

                    if ($Survey_Teacher==1){
                        for($i=1; $i<=60; $i++){
                            $sql = "INSERT INTO `survey_item_name` (`ID`, `Problem_CName`, `Course_ID`,`Survey_Teacher`) VALUES (NULL,NULL, '$Course_ID','1')";
                            mysqli_query($con,$sql);
                        }
                    }
                }
                echo "<meta http-equiv=REFRESH CONTENT=0.01;url=add_course_survey.php>";
            }
        }
    }
} else{
    echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>新增課程問卷</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="font-family: DFKai-sb;">
<?php
include('header.php');
?>
<div class="container">
    <div class="row">
        <?php 
            include("left_side_bar.php");
        ?>
        <div class="col-sm-9">
            <?php 
                if ($Survey==0) {
            ?>
        <form action="" method="post">
            <div class="form-group">
                <h2>本課程尚未有學生問卷，請問此課程是否需要新增問卷:
                    <p>
                <select name="Survey" id="Survey" required>
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select></p></h2>
            </div>
            <button type="submit" class="btn btn-info">送出選擇</button>
        </form>
            <?php
                } else {
                    echo "<h4>本課程已經有學生問卷<h4>";
                    echo "<h4 style=\"text-align:center;\"><a href=\"survey/QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}\">學生問卷之網址</a></h4>";
                include_once('phpqrcode/qrlib.php');
                if (!file_exists("QRCode/QR_survey_{$_SESSION['Course_ID']}.png")){
                    QRcode::png("http://120.113.174.17/student/s1042653/M20180517/survey/QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}", "QRCode/QR_survey_{$_SESSION['Course_ID']}.png");
                }
                echo "<p style=\"text-align:center\"><img src=\"QRCode/QR_survey_{$_SESSION['Course_ID']}.png\"></p>";
                } 
            ?>
            <?php 
                if ($Survey_Teacher==0) {
            ?>
        <form action="" method="post">
            <div class="form-group">
                <h2>本課程尚未有教師問卷，請問此課程是否需要新增問卷:
                    <p>
                <select name="Survey_Teacher" id="Survey_Teacher" required>
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select></p></h2>
            </div>
            <button type="submit" class="btn btn-info">送出選擇</button>
        </form>
            <?php
                } else {
                    echo "<h4>本課程已經有教師問卷<h4>";
                    echo "<h4 style=\"text-align:center;\"><a href=\"survey/QR_survey_single_teacher.php?Course_ID={$_SESSION['Course_ID']}&Survey_Teacher=1\">教師問卷之網址</a></h4>";
                include_once('phpqrcode/qrlib.php');
                if (!file_exists("QRCode/QR_survey_{$_SESSION['Course_ID']}_1.png")){
                    QRcode::png("http://120.113.174.17/student/s1042653/M20180524/survey/QR_survey_single_teacher.php?Course_ID={$_SESSION['Course_ID']}&Survey_Teacher=1", "QRCode/QR_survey_{$_SESSION['Course_ID']}_1.png");
                }
                echo "<p style=\"text-align:center\"><img src=\"QRCode/QR_survey_{$_SESSION['Course_ID']}_1.png\"></p>";
                } 
            ?>
            
        </div>
    </div>
</div>
</body>
</html>