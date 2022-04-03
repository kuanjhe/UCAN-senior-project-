<?php
$sql = "SELECT `Course_ID` FROM `course_list` WHERE `Teacher_CName`='".$_SESSION['Teacher_CName']."' and `Year` = '".$_SESSION['Year']."' and `Course_CName` = '".$_SESSION['Course_CName']."' and `Hide`='0'";
$result = mysqli_query($con,$sql);
$a = mysqli_fetch_array($result);
$Course_ID = $a[0];
echo "<br>";
$sql="SELECT * FROM `survey_result` WHERE `Course_ID`='$Course_ID' AND `Teacher`='1' AND `Hide`='0'";
$result = mysqli_query($con,$sql);
while ($list = mysqli_fetch_array($result)) {
  for ($i=13; $i <=19 ; $i++) { 
    $occupation_ability_1=$list[$i];
  }
  for ($i=20; $i <=26 ; $i++) { 
    $occupation_ability_2=$list[$i];
  }
  for ($i=27; $i <=32 ; $i++) { 
    $occupation_ability_3=$list[$i];
  }
  for ($i=33; $i <=39 ; $i++) { 
    $occupation_ability_4=$list[$i];
  }
  for ($i=40; $i <=45 ; $i++) { 
    $occupation_ability_5=$list[$i];
  }
  for ($i=46; $i <=51 ; $i++) { 
    $occupation_ability_6=$list[$i];
  }
  for ($i=52; $i <=58 ; $i++) { 
    $occupation_ability_7=$list[$i];
  }
  for ($i=59; $i <=64 ; $i++) { 
    $occupation_ability_8=$list[$i];
  }
}
echo $occupation_ability_1;
?>

<!--畫圓餅圖-->
<script type="text/javascript">
  
  window.onload=function(){

  var dataset=[{"count":530,"name":"你好"},{"count":426,"name":"\u9999\u6e2f"},{"count":782,"name":"\u53f0\u7063\u570b\u4e2d"},{"count":203,"name":"\u99ac\u4f86\u897f\u4e9e"},{"count":18,"name":"\u6c76\u840a"},{"count":63,"name":"\u65b0\u52a0\u5761"},{"count":43,"name":"\u6fb3\u9580"},{"count":21,"name":"\u5370\u5c3c"}]

  //Width and height
  var w = 600;
  var h = 400;
  var r = Math.min(w, h) / 3;
  var labelr = r+20;

  var outerRadius = h / 3;
  var innerRadius = 0;
  var arc = d3.svg.arc()
          .innerRadius(innerRadius)
          .outerRadius(outerRadius);
  
  var pie = d3.layout.pie().value(function(d) { return d.count; }).sort( function(d) { return null; } );;
  
  //Easy colors accessible via a 10-step ordinal scale
  var color = d3.scale.category10();

  //Create SVG element
  var svg = d3.select("#piechart")
        .append("svg")
        .attr("width", w)
        .attr("height", h);
  
  svg.append("g")
      .attr("class", "labels");
  //Set up groups
  var arcs = svg.selectAll("g.arc")
          .data(pie(dataset))
          .enter()
          .append("g")
          .attr("class", "arc")
          .attr("transform", "translate(" + w/3 + "," + h/2 + ")");
  
  //Draw arc paths
  arcs.append("path")
      .attr("fill", function(d, i) {
        return color(i);
      })
      .attr("d", arc);

      arcs.append("text")
      .attr("x", 240)
      .attr("y", function(d, i){
        return i*24-100;
      })
      .attr("fill", function(d, i) {
        return color(i);
      })
      .text(function(d, i) {
        return d.data.name+": "+d.data.count;
      });
  //Labels
  arcs.append("text")
      .attr("transform", function(d) {
      var c = arc.centroid(d),
          x = c[0],
          y = c[1],
          // pythagorean theorem for hypotenuse
          h = Math.sqrt(x*x + y*y);
      return "translate(" + (x/h * labelr) +  ',' +
         (y/h * labelr) +  ")"; 
      })
      .attr("class", "pie_text")
      .attr("text-anchor", "middle")
      .text(function(d, i) {
        return d.data.name;
      });
}
</script>