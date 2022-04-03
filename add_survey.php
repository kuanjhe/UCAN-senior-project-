<?php
    session_start();
    include('mysql_connect.inc.php');
    include('header_php.php');
    if (!isset($_SESSION['activity_id'])){
        echo "<meta http-equiv=REFRESH CONTENT=0.01;url=choose_activity.php>";
    }
    $activity = $_SESSION['activity_id'];
    $additional_string = " and `Activity`='$activity'";
    $sql = "SELECT `CName`,`Survey` FROM `activity_list` WHERE `ID`='$activity'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $site_name=$row['CName'];
    $Survey=$row['Survey'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Survey'])){
            $Survey = $_POST['Survey'];
           $sql = "UPDATE `activity_list` SET `Survey`='$Survey' WHERE `ID`='{$activity}'";
           mysqli_query($con,$sql);
            if ($Survey==1){
                for($i=1; $i<=50; $i++){
                    $sql = "INSERT INTO `survey_item_name` (`ID`, `CName`, `Activity`) VALUES (NULL, NULL, '{$activity}')";
                    mysqli_query($con,$sql);
                }
            }
        }
        if (isset($_POST['Check-in-with-Survey'])){
            $CheckinwithSurvey = $_POST['Check-in-with-Survey'];
           $sql = "UPDATE `activity_list` SET `Survey`='$CheckinwithSurvey' WHERE `ID`='{$activity}'";
           mysqli_query($con,$sql);
        }
        echo "<meta http-equiv=REFRESH CONTENT=0.01;url=add_survey.php>";
    } 
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $site_name?></title>
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
                <h2>本活動尚未有問卷，請問此活動是否需要新增問卷:
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
        			//echo "<h4>本活動已經有問卷</h4>";
        	?>
            <form action="" method="post">
                <div class="form-group">
            <?php
                if ($Survey==2) {
                    echo "<h4>本活動已經有問卷<h4>";
                    echo "<h4 style=\"text-align:center;\"><a href=\"survey/survey-single.php?activity={$_SESSION['activity_id']}\">問卷之網址</a></h4>";
                include_once('phpqrcode/qrlib.php');
                if (!file_exists("QRCode/QR_survey_{$_SESSION['year']}{$_SESSION['activity_id']}.png")){
                    QRcode::png("http://{$_SERVER['HTTP_HOST']}{$_SESSION["home_dir"]}/survey/survey-single.php?activity={$_SESSION['activity_id']}", "QRCode/QR_survey_{$_SESSION['year']}{$_SESSION['activity_id']}.png");
                }
                echo "<p style=\"text-align:center\"><img src=\"QRCode/QR_survey_{$_SESSION['year']}{$_SESSION['activity_id']}.png\" alt=\"http://{$_SERVER['HTTP_HOST']}{$_SESSION["home_dir"]}/survey/survey-single.php?activity={$_SESSION['activity_id']}\"></p>";
                    echo "<h4>且活動報到搭配問卷，請問此活動報到是否需要搭配問卷:";
                } else {
                    echo "<h4>本活動已經有問卷<h4>";
                    echo "<h4 style=\"text-align:center;\"><a href=\"survey/survey-single.php?activity={$_SESSION['activity_id']}\">問卷之網址</a></h4>";
                include_once('phpqrcode/qrlib.php');
                if (!file_exists("QRCode/QR_survey_{$_SESSION['year']}{$_SESSION['activity_id']}.png")){
                    QRcode::png("http://{$_SERVER['HTTP_HOST']}{$_SESSION["home_dir"]}/survey/survey-single.php?activity={$_SESSION['activity_id']}", "QRCode/QR_survey_{$_SESSION['year']}{$_SESSION['activity_id']}.png");
                }
                echo "<p style=\"text-align:center\"><img src=\"QRCode/QR_survey_{$_SESSION['year']}{$_SESSION['activity_id']}.png\" alt=\"http://{$_SERVER['HTTP_HOST']}{$_SESSION["home_dir"]}/survey/survey-single.php?activity={$_SESSION['activity_id']}\"></p>";
                    echo "<h4>但是活動報到沒有搭配問卷，請問此活動報到是否需要搭配問卷:";
                }
            ?>
                    
                        <p>
                    <select name="Check-in-with-Survey" id="Check-in-with-Survey" required>
                        <option value="2">是</option>
                        <option value="1">否</option>
                    </select></p></h4>
                </div>
                <button type="submit" class="btn btn-info">送出選擇</button>
            </form>
            <?php
                } 
            ?>
        </div>
    </div>
</div>
</body>
</html>