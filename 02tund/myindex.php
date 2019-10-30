<?php
  $userName = "Edgar Lainelo";
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  
  if($hourNow > 8 AND $hourNow < 12){
	 $partOfDay = "Hommik"; 
  }
  if($hourNow >= 12 AND 	$hourNow <= 17){
	 $partOfDay = "Tere Päevast";
  }
  if($hourNow >17 AND $hourNow <=22){
	  $partOfDay = "Head õhtut";
  }
  if($hourNow >22 AND $hourNow <4){
	  $partOfDay = "Head ööd";
  }
  if($hourNow > 4 AND $hourNow < 8){
	  $partOfDay = "Vaja ärkada";
  }
?> 
  <!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
    echo $userName;
  ?>
   programmeerib veebi</title>
</head>
<body>
  <?php
    echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
  ?>
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
<?php
  echo "<p>See on minu esimene PHP!</p>";
  echo "<p>Lehe avamise hetkel oli " .$fullTimeNow .", " .$partOfDay .".</p>";
?>


</body>
</html>