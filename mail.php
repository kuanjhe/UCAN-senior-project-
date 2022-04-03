<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>學務處研習心得版</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
<script>
  $(function() {
    $( "#guestConfDate" ).datepicker({
      dateFormat:"yy/mm/dd",
      //defaultDate: "+1w",
      //changeMonth: true,
      //numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#guestConfDateEnd" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#guestConfDateEnd" ).datepicker({
      dateFormat:"yy/mm/dd",
      //defaultDate: "+1w",
      //changeMonth: true,
      //numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#guestConfDate" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
    
  </script>
  <style>
    th {
      width:150px;
    }
    td.conarea{
      word-break:break-all;
    }
  </style>
  
</head>

<body>
  <div class="container">
  <div class="row">
  <br>
<?php 
  include("mysql_connect.inc.php");
  $sql="SELECT * FROM GuestBoard where Hide = false and Approved = true order by GuestTime desc";
  $result = mysqli_query($con,$sql);//讓資料由最新呈現到最舊
  $data_nums = mysqli_num_rows($result); //統計總比數
  $per = 5; //每頁顯示項目數量
  $pages = ceil($data_nums/$per); //取得不小於值的下一個整數
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
  $start = ($page-1)*$per; //每一頁開始的資料序號
  $result = mysqli_query($con,$sql.' LIMIT '.$start.', '.$per) or die("Error");
  //$sql="SELECT * FROM GuestBoard where Hide = false order by GuestTime desc";
  //$result = mysqli_query($con,$sql);//讓資料由最新呈現到最舊
  //include("mysql_connect.inc.php");
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['checknum'])){
      if ($_POST['checknum']==$_SESSION["Checknum"]){
        $guestName=$_POST['guestName'];
        $guestEmailAddress=$_POST['guestEmailAddress'];
        $guestOrganization=$_POST['guestOrganization'];
        $guestConfName=$_POST['guestConfName'];
        $guestConfPlace=$_POST['guestConfPlace'];
        $guestConfDate=$_POST['guestConfDate'];
        $guestConfDateEnd=$_POST['guestConfDateEnd'];
        $guestContent=$_POST['guestContent'];
        $guestFeedback=$_POST['guestFeedback'];
        $guestWorkApplication=$_POST['guestWorkApplication'];
        date_default_timezone_set("Asia/Taipei");
        $guestTime = date("Y:m:d H:i:s",time());
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["guestPicture"]["name"]);
        $fileName=basename($_FILES["guestPicture"]["name"]);
        //echo $fileName;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $target_file = $target_dir. "IMG_" . random_password(15) . ".".$imageFileType;
        if (file_exists($target_file)) {
          /*echo "Sorry, file already exists.<br/>";
          echo "檔案已經存在，請勿重覆上傳相同檔案。<br/>";
          echo '<a href="images/';
          echo $_FILES["guestPicture"]["name"];
          echo '"';
          echo ' target="_blank"> ';
          echo $_FILES["guestPicture"]["name"];
          echo "</a><br>";*/
          $uploadOk = -1;
        } 
        if ($_FILES["guestPicture"]["size"] > 12097152) {
          //echo "Sorry, your file is too large.";
          $uploadOk = -2;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "JPG") {
          //echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.<br/>";
          $uploadOk = -3;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 1) {
          $target_file="";
          //echo "Sorry, your file was not uploaded.<br/>";
          // if everything is ok, try to upload file
        } else {
          move_uploaded_file($_FILES["guestPicture"]["tmp_name"], $target_file);
          /*if (move_uploaded_file($_FILES["guestPicture"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["guestPicture"]["name"]). " has been uploaded.<br/>";
              echo "檔案：". basename( $_FILES["guestPicture"]["name"]). "已經上傳。<br/>";
              echo "暫存名稱: " . $_FILES["guestPicture"]["tmp_name"]."<br/>";
              echo "檔案大小: " . ($_FILES["guestPicture"]["size"] / 1024)." Kb<br/>";
              echo "檔案類型: " . $_FILES["guestPicture"]["type"]."<br/>";
              echo "檔案名稱: " . $_FILES["guestPicture"]["name"]."<br/>";
              echo "檔案名稱: " . $target_file."<br/>";
          } else {
              echo "Sorry, there was an error uploading your file.<br/>";
          }*/
        }
        $guestCode=random_password(6);
        $sql="insert into GuestBoard value('','$guestCode','$guestName','$guestEmailAddress','$guestOrganization','$guestConfName','$guestConfPlace','$guestConfDate','$guestConfDateEnd','$guestContent','$guestFeedback','$guestWorkApplication','$guestTime','$target_file','','',0,'fileName')";
        $result2 = mysqli_query($con,$sql);
        unset($_FILES["guestPicture"]);
        //echo '<meta http-equiv=REFRESH CONTENT=0.01;url=index.php>';
        echo "<div class=\"container\">";
        echo "<div class=\"col-sm-12\" style=\"text-align: center\">";
        echo "<h2>";
        //if (0>1){
        if ($result2){
          
          include("phpmailer/class.phpmailer.php"); //匯入PHPMailer類別 
          $mail= new PHPMailer(); //建立新物件 
          $mail->IsSMTP(); //設定使用SMTP方式寄信 
          $mail->SMTPAuth = true; //設定SMTP需要驗證 
          $mail->Host = "mail.ncyu.edu.tw"; //設定SMTP主機(限在嘉義大學內) 
          $mail->Port = 25; //設定SMTP埠位，預設為25埠。 
          $mail->CharSet = "utf-8"; //設定郵件編碼 
          $mail->Username = "career"; //設定寄件者帳號 
          $mail->Password = ""; //設定寄件者密碼 
          $mail->From = "noreplay@mail.ncyu.edu.tw"; //設定寄件者信箱 
          $mail->FromName = "學務處"; //設定寄件者姓名 
          $mail->Subject = "學務處心得版有新訊息進來"; //設定郵件標題
          //設定郵件內容
          $mail->Body = "<div><p> 姓名 : $guestName <br><br>
                     單位 : $guestOrganization <br><br>
                     電子郵件 : $guestEmailAddress <br><br>
                     認證碼 : $guestCode <br><br>
                     會議名稱 : $guestConfName <br><br>
                     心得 : $guestContent </p></div>";
            $mail->IsHTML(true); //設定郵件內容為HTML 
            $mail->AddAddress($guestEmailAddress, $guestName); //設定收件者郵件及名稱
            $mail->AddAddress("stude@mail.ncyu.edu.tw", "陳惠蘭秘書"); //設定收件者郵件及名稱 

            if(!$mail->Send())
            {
              echo "Mailer Error: " . $mail->ErrorInfo; 
            }
            else
            {
              echo "<p> 姓名 : $guestName <br>
                     單位 : $guestOrganization <br>
                     電子郵件 : $guestEmailAddress <br>
                     認證碼 : $guestCode <br>
                     會議名稱 : $guestConfName <br>
                     心得 : $guestContent <br>
                     上傳資料成功<br>
                     謝謝，我們已經收到您的心得
                     </p>";
            }
          } else {
            echo "上傳資料失敗";
          }
          echo "</h2></div></div>";
        //header("location:index.php");
      } else {
        echo "<h4>驗證碼輸入錯誤！</h4>";
      }

    }
  }
  function random_password($length) {  
    ##### ÀH¾÷±K½X¥i¯à¥]§tªº¦r²Å
    $str = "123456789123456789123456789123456789123456789123456789123456789123456789123456789";
    $password = substr(str_shuffle($str), 0, $length);
    return $password;
  }
?>
  </div>
</div>  

<div class="container">
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1"><strong>新增留言</strong></button>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2"><strong>修改留言</strong></button>
  <div id="demo1" class="collapse">
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <label for="guestName" class="col-sm-4 control-label">姓名：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您的姓名" name="guestName" id="guestName" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label for="guestName" class="col-sm-4 control-label">電子郵件：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您的電子郵件" name="guestEmailAddress" id="guestEmailAddress" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label for="guestOrganization" class="col-sm-4 control-label">單位：</label>
            <div class="col-sm-6">
              <select class="form-control" name="guestOrganization" id="guestOrganization" required="required" >
                <option>學生事務處</option>
                <option>生活輔導組</option>
                <option>軍訓組</option>
                <option>課外活動指導組</option>
                <option>學生職涯發展中心</option>
                <option>民雄學務組</option>
                <option>原住民族學生資源中心</option>
                <option>特殊教育學生資源中心</option>
                <option>學生輔導中心</option>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label for="guestConfName" class="col-sm-4 control-label">會議名稱：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您參加的會議名稱" name="guestConfName" id="guestConfName" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label for="guestConfPlace" class="col-sm-4 control-label">會議地點：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您參加的會議地點" name="guestConfPlace" id="guestConfPlace" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label for="guestConfDate" class="col-sm-4 control-label">會議日期(開始)：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您參加的會議日期(開始)" name="guestConfDate" id="guestConfDate" required="required" />
            </div>
        </div>
        <div class="form-group">
            <label for="guestConfDateEnd" class="col-sm-4 control-label">會議日期(結束)：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您參加的會議日期(結束)" name="guestConfDateEnd" id="guestConfDateEnd" required="required" />
            </div>
        </div>
        <div class="form-group">
          <label for="guestContent" class="col-sm-4 control-label">研習內容：</label>
          <div class="col-sm-6">
              <textarea name="guestContent" class="form-control" id="guestContent" rows="5" required="required" ></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="guestFeedback" class="col-sm-4 control-label">研習心得及期許：</label>
          <div class="col-sm-6">
              <textarea name="guestFeedback" class="form-control" id="guestFeedback" rows="5" required="required" ></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="guestWorkApplication" class="col-sm-4 control-label">工作應用：</label>
          <div class="col-sm-6">
              <textarea name="guestWorkApplication" class="form-control" id="guestWorkApplication" rows="5" required="required" ></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="guestPicture" class="col-sm-4 control-label">上傳照片：</label>
          <div class="col-sm-6">
              <input type="file" name="guestPicture" class="form-control" id="guestPicture" required="required"/>
          </div>
        </div>
        <div class="form-group">
          <label for="checknum" class="col-sm-4 control-label">驗證碼 : <img src="showrandimg.php" id="rand-img">
( <a href="#" id="reload-img">重新產生</a> )</label>
          <div class="col-sm-6">
              <input type="text" name="checknum" class="form-control" id="checknum" required="required"/>
          </div>
        </div>
        <div class="button" align="center">
            <input type="submit" name="button" id="button" value="送出" class="btn"/>
        </div>
    </form>
  </div>
  <div id="demo2" class="collapse">
    <form id="form2" name="form2" method="post" action="SelectedSelfMessage.php" class="form-horizontal">
        <div class="form-group">
            <label for="guestEmail" class="col-sm-4 control-label">電子郵件：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您的電子郵件" name="guestEmail" id="guestEmail" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label for="guestCode" class="col-sm-4 control-label">認證碼：</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="您的認證碼" name="guestCode" id="guestCode" required="required"/>
            </div>
        </div>
        <div class="button" align="center">
            <input type="submit" name="button2" id="button2" value="進入修改" class="btn"/>
        </div>
    </form>
  </div>   
</div>

<div class="container">
  <div class="col-sm-12">
    <center>
      <h1>研習心得分享</h1>
    </center>
  </div>
</div>



<div class="container">
  <div class="col-sm-12" style="text-align: center">
<?php
    //分頁頁碼
    echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>
  </div>
</div>




<?php
for($i=1;$i<=mysqli_num_rows($result);$i++){
 $rs=mysqli_fetch_assoc($result);
?>
<div class="container" style="border: 2px solid blue;border-radius: 5px;">
  <div class="row"><p></p></div>
  <div class="col-sm-6">
    <table class="table table-hover table-bordered">
    <tr><th>姓名</th>
    <td>
    <?php echo $rs['GuestName']?>
    </td><tr></table>
  </div>
  <div class="col-sm-6">
    <table class="table table-hover table-bordered">
    <tr><th>單位</th>
    <td>
    <?php echo $rs['GuestOrganization']?>
    </td><tr></table>
  </div>
  <div class="col-sm-6">
    <table class="table table-hover table-bordered">
    <tr><th>會議名稱</th>
    <td>
    <?php echo $rs['GuestConfName']?>
    </td><tr></table>
  </div>
  <div class="col-sm-6">
    <table class="table table-hover table-bordered">
    <tr><th>會議地點</th>
    <td>
    <?php echo $rs['GuestConfPlace']?>
    </td><tr></table>
  </div>
  <div class="col-sm-6">
    <table class="table table-hover table-bordered">
    <tr><th>會議日期</th>
    <td>
    <?php echo $rs['GuestConfDate']."~".$rs['GuestConfDateEnd']?>
    </td><tr></table>
  </div>
  <div class="col-sm-6">
    <table class="table table-hover table-bordered">
    <tr><th>發表時間</th>
    <td>
    <?php echo $rs['GuestTime']?>
    </td><tr></table>
  </div>
  <div class="col-sm-12">
    <table class="table table-hover table-bordered">
    <tr><th>研習內容</th>
    <td class="conarea">
    <?php echo $rs['GuestContent']?>
    </td><tr></table>
  </div>
  <div class="col-sm-12">
    <table class="table table-hover table-bordered">
    <tr><th>研習心得及期許</th>
    <td class="conarea">
    <?php echo $rs['GuestFeedback']?>
    </td><tr></table>
  </div>
  <div class="col-sm-12">
    <table class="table table-hover table-bordered">
    <tr><th>工作應用</th>
    <td class="conarea">
    <?php echo $rs['GuestWorkApplication']?>
    </td><tr></table>
  </div> 
  <div class="col-sm-12">
    <table class="table table-hover table-bordered">
    <tr><th>照片</th>
    <td class="conarea" style="text-align: center">
    <?php 
      if (empty($rs['GuestPicture'])){
        echo "無";
      } else {
        echo '<img src="'.$rs['GuestPicture'].'" height="250">';
      }
    ?>
    </td><tr></table>
  </div> 
</div>
<p>&nbsp;</p>
<?php } ?>

<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<script language="javascript">
(function()
{
  // 重新載入圖形的函數，適用於任何圖形
  var reloadImg = function(dImg)
  {
    // 取得圖形原本的來源 url
    var sOldUrl = dImg.src;
      // 在原本的 url 後面加上亂數的參數，變成新的 url
      var sNewUrl = sOldUrl + "?rnd=" + Math.random();
      //將圖形的來源改為新的 url，就會重新載入圖形了
      dImg.src = sNewUrl;
  };

  // 取得重新載入的超連結元素
  var dReloadLink = document.getElementById("reload-img");
 
  // 取得驗證碼圖形元素
  var dImg = document.getElementById("rand-img");
 
  // 定義這個超連結的 onclick 事件
  dReloadLink.onclick = function(e)
  {
    // 呼叫函數重新載入驗證碼圖形
        reloadImg(dImg);
        //停止事件預設的動作，也就是不要跳到超連結的網址
        if(e) e.preventDefault();
        return false;
  };
})();
</script>