<?php
  	session_start();
  	include('mysql_connect.inc.php');
    include('header_php.php');

  	$year = $_GET['year'];
  	$activity_name = $_GET['activity_name'];    
    
    $sql = "SELECT `CName`,`number_survey_items` FROM `activity_list` WHERE `ID`='$activity_name'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    $site_name=$row[0];
    $number_survey_items=$row[1];
    

    $DataTable="";
    $DataTable[0][0]="人員編號";
    for($j=1; $j<=$number_survey_items; $j++){
      $DataTable[0][$j]="item_".sprintf('%02d',$j);
      //echo "item_".sprintf('%02d',$j);
    }
    //$DataTable[0][1]="總答題成功數";
    $sql = "SELECT * FROM `survey_result` WHERE `activity` = '$activity_name' and `Hide`='0'";
    $result = mysqli_query($con,$sql);
    for($i=1; $i<=mysqli_num_rows($result); $i++){
      $row=mysqli_fetch_assoc($result);
      $DataTable[$i][0]=$row['StudentID'];
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
    $ResultName="survey_results_".$activity_name."_".date("Y_m_d").".xlsx";
    $writer->writeToFile("./xlsx/".$ResultName);
    $sql = "UPDATE `activity_list` SET `survey_excel_name`='$ResultName' WHERE `ID` = '$activity_name'";
    mysqli_query($con,$sql);
    //echo "show_attendence_list.php";
    echo "<meta http-equiv=REFRESH CONTENT=0.01;url=show_survey_results.php>";
?>