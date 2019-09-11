<?php
  $username = "Edgar Lainelo";
  $fullTimeNow = date ("d.m.Y H:i:s");
  $hourNow = date ("H");
  $partOfDay = "hägune aeg";
  
  if($hourNow < 8){
	 $partOfDay = "Hommik"; 
  }
?>
<!DOCTYPE html>
<html lang="et">

<head>
  <meta charset="utf-8">
  <title>
  <?php
  echo $username;
  ?>
  programeerib veebi </title>
</head>
<body>
  <?php
    echo "<h1>" .$username .", veebiprogrameerimine2019</h1>";
  ?>
  
 <?php
   echo "<p>Seeon minu esimene PHP</p>";
   echo "<p>Lehe avamise hetkel oli " .$fullTimeNow .", " .$partOfDay .".</p>";
 ?>


</body>
</html>