<?php
  $minuNimi = "Edgar Lainelo";
  $weekDaysET = ["Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede"];
  $monthsET = ["Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni", "Juuli", "August", "September", "Oktoober", "November", "Detsember"];
  //var_dump($monthsET)
  $currentdate = date('w');
  $currentmonth = date ('m');
  $fullTimeNow = date ("d.m.Y H:i:s");
  

  $pageHeaderHTML = "<!DOCTYPE html> \n";
  $pageHeaderHTML .= '<html lang="et">'. "\n";
  $pageHeaderHTML .= "<head> \n";
  $pageHeaderHTML .= "\t" .'<meta charset="utf-8">' ."\n \t<title>" .$minuNimi ." progeb veebi</title> \n";
  $pageHeaderHTML .= "\t" ."<style> \n";
  $pageHeaderHTML .= "\t \t body{background-color: " .$_SESSION["bgColor"] ."; \n";
  $pageHeaderHTML .= "\t \t color: " .$_SESSION["txtColor"] ."\n";
  $pageHeaderHTML .= "\t }";
  $pageHeaderHTML .= "</style> \n";
  if(isset($toScript)){
	  $pageHeaderHTML .= $toScript;
  }
  $pageHeaderHTML .= "</head> \n";
  echo $pageHeaderHTML;
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
  
 
  
?> 
</body>
</html>