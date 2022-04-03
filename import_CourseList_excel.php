<?php
	session_start();
	include('mysql_connect_inc.php');
	include('survey/header_php.php');
  if(!isset($_SESSION['Survey_ID'])){
    echo "<meta http-equiv=REFRESH CONTENT=0;url=jump_course.php>";
  } else{
    $Survey_ID=$_SESSION['Survey_ID'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<title>登記學生修讀課程</title>
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
<body style="font-family: DFKai-sb;">
<?php
	include("header.php");
?>
  
<div class="container">
  <div class="row">
    <?php include("left_side_bar.php");?>
    <div class="col-sm-8">      
		  
			 <h2 style="text-align:center;">Excel匯入修讀清單</h2>
			 <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
          <div class="form-group">
            <h4>請將檔案類型轉為 Excel 97-2003 活頁簿 (.xls)</h4>
            <input type="file" name="file" id="file" accept=".xls,.xlsx"><button type="submit" id="submit" name="import" class="btn-submit">匯入</button>
          </div>
        </form>
<?php    
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once('php-excel-reader/excel_reader2.php');
    require_once('SpreadsheetReader.php');
    echo "<div>";
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if(in_array($_FILES["file"]["type"],$allowedFileType)){
      $targetPath = 'uploads/'.$_FILES['file']['name'];
      move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
      $Reader = new SpreadsheetReader($targetPath);
      $sheetCount = count($Reader->sheets());

        for($i=0;$i<$sheetCount;$i++){
            echo "<h2>Sheet {$i}</h2>";
            $Reader->ChangeSheet($i);
            
            echo "<table class='table table-striped'>";            
            echo "<tbody>\n";
            echo "<tr>";
            echo "<th>學號</th>";
            echo "<th>姓名</th>";
            echo "<th>成績</th>";
            echo "<th>上傳狀態</th>";
            foreach ($Reader as $Key=>$Row){
                $StudentID = "";                
                  if(isset($Row[1])) {
                    $StudentID = $Row[1];
                  }  

                $Name = "";                   
                if(isset($Row[2])) {
                    $Name = $Row[2];
                }     

                $Grade = ""; 
                if(isset($Row[21])) {
                    $Grade = $Row[21];
                }
                                
                //echo $StudentID." ".$Name." ".$NFC_ID2." ".$NFC_ID."<br>\n";
                 
                   
                if ($Key!=0 && $Key>7){
                  echo "<tr>";
                  echo "<td>{$StudentID}</td>";
                  echo "<td>{$Name}</td>";
                  echo "<td>{$Grade}</td>";
                  
                  $sql = "SELECT * FROM `student_list` WHERE `StudentID`='$StudentID' AND `Survey_ID`='$Survey_ID'";
                  $result=mysqli_query($con,$sql);
                  $row = mysqli_fetch_assoc($result);
                  if (mysqli_num_rows($result)>=1){
                    $sql = "UPDATE `student_list` SET `Teacher_check` = '1',`Name`='$Name',`Grade`='$Grade' WHERE `StudentID`='$StudentID' AND `Survey_ID`='$Survey_ID'";
                    if (mysqli_query($con,$sql)){
                      echo "<td>資料更新成功</td>";
                    } else {
                      echo "<td>資料更新失敗</td>";
                    }
                    
                  } else { 
                    $sql = "INSERT INTO `student_list` (`ID`, `StudentID`, `Survey_ID`, `Student_check`, `Teacher_check`,`Survey`,`Survey_Teacher`,`Grade`,`Time`,`Hide`,`Name`) VALUES (NULL, '{$StudentID}', '{$Survey_ID}','0','1','0','1','$Grade',CURRENT_TIME,'0','$Name')";
                    
                    if (mysqli_query($con,$sql)){
                      echo "<td>上傳成功</td>";
                    } else {
                      echo "<td>上傳失敗</td>";
                    }
                  }
                } 
                                                      
                echo "</tr>\n";
            }
            echo "</tbody>";
            echo "</table>";                  
         }  
       }else { 
              $type = "error";
              $message = "Invalid File Type. Upload Excel File.";

            } 
      echo "</div>";
    }
  

?>
      <!--div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
      </div-->		  
    </div>
  </div>
</div>

</body>
</html>
