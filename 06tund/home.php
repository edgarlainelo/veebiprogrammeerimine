<?php
  
   $bgColor = null;
   $photoDir = "../photos/";
   $photoTypesAllowed = ["image/jpeg", "image/png"];
   $timeDayNow = date("d.m.Y H:i:s");
   $timeNow = date ("H");
   $timeWords = "Pole aega";
  
  require("userprofile.php");
  require("header.php");
  require("functions_main.php");
  require("../../../config_vp2019.php");
  require("functions_user.php");
  $database = "if19_edgar_la_2";
  
  
  //Aeg
  
  if($timeNow >4 and $timeNow < 12){
	  $timeWords = "Tere hommikust";
  }
  if($timeNow >12 and $timeNow <18){
	  $timeWords = "Tere päevast";
  }
  if($timeNow >18 and $timeNow <23){
	  $timeWords = "Tere õhtust";
  }
  if($timeNow >= 0 and $timeNow <5){
	  $timeWords = "Head ööd";
  }
  
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: myindex.php");
	  exit();
  }

  //väljalogimine
  if(isset($_GET["logout"])){
	  //sessioon kinni
	  session_unset();
	  session_destroy();
	  header("Location: myindex.php");
	  exit();
  }

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  

 
 
 
 

    echo "<h1>" .$userName .", veebiprogrameerimine 2019</h1>";
	

	

	$semesterStart = new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDuration = $semesterStart -> diff($semesterEnd);
	$today = new DateTime("now");
	$fromSemesterStart = $semesterStart -> diff($today);
	$semesterInfoHTML = "<p>Info semestri kohta pole kättesaadav.</p>";
	if ($fromSemesterStart -> format("%r%a") > 0 and $fromSemesterStart -> format("%r%a") <= $semesterDuration -> format("%r%a")){
		$semesterInfoHTML = "<p>Semester on täies hoos: ";
		$semesterInfoHTML .= '<meter min="0" ';
		$semesterInfoHTML .= 'max="' .$semesterDuration -> format("%r%a") .'" ';
		$semesterInfoHTML .= 'value="' .$fromSemesterStart -> format("%r%a") .'">';
		$semesterInfoHTML .= round($fromSemesterStart -> format("%r%a") / $semesterDuration -> format("%r%a") * 100, 1) ."%";
		$semesterInfoHTML .= "</meter></p>";
	}
	


	$photoList = [];
	
	$allFiles = array_slice(scandir($photoDir), 2);
	
	foreach ($allFiles as $file){
		$fileInfo = getimagesize($photoDir .$file);
		
		if (in_array($fileInfo["mime"], $photoTypesAllowed) == true){
			array_push($photoList, $file);
		}
	}
	
	
	$photoCount = count($photoList);
	$randomImgHTML = "";
	if ($photoCount > 0){
	  $photoNum = mt_rand(0, $photoCount - 1);
	  $randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
	} else {
		$randomImgHTML = "<p>Kahjuks pilte pole!</p>";
	}

?>  
  <p> See veebileht on õppimiseks </p>
<?php
  echo $semesterInfoHTML;
  echo "<p> Lehe avamise hetkel oli " .$timeDayNow .", " .$timeWords ."!</p>";
?>
<hr>
  
<a href="profiilmuutmine.php"><input type="button" name="profiilmuutus" value="Nupp profiili muutmiseks"></input></a>


  <p> Olete sisseloginud!  <a href="myindex.php">Logi välja!</a></p>
<?php
  echo $randomImgHTML;
?>  
  

</body>
</html>