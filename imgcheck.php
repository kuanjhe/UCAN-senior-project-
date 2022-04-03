<?php
 Session_start();
 if( $_SESSION&#91;"Checknum"&#93; == $_POST&#91;'checknum'&#93; )
 {
     $msg = "您所輸入的驗證碼正確！";
 }
 else
 {
     $msg = "您所輸入的驗證碼錯誤！請回上一頁重新輸入。 ";
 }
 echo $msg;
?>