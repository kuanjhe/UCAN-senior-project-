  <?php   
    $sql = "SELECT * FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>=1){
      $num=mysqli_num_rows($result);
  error_reporting(E_ALL ^ E_NOTICE); 
      $count1_1_1=0;
      $count1_1_2=0;
      $count1_1_3=0;
      $count1_1_4=0;
      $count1_1_5=0;

    
    
    $sql2 = "SELECT `item_01` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_01']==1)
            $count1_1_1=$count1_1_1+1;
        elseif($row2['item_01']==2)
            $count1_1_2=$count1_1_2+1;
        elseif($row2['item_01']==3)
            $count1_1_3=$count1_1_3+1;
        elseif($row2['item_01']==4)
            $count1_1_4=$count1_1_4+1;
        elseif($row2['item_01']==5)
            $count1_1_5=$count1_1_5+1;
        
    }

      $count1_2_1=0;
      $count1_2_2=0;
      $count1_2_3=0;
      $count1_2_4=0;
      $count1_2_5=0;

    $sql2 = "SELECT `item_02` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_02']==1)
            $count1_2_1=$count1_2_1+1;
        elseif($row2['item_02']==2)
            $count1_2_2=$count1_2_2+1;
        elseif($row2['item_02']==3)
            $count1_2_3=$count1_2_3+1;
        elseif($row2['item_02']==4)
            $count1_2_4=$count1_2_4+1;
        elseif($row2['item_02']==5)
            $count1_2_5=$count1_2_5+1;
        
    }

      $count1_3_1=0;
      $count1_3_2=0;
      $count1_3_3=0;
      $count1_3_4=0;
      $count1_3_5=0;

    $sql2 = "SELECT `item_03` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_03']==1)
            $count1_3_1=$count1_3_1+1;
        elseif($row2['item_03']==2)
            $count1_3_2=$count1_3_2+1;
        elseif($row2['item_03']==3)
            $count1_3_3=$count1_3_3+1;
        elseif($row2['item_03']==4)
            $count1_3_4=$count1_3_4+1;
        elseif($row2['item_03']==5)
            $count1_3_5=$count1_3_5+1;
        
    }

      $count1_4_1=0;
      $count1_4_2=0;
      $count1_4_3=0;
      $count1_4_4=0;
      $count1_4_5=0;

    $sql2 = "SELECT `item_04` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_04']==1)
            $count1_4_1=$count1_4_1+1;
        elseif($row2['item_04']==2)
            $count1_4_2=$count1_4_2+1;
        elseif($row2['item_04']==3)
            $count1_4_3=$count1_4_3+1;
        elseif($row2['item_04']==4)
            $count1_4_4=$count1_4_4+1;
        elseif($row2['item_04']==5)
            $count1_4_5=$count1_4_5+1;
        
    }

      $count1_5_1=0;
      $count1_5_2=0;
      $count1_5_3=0;
      $count1_5_4=0;
      $count1_5_5=0;

    $sql2 = "SELECT `item_05` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_05']==1)
            $count1_5_1=$count1_5_1+1;
        elseif($row2['item_05']==2)
            $count1_5_2=$count1_5_2+1;
        elseif($row2['item_05']==3)
            $count1_5_3=$count1_5_3+1;
        elseif($row2['item_05']==4)
            $count1_5_4=$count1_5_4+1;
        elseif($row2['item_05']==5)
            $count1_5_5=$count1_5_5+1;
        
    }

      $count1_6_1=0;
      $count1_6_2=0;
      $count1_6_3=0;
      $count1_6_4=0;
      $count1_6_5=0;

    $sql2 = "SELECT `item_06` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_06']==1)
            $count1_6_1=$count1_6_1+1;
        elseif($row2['item_06']==2)
            $count1_6_2=$count1_6_2+1;
        elseif($row2['item_06']==3)
            $count1_6_3=$count1_6_3+1;
        elseif($row2['item_06']==4)
            $count1_6_4=$count1_6_4+1;
        elseif($row2['item_06']==5)
            $count1_6_5=$count1_6_5+1;
        
    }
      
      $count1_7_1=0;
      $count1_7_2=0;
      $count1_7_3=0;
      $count1_7_4=0;
      $count1_7_5=0;

    $sql2 = "SELECT `item_07` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_07']==1)
            $count1_7_1=$count1_7_1+1;
        elseif($row2['item_07']==2)
            $count1_7_2=$count1_7_2+1;
        elseif($row2['item_07']==3)
            $count1_7_3=$count1_7_3+1;
        elseif($row2['item_07']==4)
            $count1_7_4=$count1_7_4+1;
        elseif($row2['item_07']==5)
            $count1_7_5=$count1_7_5+1;
        
    }
  
  $a1=$count1_1_1+$count1_2_1+$count1_3_1+$count1_4_1+$count1_5_1+$count1_6_1+$count1_7_1;
  $a2=$count1_1_2+$count1_2_2+$count1_3_2+$count1_4_2+$count1_5_2+$count1_6_2+$count1_7_2;
  $a3=$count1_1_3+$count1_2_3+$count1_3_3+$count1_4_3+$count1_5_3+$count1_6_3+$count1_7_3;
  $a4=$count1_1_4+$count1_2_4+$count1_3_4+$count1_4_4+$count1_5_4+$count1_6_4+$count1_7_4;
  $a5=$count1_1_5+$count1_2_5+$count1_3_5+$count1_4_5+$count1_5_5+$count1_6_5+$count1_7_5;
  
 
  $m1=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count2_1_1=0;
      $count2_1_2=0;
      $count2_1_3=0;
      $count2_1_4=0;
      $count2_1_5=0;

    
    $sql2 = "SELECT `item_08` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_08']==1)
            $count2_1_1=$count2_1_1+1;
        elseif($row2['item_08']==2)
            $count2_1_2=$count2_1_2+1;
        elseif($row2['item_08']==3)
            $count2_1_3=$count2_1_3+1;
        elseif($row2['item_08']==4)
            $count2_1_4=$count2_1_4+1;
        elseif($row2['item_08']==5)
            $count2_1_5=$count2_1_5+1;
        
    }

      $count2_2_1=0;
      $count2_2_2=0;
      $count2_2_3=0;
      $count2_2_4=0;
      $count2_2_5=0;

    $sql2 = "SELECT `item_09` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_09']==1)
            $count2_2_1=$count2_2_1+1;
        elseif($row2['item_09']==2)
            $count2_2_2=$count2_2_2+1;
        elseif($row2['item_09']==3)
            $count2_2_3=$count2_2_3+1;
        elseif($row2['item_09']==4)
            $count2_2_4=$count2_2_4+1;
        elseif($row2['item_09']==5)
            $count2_2_5=$count2_2_5+1;
        
    }

      $count2_3_1=0;
      $count2_3_2=0;
      $count2_3_3=0;
      $count2_3_4=0;
      $count2_3_5=0;

    $sql2 = "SELECT `item_10` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_10']==1)
            $count2_3_1=$count2_3_1+1;
        elseif($row2['item_10']==2)
            $count2_3_2=$count2_3_2+1;
        elseif($row2['item_10']==3)
            $count2_3_3=$count2_3_3+1;
        elseif($row2['item_10']==4)
            $count2_3_4=$count2_3_4+1;
        elseif($row2['item_10']==5)
            $count2_3_5=$count2_3_5+1;
        
    }

      $count2_4_1=0;
      $count2_4_2=0;
      $count2_4_3=0;
      $count2_4_4=0;
      $count2_4_5=0;

    $sql2 = "SELECT `item_11` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_11']==1)
            $count2_4_1=$count2_4_1+1;
        elseif($row2['item_11']==2)
            $count2_4_2=$count2_4_2+1;
        elseif($row2['item_11']==3)
            $count2_4_3=$count2_4_3+1;
        elseif($row2['item_11']==4)
            $count2_4_4=$count2_4_4+1;
        elseif($row2['item_11']==5)
            $count2_4_5=$count2_4_5+1;
        
    }

      $count2_5_1=0;
      $count2_5_2=0;
      $count2_5_3=0;
      $count2_5_4=0;
      $count2_5_5=0;

    $sql2 = "SELECT `item_12` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_12']==1)
            $count2_5_1=$count2_5_1+1;
        elseif($row2['item_12']==2)
            $count2_5_2=$count2_5_2+1;
        elseif($row2['item_12']==3)
            $count2_5_3=$count2_5_3+1;
        elseif($row2['item_12']==4)
            $count2_5_4=$count2_5_4+1;
        elseif($row2['item_12']==5)
            $count2_5_5=$count2_5_5+1;
        
    }

      $count2_6_1=0;
      $count2_6_2=0;
      $count2_6_3=0;
      $count2_6_4=0;
      $count2_6_5=0;

    $sql2 = "SELECT `item_13` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_13']==1)
            $count2_6_1=$count2_6_1+1;
        elseif($row2['item_13']==2)
            $count2_6_2=$count2_6_2+1;
        elseif($row2['item_13']==3)
            $count2_6_3=$count2_6_3+1;
        elseif($row2['item_13']==4)
            $count2_6_4=$count2_6_4+1;
        elseif($row2['item_13']==5)
            $count2_6_5=$count2_6_5+1;
        
    }
      
      $count2_7_1=0;
      $count2_7_2=0;
      $count2_7_3=0;
      $count2_7_4=0;
      $count2_7_5=0;

    $sql2 = "SELECT `item_14` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_14']==1)
            $count2_7_1=$count2_7_1+1;
        elseif($row2['item_14']==2)
            $count2_7_2=$count2_7_2+1;
        elseif($row2['item_14']==3)
            $count2_7_3=$count2_7_3+1;
        elseif($row2['item_14']==4)
            $count2_7_4=$count2_7_4+1;
        elseif($row2['item_14']==5)
            $count2_7_5=$count2_7_5+1;
        
    }
  
  $a1=$count2_1_1+$count2_2_1+$count2_3_1+$count2_4_1+$count2_5_1+$count2_6_1+$count2_7_1;
  $a2=$count2_1_2+$count2_2_2+$count2_3_2+$count2_4_2+$count2_5_2+$count2_6_2+$count2_7_2;
  $a3=$count2_1_3+$count2_2_3+$count2_3_3+$count2_4_3+$count2_5_3+$count2_6_3+$count2_7_3;
  $a4=$count2_1_4+$count2_2_4+$count2_3_4+$count2_4_4+$count2_5_4+$count2_6_4+$count2_7_4;
  $a5=$count2_1_5+$count2_2_5+$count2_3_5+$count2_4_5+$count2_5_5+$count2_6_5+$count2_7_5;
  

  $m2=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count3_1_1=0;
      $count3_1_2=0;
      $count3_1_3=0;
      $count3_1_4=0;
      $count3_1_5=0;

    
    $sql2 = "SELECT `item_15` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_15']==1)
            $count3_1_1=$count3_1_1+1;
        elseif($row2['item_15']==2)
            $count3_1_2=$count3_1_2+1;
        elseif($row2['item_15']==3)
            $count3_1_3=$count3_1_3+1;
        elseif($row2['item_15']==4)
            $count3_1_4=$count3_1_4+1;
        elseif($row2['item_15']==5)
            $count3_1_5=$count3_1_5+1;
        
    }

      $count3_2_1=0;
      $count3_2_2=0;
      $count3_2_3=0;
      $count3_2_4=0;
      $count3_2_5=0;

    $sql2 = "SELECT `item_16` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_16']==1)
            $count3_2_1=$count3_2_1+1;
        elseif($row2['item_16']==2)
            $count3_2_2=$count3_2_2+1;
        elseif($row2['item_16']==3)
            $count3_2_3=$count3_2_3+1;
        elseif($row2['item_16']==4)
            $count3_2_4=$count3_2_4+1;
        elseif($row2['item_16']==5)
            $count3_2_5=$count3_2_5+1;
        
    }

      $count3_3_1=0;
      $count3_3_2=0;
      $count3_3_3=0;
      $count3_3_4=0;
      $count3_3_5=0;

    $sql2 = "SELECT `item_17` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_17']==1)
            $count3_3_1=$count3_3_1+1;
        elseif($row2['item_17']==2)
            $count3_3_2=$count3_3_2+1;
        elseif($row2['item_17']==3)
            $count3_3_3=$count3_3_3+1;
        elseif($row2['item_17']==4)
            $count3_3_4=$count3_3_4+1;
        elseif($row2['item_17']==5)
            $count3_3_5=$count3_3_5+1;
        
    }

      $count3_4_1=0;
      $count3_4_2=0;
      $count3_4_3=0;
      $count3_4_4=0;
      $count3_4_5=0;

    $sql2 = "SELECT `item_18` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_18']==1)
            $count3_4_1=$count3_4_1+1;
        elseif($row2['item_18']==2)
            $count3_4_2=$count3_4_2+1;
        elseif($row2['item_18']==3)
            $count3_4_3=$count3_4_3+1;
        elseif($row2['item_18']==4)
            $count3_4_4=$count3_4_4+1;
        elseif($row2['item_18']==5)
            $count3_4_5=$count3_4_5+1;
        
    }

      $count3_5_1=0;
      $count3_5_2=0;
      $count3_5_3=0;
      $count3_5_4=0;
      $count3_5_5=0;

    $sql2 = "SELECT `item_19` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_19']==1)
            $count3_5_1=$count3_5_1+1;
        elseif($row2['item_19']==2)
            $count3_5_2=$count3_5_2+1;
        elseif($row2['item_19']==3)
            $count3_5_3=$count3_5_3+1;
        elseif($row2['item_19']==4)
            $count3_5_4=$count3_5_4+1;
        elseif($row2['item_19']==5)
            $count3_5_5=$count3_5_5+1;
        
    }

      $count3_6_1=0;
      $count3_6_2=0;
      $count3_6_3=0;
      $count3_6_4=0;
      $count3_6_5=0;

    $sql2 = "SELECT `item_20` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_20']==1)
            $count3_6_1=$count3_6_1+1;
        elseif($row2['item_20']==2)
            $count3_6_2=$count3_6_2+1;
        elseif($row2['item_20']==3)
            $count3_6_3=$count3_6_3+1;
        elseif($row2['item_20']==4)
            $count3_6_4=$count3_6_4+1;
        elseif($row2['item_20']==5)
            $count3_6_5=$count3_6_5+1;
        
    }
  
  $a1=$count3_1_1+$count3_2_1+$count3_3_1+$count3_4_1+$count3_5_1+$count3_6_1;
  $a2=$count3_1_2+$count3_2_2+$count3_3_2+$count3_4_2+$count3_5_2+$count3_6_2;
  $a3=$count3_1_3+$count3_2_3+$count3_3_3+$count3_4_3+$count3_5_3+$count3_6_3;
  $a4=$count3_1_4+$count3_2_4+$count3_3_4+$count3_4_4+$count3_5_4+$count3_6_4;
  $a5=$count3_1_5+$count3_2_5+$count3_3_5+$count3_4_5+$count3_5_5+$count3_6_5;


  $m3=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count4_1_1=0;
      $count4_1_2=0;
      $count4_1_3=0;
      $count4_1_4=0;
      $count4_1_5=0;

    
    $sql2 = "SELECT `item_21` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_21']==1)
            $count4_1_1=$count4_1_1+1;
        elseif($row2['item_21']==2)
            $count4_1_2=$count4_1_2+1;
        elseif($row2['item_21']==3)
            $count4_1_3=$count4_1_3+1;
        elseif($row2['item_21']==4)
            $count4_1_4=$count4_1_4+1;
        elseif($row2['item_21']==5)
            $count4_1_5=$count4_1_5+1;
        
    }

      $count4_2_1=0;
      $count4_2_2=0;
      $count4_2_3=0;
      $count4_2_4=0;
      $count4_2_5=0;

    $sql2 = "SELECT `item_22` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_22']==1)
            $count4_2_1=$count4_2_1+1;
        elseif($row2['item_22']==2)
            $count4_2_2=$count4_2_2+1;
        elseif($row2['item_22']==3)
            $count4_2_3=$count4_2_3+1;
        elseif($row2['item_22']==4)
            $count4_2_4=$count4_2_4+1;
        elseif($row2['item_22']==5)
            $count4_2_5=$count4_2_5+1;
        
    }

      $count4_3_1=0;
      $count4_3_2=0;
      $count4_3_3=0;
      $count4_3_4=0;
      $count4_3_5=0;

    $sql2 = "SELECT `item_23` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_23']==1)
            $count4_3_1=$count4_3_1+1;
        elseif($row2['item_23']==2)
            $count4_3_2=$count4_3_2+1;
        elseif($row2['item_23']==3)
            $count4_3_3=$count4_3_3+1;
        elseif($row2['item_23']==4)
            $count4_3_4=$count4_3_4+1;
        elseif($row2['item_23']==5)
            $count4_3_5=$count4_3_5+1;
        
    }

      $count4_4_1=0;
      $count4_4_2=0;
      $count4_4_3=0;
      $count4_4_4=0;
      $count4_4_5=0;

    $sql2 = "SELECT `item_24` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_24']==1)
            $count4_4_1=$count4_4_1+1;
        elseif($row2['item_24']==2)
            $count4_4_2=$count4_4_2+1;
        elseif($row2['item_24']==3)
            $count4_4_3=$count4_4_3+1;
        elseif($row2['item_24']==4)
            $count4_4_4=$count4_4_4+1;
        elseif($row2['item_24']==5)
            $count4_4_5=$count4_4_5+1;
        
    }

      $count4_5_1=0;
      $count4_5_2=0;
      $count4_5_3=0;
      $count4_5_4=0;
      $count4_5_5=0;

    $sql2 = "SELECT `item_25` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_25']==1)
            $count4_5_1=$count4_5_1+1;
        elseif($row2['item_25']==2)
            $count4_5_2=$count4_5_2+1;
        elseif($row2['item_25']==3)
            $count4_5_3=$count4_5_3+1;
        elseif($row2['item_25']==4)
            $count4_5_4=$count4_5_4+1;
        elseif($row2['item_25']==5)
            $count4_5_5=$count4_5_5+1;
        
    }

      $count4_6_1=0;
      $count4_6_2=0;
      $count4_6_3=0;
      $count4_6_4=0;
      $count4_6_5=0;

    $sql2 = "SELECT `item_26` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_26']==1)
            $count4_6_1=$count4_6_1+1;
        elseif($row2['item_26']==2)
            $count4_6_2=$count4_6_2+1;
        elseif($row2['item_26']==3)
            $count4_6_3=$count4_6_3+1;
        elseif($row2['item_26']==4)
            $count4_6_4=$count4_6_4+1;
        elseif($row2['item_26']==5)
            $count4_6_5=$count4_6_5+1;
        
    }
      
      $count4_7_1=0;
      $count4_7_2=0;
      $count4_7_3=0;
      $count4_7_4=0;
      $count4_7_5=0;

    $sql2 = "SELECT `item_27` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_27']==1)
            $count4_7_1=$count4_7_1+1;
        elseif($row2['item_27']==2)
            $count4_7_2=$count4_7_2+1;
        elseif($row2['item_27']==3)
            $count4_7_3=$count4_7_3+1;
        elseif($row2['item_27']==4)
            $count4_7_4=$count4_7_4+1;
        elseif($row2['item_27']==5)
            $count4_7_5=$count4_7_5+1;
        
    }
  
  $a1=$count4_1_1+$count4_2_1+$count4_3_1+$count4_4_1+$count4_5_1+$count4_6_1+$count4_7_1;
  $a2=$count4_1_2+$count4_2_2+$count4_3_2+$count4_4_2+$count4_5_2+$count4_6_2+$count4_7_2;
  $a3=$count4_1_3+$count4_2_3+$count4_3_3+$count4_4_3+$count4_5_3+$count4_6_3+$count4_7_3;
  $a4=$count4_1_4+$count4_2_4+$count4_3_4+$count4_4_4+$count4_5_4+$count4_6_4+$count4_7_4;
  $a5=$count4_1_5+$count4_2_5+$count4_3_5+$count4_4_5+$count4_5_5+$count4_6_5+$count4_7_5;

  $m4=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count5_1_1=0;
      $count5_1_2=0;
      $count5_1_3=0;
      $count5_1_4=0;
      $count5_1_5=0;

    
    $sql2 = "SELECT `item_28` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_28']==1)
            $count5_1_1=$count5_1_1+1;
        elseif($row2['item_28']==2)
            $count5_1_2=$count5_1_2+1;
        elseif($row2['item_28']==3)
            $count5_1_3=$count5_1_3+1;
        elseif($row2['item_28']==4)
            $count5_1_4=$count5_1_4+1;
        elseif($row2['item_28']==5)
            $count5_1_5=$count5_1_5+1;
        
    }

      $count5_2_1=0;
      $count5_2_2=0;
      $count5_2_3=0;
      $count5_2_4=0;
      $count5_2_5=0;

    $sql2 = "SELECT `item_29` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_29']==1)
            $count5_2_1=$count5_2_1+1;
        elseif($row2['item_29']==2)
            $count5_2_2=$count5_2_2+1;
        elseif($row2['item_29']==3)
            $count5_2_3=$count5_2_3+1;
        elseif($row2['item_29']==4)
            $count5_2_4=$count5_2_4+1;
        elseif($row2['item_29']==5)
            $count5_2_5=$count5_2_5+1;
        
    }

      $count5_3_1=0;
      $count5_3_2=0;
      $count5_3_3=0;
      $count5_3_4=0;
      $count5_3_5=0;

    $sql2 = "SELECT `item_30` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_30']==1)
            $count5_3_1=$count5_3_1+1;
        elseif($row2['item_30']==2)
            $count5_3_2=$count5_3_2+1;
        elseif($row2['item_30']==3)
            $count5_3_3=$count5_3_3+1;
        elseif($row2['item_30']==4)
            $count5_3_4=$count5_3_4+1;
        elseif($row2['item_30']==5)
            $count5_3_5=$count5_3_5+1;
        
    }

      $count5_4_1=0;
      $count5_4_2=0;
      $count5_4_3=0;
      $count5_4_4=0;
      $count5_4_5=0;

    $sql2 = "SELECT `item_31` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_31']==1)
            $count5_4_1=$count5_4_1+1;
        elseif($row2['item_31']==2)
            $count5_4_2=$count5_4_2+1;
        elseif($row2['item_31']==3)
            $count5_4_3=$count5_4_3+1;
        elseif($row2['item_31']==4)
            $count5_4_4=$count5_4_4+1;
        elseif($row2['item_31']==5)
            $count5_4_5=$count5_4_5+1;
        
    }

      $count5_5_1=0;
      $count5_5_2=0;
      $count5_5_3=0;
      $count5_5_4=0;
      $count5_5_5=0;

    $sql2 = "SELECT `item_32` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_32']==1)
            $count5_5_1=$count5_5_1+1;
        elseif($row2['item_32']==2)
            $count5_5_2=$count5_5_2+1;
        elseif($row2['item_32']==3)
            $count5_5_3=$count5_5_3+1;
        elseif($row2['item_32']==4)
            $count5_5_4=$count5_5_4+1;
        elseif($row2['item_32']==5)
            $count5_5_5=$count5_5_5+1;
        
    }

      $count5_6_1=0;
      $count5_6_2=0;
      $count5_6_3=0;
      $count5_6_4=0;
      $count5_6_5=0;

    $sql2 = "SELECT `item_33` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_33']==1)
            $count5_6_1=$count5_6_1+1;
        elseif($row2['item_33']==2)
            $count5_6_2=$count5_6_2+1;
        elseif($row2['item_33']==3)
            $count5_6_3=$count5_6_3+1;
        elseif($row2['item_33']==4)
            $count5_6_4=$count5_6_4+1;
        elseif($row2['item_33']==5)
            $count5_6_5=$count5_6_5+1;
        
    }
  
  $a1=$count5_1_1+$count5_2_1+$count5_3_1+$count5_4_1+$count5_5_1+$count5_6_1;
  $a2=$count5_1_2+$count5_2_2+$count5_3_2+$count5_4_2+$count5_5_2+$count5_6_2;
  $a3=$count5_1_3+$count5_2_3+$count5_3_3+$count5_4_3+$count5_5_3+$count5_6_3;
  $a4=$count5_1_4+$count5_2_4+$count5_3_4+$count5_4_4+$count5_5_4+$count5_6_4;
  $a5=$count5_1_5+$count5_2_5+$count5_3_5+$count5_4_5+$count5_5_5+$count5_6_5;
  
 

  $m5=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count6_1_1=0;
      $count6_1_2=0;
      $count6_1_3=0;
      $count6_1_4=0;
      $count6_1_5=0;

    
    $sql2 = "SELECT `item_34` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_34']==1)
            $count6_1_1=$count6_1_1+1;
        elseif($row2['item_34']==2)
            $count6_1_2=$count6_1_2+1;
        elseif($row2['item_34']==3)
            $count6_1_3=$count6_1_3+1;
        elseif($row2['item_34']==4)
            $count6_1_4=$count6_1_4+1;
        elseif($row2['item_34']==5)
            $count6_1_5=$count6_1_5+1;
        
    }

      $count6_2_1=0;
      $count6_2_2=0;
      $count6_2_3=0;
      $count6_2_4=0;
      $count6_2_5=0;

    $sql2 = "SELECT `item_35` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_35']==1)
            $count6_2_1=$count6_2_1+1;
        elseif($row2['item_35']==2)
            $count6_2_2=$count6_2_2+1;
        elseif($row2['item_35']==3)
            $count6_2_3=$count6_2_3+1;
        elseif($row2['item_35']==4)
            $count6_2_4=$count6_2_4+1;
        elseif($row2['item_35']==5)
            $count6_2_5=$count6_2_5+1;
        
    }

      $count6_3_1=0;
      $count6_3_2=0;
      $count6_3_3=0;
      $count6_3_4=0;
      $count6_3_5=0;

    $sql2 = "SELECT `item_36` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_36']==1)
            $count6_3_1=$count6_3_1+1;
        elseif($row2['item_36']==2)
            $count6_3_2=$count6_3_2+1;
        elseif($row2['item_36']==3)
            $count6_3_3=$count6_3_3+1;
        elseif($row2['item_36']==4)
            $count6_3_4=$count6_3_4+1;
        elseif($row2['item_36']==5)
            $count6_3_5=$count6_3_5+1;
        
    }

      $count6_4_1=0;
      $count6_4_2=0;
      $count6_4_3=0;
      $count6_4_4=0;
      $count6_4_5=0;

    $sql2 = "SELECT `item_37` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_37']==1)
            $count6_4_1=$count6_4_1+1;
        elseif($row2['item_37']==2)
            $count6_4_2=$count6_4_2+1;
        elseif($row2['item_37']==3)
            $count6_4_3=$count6_4_3+1;
        elseif($row2['item_37']==4)
            $count6_4_4=$count6_4_4+1;
        elseif($row2['item_37']==5)
            $count6_4_5=$count6_4_5+1;
        
    }

      $count6_5_1=0;
      $count6_5_2=0;
      $count6_5_3=0;
      $count6_5_4=0;
      $count6_5_5=0;

    $sql2 = "SELECT `item_38` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_38']==1)
            $count6_5_1=$count6_5_1+1;
        elseif($row2['item_38']==2)
            $count6_5_2=$count6_5_2+1;
        elseif($row2['item_38']==3)
            $count6_5_3=$count6_5_3+1;
        elseif($row2['item_38']==4)
            $count6_5_4=$count6_5_4+1;
        elseif($row2['item_38']==5)
            $count6_5_5=$count6_5_5+1;
        
    }

      $count6_6_1=0;
      $count6_6_2=0;
      $count6_6_3=0;
      $count6_6_4=0;
      $count6_6_5=0;

    $sql2 = "SELECT `item_39` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_39']==1)
            $count6_6_1=$count6_6_1+1;
        elseif($row2['item_39']==2)
            $count6_6_2=$count6_6_2+1;
        elseif($row2['item_39']==3)
            $count6_6_3=$count6_6_3+1;
        elseif($row2['item_39']==4)
            $count6_6_4=$count6_6_4+1;
        elseif($row2['item_39']==5)
            $count6_6_5=$count6_6_5+1;
        
    }
  
  $a1=$count6_1_1+$count6_2_1+$count6_3_1+$count6_4_1+$count6_5_1+$count6_6_1;
  $a2=$count6_1_2+$count6_2_2+$count6_3_2+$count6_4_2+$count6_5_2+$count6_6_2;
  $a3=$count6_1_3+$count6_2_3+$count6_3_3+$count6_4_3+$count6_5_3+$count6_6_3;
  $a4=$count6_1_4+$count6_2_4+$count6_3_4+$count6_4_4+$count6_5_4+$count6_6_4;
  $a5=$count6_1_5+$count6_2_5+$count6_3_5+$count6_4_5+$count6_5_5+$count6_6_5;
  


  $m6=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count7_1_1=0;
      $count7_1_2=0;
      $count7_1_3=0;
      $count7_1_4=0;
      $count7_1_5=0;

    
    $sql2 = "SELECT `item_40` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_40']==1)
            $count7_1_1=$count7_1_1+1;
        elseif($row2['item_40']==2)
            $count7_1_2=$count7_1_2+1;
        elseif($row2['item_40']==3)
            $count7_1_3=$count7_1_3+1;
        elseif($row2['item_40']==4)
            $count7_1_4=$count7_1_4+1;
        elseif($row2['item_40']==5)
            $count7_1_5=$count7_1_5+1;
        
    }

      $count7_2_1=0;
      $count7_2_2=0;
      $count7_2_3=0;
      $count7_2_4=0;
      $count7_2_5=0;

    $sql2 = "SELECT `item_41` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_41']==1)
            $count7_2_1=$count7_2_1+1;
        elseif($row2['item_41']==2)
            $count7_2_2=$count7_2_2+1;
        elseif($row2['item_41']==3)
            $count7_2_3=$count7_2_3+1;
        elseif($row2['item_41']==4)
            $count7_2_4=$count7_2_4+1;
        elseif($row2['item_41']==5)
            $count7_2_5=$count7_2_5+1;
        
    }

      $count7_3_1=0;
      $count7_3_2=0;
      $count7_3_3=0;
      $count7_3_4=0;
      $count7_3_5=0;

    $sql2 = "SELECT `item_42` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_48']==1)
            $count7_3_1=$count7_3_1+1;
        elseif($row2['item_48']==2)
            $count7_3_2=$count7_3_2+1;
        elseif($row2['item_48']==3)
            $count7_3_3=$count7_3_3+1;
        elseif($row2['item_48']==4)
            $count7_3_4=$count7_3_4+1;
        elseif($row2['item_48']==5)
            $count7_3_5=$count7_3_5+1;
        
    }

      $count7_4_1=0;
      $count7_4_2=0;
      $count7_4_3=0;
      $count7_4_4=0;
      $count7_4_5=0;

    $sql2 = "SELECT `item_43` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_43']==1)
            $count7_4_1=$count7_4_1+1;
        elseif($row2['item_43']==2)
            $count7_4_2=$count7_4_2+1;
        elseif($row2['item_43']==3)
            $count7_4_3=$count7_4_3+1;
        elseif($row2['item_43']==4)
            $count7_4_4=$count7_4_4+1;
        elseif($row2['item_43']==5)
            $count7_4_5=$count7_4_5+1;
        
    }

      $count7_5_1=0;
      $count7_5_2=0;
      $count7_5_3=0;
      $count7_5_4=0;
      $count7_5_5=0;

    $sql2 = "SELECT `item_44` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_44']==1)
            $count7_5_1=$count7_5_1+1;
        elseif($row2['item_44']==2)
            $count7_5_2=$count7_5_2+1;
        elseif($row2['item_44']==3)
            $count7_5_3=$count7_5_3+1;
        elseif($row2['item_44']==4)
            $count7_5_4=$count7_5_4+1;
        elseif($row2['item_44']==5)
            $count7_5_5=$count7_5_5+1;
        
    }

      $count7_6_1=0;
      $count7_6_2=0;
      $count7_6_3=0;
      $count7_6_4=0;
      $count7_6_5=0;

    $sql2 = "SELECT `item_45` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_45']==1)
            $count7_6_1=$count7_6_1+1;
        elseif($row2['item_45']==2)
            $count7_6_2=$count7_6_2+1;
        elseif($row2['item_45']==3)
            $count7_6_3=$count7_6_3+1;
        elseif($row2['item_45']==4)
            $count7_6_4=$count7_6_4+1;
        elseif($row2['item_45']==5)
            $count7_6_5=$count7_6_5+1;
        
    }
      
      $count7_7_1=0;
      $count7_7_2=0;
      $count7_7_3=0;
      $count7_7_4=0;
      $count7_7_5=0;

    $sql2 = "SELECT `item_46` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_46']==1)
            $count7_7_1=$count7_7_1+1;
        elseif($row2['item_46']==2)
            $count7_7_2=$count7_7_2+1;
        elseif($row2['item_46']==3)
            $count7_7_3=$count7_7_3+1;
        elseif($row2['item_46']==4)
            $count7_7_4=$count7_7_4+1;
        elseif($row2['item_46']==5)
            $count7_7_5=$count7_7_5+1;
        
    }
  
  $a1=$count7_1_1+$count7_2_1+$count7_3_1+$count7_4_1+$count7_5_1+$count7_6_1+$count7_7_1;
  $a2=$count7_1_2+$count7_2_2+$count7_3_2+$count7_4_2+$count7_5_2+$count7_6_2+$count7_7_2;
  $a3=$count7_1_3+$count7_2_3+$count7_3_3+$count7_4_3+$count7_5_3+$count7_6_3+$count7_7_3;
  $a4=$count7_1_4+$count7_2_4+$count7_3_4+$count7_4_4+$count7_5_4+$count7_6_4+$count7_7_4;
  $a5=$count7_1_5+$count7_2_5+$count7_3_5+$count7_4_5+$count7_5_5+$count7_6_5+$count7_7_5;
  


  $m7=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
  $count8_1_1=0;
      $count8_1_2=0;
      $count8_1_3=0;
      $count8_1_4=0;
      $count8_1_5=0;

    
    $sql2 = "SELECT `item_47` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_47']==1)
            $count8_1_1=$count8_1_1+1;
        elseif($row2['item_47']==2)
            $count8_1_2=$count8_1_2+1;
        elseif($row2['item_47']==3)
            $count8_1_3=$count8_1_3+1;
        elseif($row2['item_47']==4)
            $count8_1_4=$count8_1_4+1;
        elseif($row2['item_47']==5)
            $count8_1_5=$count8_1_5+1;
        
    }

      $count8_2_1=0;
      $count8_2_2=0;
      $count8_2_3=0;
      $count8_2_4=0;
      $count8_2_5=0;

    $sql2 = "SELECT `item_48` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_48']==1)
            $count8_2_1=$count8_2_1+1;
        elseif($row2['item_48']==2)
            $count8_2_2=$count8_2_2+1;
        elseif($row2['item_48']==3)
            $count8_2_3=$count8_2_3+1;
        elseif($row2['item_48']==4)
            $count8_2_4=$count8_2_4+1;
        elseif($row2['item_48']==5)
            $count8_2_5=$count8_2_5+1;
        
    }

      $count8_3_1=0;
      $count8_3_2=0;
      $count8_3_3=0;
      $count8_3_4=0;
      $count8_3_5=0;

    $sql2 = "SELECT `item_49` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_49']==1)
            $count8_3_1=$count8_3_1+1;
        elseif($row2['item_49']==2)
            $count8_3_2=$count8_3_2+1;
        elseif($row2['item_49']==3)
            $count8_3_3=$count8_3_3+1;
        elseif($row2['item_49']==4)
            $count8_3_4=$count8_3_4+1;
        elseif($row2['item_49']==5)
            $count8_3_5=$count8_3_5+1;
        
    }

      $count8_4_1=0;
      $count8_4_2=0;
      $count8_4_3=0;
      $count8_4_4=0;
      $count8_4_5=0;

    $sql2 = "SELECT `item_50` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_50']==1)
            $count8_4_1=$count8_4_1+1;
        elseif($row2['item_50']==2)
            $count8_4_2=$count8_4_2+1;
        elseif($row2['item_50']==3)
            $count8_4_3=$count8_4_3+1;
        elseif($row2['item_50']==4)
            $count8_4_4=$count8_4_4+1;
        elseif($row2['item_50']==5)
            $count8_4_5=$count8_4_5+1;
        
    }

      $count8_5_1=0;
      $count8_5_2=0;
      $count8_5_3=0;
      $count8_5_4=0;
      $count8_5_5=0;

    $sql2 = "SELECT `item_51` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_51']==1)
            $count8_5_1=$count8_5_1+1;
        elseif($row2['item_51']==2)
            $count8_5_2=$count8_5_2+1;
        elseif($row2['item_51']==3)
            $count8_5_3=$count8_5_3+1;
        elseif($row2['item_51']==4)
            $count8_5_4=$count8_5_4+1;
        elseif($row2['item_51']==5)
            $count8_5_5=$count8_5_5+1;
        
    }

      $count8_6_1=0;
      $count8_6_2=0;
      $count8_6_3=0;
      $count8_6_4=0;
      $count8_6_5=0;

    $sql2 = "SELECT `item_52` FROM `survey_result` WHERE `Survey_ID`='$Survey_ID' AND `Teacher` IS NULL;";
    $result2 = mysqli_query($con,$sql2);
    for($i=1; $i<=mysqli_num_rows($result2); $i++){
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['item_52']==1)
            $count8_6_1=$count8_6_1+1;
        elseif($row2['item_52']==2)
            $count8_6_2=$count8_6_2+1;
        elseif($row2['item_52']==3)
            $count8_6_3=$count8_6_3+1;
        elseif($row2['item_52']==4)
            $count8_6_4=$count8_6_4+1;
        elseif($row2['item_52']==5)
            $count8_6_5=$count8_6_5+1;
        
    }
  
  $a1=$count8_1_1+$count8_2_1+$count8_3_1+$count8_4_1+$count8_5_1+$count8_6_1;
  $a2=$count8_1_2+$count8_2_2+$count8_3_2+$count8_4_2+$count8_5_2+$count8_6_2;
  $a3=$count8_1_3+$count8_2_3+$count8_3_3+$count8_4_3+$count8_5_3+$count8_6_3;
  $a4=$count8_1_4+$count8_2_4+$count8_3_4+$count8_4_4+$count8_5_4+$count8_6_4;
  $a5=$count8_1_5+$count8_2_5+$count8_3_5+$count8_4_5+$count8_5_5+$count8_6_5;
  

  $m8=($a1*1+$a2*2+$a3*3+$a4*4+$a5*5)/$num;
    }
    
?>