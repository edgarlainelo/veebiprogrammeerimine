<?php
  
 
  
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  require("functions_message.php");
  $database = "if19_edgar_la_2";
  
  
  $userName = $_SESSION["userFirstname"] ." ".$_SESSION["userLastname"];
   $notice = null;
  $passwordError = null;
  $confirmpasswordError = null;
  $notice2 = null;

   $passwordFromDb2 = $_SESSION["userPassword"];
  
 


  
  
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: myindex.php");
	  exit();
  }
  
  if(isset($_POST["submitNewPassword"])){
	  
	  

  
  
    if ((!isset($_POST["oldPassword"]) or empty($_POST["oldPassword"]))){
	  $confirmpasswordError = "Palun sisestage vana salasõna!"; 
	} else {
		if(password_verify($_POST["oldPassword"], $passwordFromDb2)){
			$notice2 = null;
		} else {
			$notice2 = "Parool ei ole õige!";
		}
	}
  
	
	
	
    if (!isset($_POST["password"]) or empty($_POST["password"])){
	  $passwordError = "Palun sisesta uus salasõna! ";
	} else {
	  if(strlen($_POST["password"]) < 8){
	    $passwordError = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["password"]) ." märki). ";
	  }
	}
	
	if($_POST["password"] != $_POST["password2"]){
		$notice = "Paroolid ei ole samad!";
	} else {
		$notice = null;
	}
	
	
	if(empty($passwordError) and empty($notice) and empty($confirmPasswordError) and empty($notice2)){
		$notice = newPassword($_POST["password"]);
	} else {
		$notice = "Ei saa salvestada, andmed on puudulikud!";
	}
  }
  require ("header.php");
  
  
  

 
?>
 <?php
    echo "<h1>" .$userName ." programeerib veebi!</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  

  <form method="POST">
    <label>Vana parool:</label><br>
	<input type="password" name="oldPassword" placeholder="Kirjuta vana parool"><span><?php echo $notice2 ?></span></input><br>
	<label>Korrake vana parool:</label><br>
	<input type="password" name="password" placeholder="Kirjutage uus parool"><span> <?php echo $confirmpasswordError ?></span></input><br>
    <label>Uus parool:</label><br>
    <input type="password" name="password2" placeholder="Korrage uut parooli"><span><?php  echo $passwordError; echo $notice ?></span></input><br>
	<button type="submit" name="submitNewPassword" value="submit">Submit</button>
  </form>