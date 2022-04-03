<?php
  	session_start();
  	include('mysql_connect_inc.php');
    include('header_php.php');

  	$Survey_ID = $_GET['Survey_ID']; 
    
    $sql = "SELECT * FROM `course_list` WHERE `Survey_ID`='$Survey_ID'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $site_name=$row['Course_CName'];
    $number_survey_items=$row['number_survey_items'];
    

    $DataTable="";
    $DataTable[0][0]="人員編號";
    for($j=1; $j<=$number_survey_items; $j++){
      $DataTable[0][$j]="item_".sprintf('%02d',$j);
      //echo "item_".sprintf('%02d',$j);
    }
    //$DataTable[0][1]="總答題成功數";
    $sql = "SELECT * FROM `survey_result` WHERE `Survey_ID` = '$Survey_ID'  AND `Hide`='0' AND `Teacher` IS NULL";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=mysqli_num_rows($result); $i++){
      $row=mysqli_fetch_assoc($result);
      $DataTable[$i][0]=$row['UserID'];
      for($j=1; $j<=$number_survey_items; $j++){
        $DataTable[$i][$j]=$row['item_'.sprintf('%02d',$j)];
        //echo 'item_'.sprintf('%02d',$j);
      }
    }

    include("xlsxwriter.class.php");
    $writer = new XLSXWriter();
    $format = array('font'=>'Arial','font-size'=>10,'halign'=>'center');
    foreach($DataTable as $row_data)
      $writer->writeSheetRow("list",$row_data,$format);
    $ResultName="survey_results_".$Survey_ID."_".date("Y_m_d").".xlsx";
    $writer->writeToFile("./xlsx/".$ResultName);
    $sql = "UPDATE `course_list` SET `survey_excel_name`='$ResultName' WHERE `Survey_ID` = '$Survey_ID'";
    mysqli_query($con,$sql);
    //echo "show_attendence_list.php";
    echo "<meta http-equiv=REFRESH CONTENT=0.01;url=show_survey_results.php>";
?>