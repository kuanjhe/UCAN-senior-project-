<?php 
session_start(); 
include("mysql_connect_inc.php");
include("header.php");
if(isset($_GET['reset'])){
  if($_GET['reset']==1){
    unset($_SESSION['Process']);
    unset($_SESSION['User_ID_2']);
    unset($_SESSION['Name_2']);
    unset($_SESSION['Email_2']);
    unset($_SESSION['Code']);
    echo "<meta http-equiv=REFRESH CONTENT=0;url=forget_pw.php>";
  }
}
?>

<?php

//unset($_SESSION['Process']);
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(isset($_POST['User_ID_2'])){
    $_SESSION['User_ID_2']=$_POST['User_ID_2'];
    //$User_ID = $_POST['User_ID'];

    $sql = "SELECT * FROM `member` WHERE `User_ID`='{$_SESSION['User_ID_2']}'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['Name_2']=$row['Name'];
    $_SESSION['Email_2']=$row['Email'];
    $_SESSION['Code']=rand();

    //$_SESSION['Name']=$row['Name'];
    //$_SESSION['Email']=$row['Email'];
    //$_SESSION['Code']=rand();
    
    
    $Organization="共通職能調查";
    
    

    echo "<div class=\"container\">
                <div class=\"col-sm-12\">";
                
    if ((mysqli_num_rows($result)==0) or ($_SESSION['User_ID_2']!=$row['User_ID'])){
      $error=1;
      
      } else{
        

        include("phpmailer/class.phpmailer.php"); //匯入PHPMailer類別 
            $mail= new PHPMailer(); //建立新物件 
            $mail->IsSMTP(); //設定使用SMTP方式寄信 
            //$mail->SMTPDebug = 2;
            //$mail->SMTPSecure = "ssl";
            $mail->SMTPAuth = true; //設定SMTP需要驗證 
            $mail->Host = "mail.ncyu.edu.tw"; //設定SMTP主機(限在嘉義大學內) 
            $mail->Port = 25; //設定SMTP埠位，預設為25埠。 
            $mail->CharSet = "utf-8"; //設定郵件編碼 
            $mail->Username = "s1042653@mail.ncyu.edu.tw"; //設定寄件者帳號 
            $mail->Password = "Justfor39"; //設定寄件者密碼 
            $mail->From = "s1042653@mail.ncyu.edu.tw"; //設定寄件者信箱 
            $mail->FromName = "共通職能調查"; //設定寄件者姓名 
            $mail->Subject = "重設密碼信件"; //設定郵件標題
            //設定郵件內容
            $mail->Body = "<div><p> 姓名 : ".$_SESSION['Name_2']." <br><br>
                       單位 : $Organization <br><br>
                       主旨 : 共通職能調查重設密碼<br><br>
                       認證碼 : ".$_SESSION['Code']." <br><br>";

              $mail->IsHTML(true); //設定郵件內容為HTML 
              $mail->AddAddress($_SESSION['Email_2'], $_SESSION['Name_2']); //設定收件者郵件及名稱
              

              if(!$mail->Send())
              {
                echo "Mailer Error: " . $mail->ErrorInfo; 
              }
              else
              {
                $_SESSION['Process'] = 1;    
              }
              echo "</h2></div></div>";
        }
    }


    if(isset($_POST['Verification_code'])){
      $Verification_code=$_POST['Verification_code'];
      if($_SESSION['Code']==$Verification_code){
        $_SESSION['Process']=2;
      }else{
        $error=2;
      }
    }

    if(isset($_POST['password'])){
      $password=$_POST['password'];
      $password2=$_POST['password2'];

      if($password==$password2){
        $_SESSION['Process']=3;
      }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>學生課程意見調查</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
</head>
<body style="font-family: DFKai-sb;">

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 style="text-align:center;">忘記密碼流程頁面</h2>
      <?php

      if(!isset($_SESSION['Process'])){
        
        echo "<form name=\"form1\" method=\"post\" action=\"\">
              <div class=\"form-group\">
                <label for=\"User_ID\">帳號:</label>
                <input type=\"username\" class=\"form-control\" id=\"User_ID\" placeholder=\"請輸入帳號\" name=\"User_ID_2\" required>
              </div>
              <div align=\"center\">
                <input type=\"submit\" role=\"button\" class=\"btn btn-info\" value=\"確認送出\">   
                <input class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\" type =\"button\" onclick=\"history.back()\" value=\"回到上一頁\"></input>
              </div>
            </form>";
        if(isset($error)){
          if($error==1){
            echo "<h2 style=\"text-align:center;\">";
            echo "帳號不存在<br>請重新輸入<br>";
            echo "</h2>";
            echo "<meta http-equiv=REFRESH CONTENT=2;url=forget_pw.php>";
          }
        }
      }elseif($_SESSION['Process']==1){
        echo "<div class=\"container\">
              <div class=\"col-sm-12\">
              <h2 style=\"text-align:center;\">
              <p> 你好 ".$_SESSION['Name_2']." <br>
                     已發送重設驗證碼至 ".$_SESSION['Email_2']." <br><br>
              </p></h2>
              <form name=\"form2\" method=\"post\" action=\"\">
                      <div class=\"form-group\">
                        <label for=\"Verification_code\">驗證碼:</label>
                          <input type=\"text\" class=\"form-control\" id=\"Verification_code\" placeholder=\"請輸入驗證碼\" name=\"Verification_code\" required>
                      </div>
                      <div align=\"center\">
                        <input type=\"submit\" role=\"button\" class=\"btn btn-info\" value=\"確認送出\">
                        <a href=\"forget_pw.php?reset=1\" class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\" role=\"button\">重新填寫</a>   
                        <a href=\"index.php\" class=\"btn btn-outline-dark\" role=\"button\">回首頁</a>
                    </form>";
        if(isset($error)){
          if($error==2){
            echo "<h2 style=\"text-align:center;\">";
            echo "驗證碼錯誤<br>請重新輸入<br>";
            echo "</h2>";
            echo "<meta http-equiv=REFRESH CONTENT=2;url=forget_pw.php>";
          }
        }
        echo "</div></div>";
      }elseif($_SESSION['Process']==2){
        echo "<form name=\"form3\" method=\"post\" action=\"\">
              <div class=\"form-group\">
                <label for=\"User_ID\">帳號:</label>
                <input type=\"username\" class=\"form-control\" id=\"User_ID\" placeholder=\"請輸入帳號\" name=\"User_ID_2\" value=\"{$_SESSION['User_ID_2']}\" readonly>
              </div>
              <div class=\"form-group\">
                <label for=\"password\">新密碼:</label>
                <input type=\"password\" class=\"form-control\" id=\"password\" placeholder=\"請輸入新密碼\" name=\"password\" required>
              </div>
              <div class=\"form-group\">
                <label for=\"password2\">再次確認新密碼:</label>
                <input type=\"password\" class=\"form-control\" id=\"password2\" placeholder=\"請確認新密碼\" name=\"password2\" required>
              </div>
              <div align=\"center\">
                <input type=\"submit\" role=\"button\" class=\"btn btn-info\" value=\"確認送出\">   
                <a href=\"index.php\" class=\"btn btn-outline-dark\" role=\"button\">回首頁</a>
              </div>
            </form>";
      }elseif($_SESSION['Process']==3){
        $sql = "UPDATE `member` SET `Password` = '$password' WHERE `User_ID`='{$_SESSION['User_ID_2']}'";
        if(mysqli_query($con,$sql)){
          
          echo "<div class=\"container\">
              <div class=\"col-sm-12\">
              <h2 style=\"text-align:center;\">
              <p> 你好 ".$_SESSION['Name_2']." <br><br>
                  密碼已重製 請重新登入<br>
              </p></h2></div></div>";
          unset($_SESSION['Process']);
          unset($_SESSION['Name_2']);
          unset($_SESSION['User_ID_2']);
          unset($_SESSION['Email_2']);
          echo "<div align=\"center\">   
                
                <a href=\"index.php\" class=\"btn btn-outline-dark\" role=\"button\">回首頁</a>
              </div>";
        }
        
      }
      
      ?>


    </div>
  </div>
</div>
</body>
</html>