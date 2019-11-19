<?php
  require("functions_main.php");
  require("/../../../config_vp2019.php");
  require("functions_user.php");
  $database = "if19_edgar_la_2";
  
  $notice = null;
  $name = null;
  $surname = null;
  $email = null;
  $gender = null;
  $birthMonth = null;
  $birthYear = null;
  $birthDay = null;
  $birthDate = null;
  $monthNamesET = ["jaanuar", "veebruar", "m�rts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
  
  //muutujad v�imalike veateadetega
  $nameError = null;
  $surnameError = null;
  $birthMonthError = null;
  $birthYearError = null;
  $birthDayError = null;
  $birthDateError = null;
  $genderError = null;
  $emailError = null;
  $passwordError = null;
  $confirmpasswordError = null;
  
  //kui on uue kasutaja loomise nuppu vajutatud
  if(isset($_POST["submitUserData"])){
	//eesnimi
	if(isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		$name = test_input($_POST["firstName"]);
	} else {
		$nameError = "Palun sisesta oma eesnimi!";
	}
	
	//perekonnanimi
	if (isset($_POST["surName"]) and !empty($_POST["surName"])){
		$surname = test_input($_POST["surName"]);
	} else {
		$surnameError = "Palun sisesta perekonnanimi!";
	}
	
	//sugu
	if(isset($_POST["gender"])){
	    $gender = intval($_POST["gender"]);
	} else {
		$genderError = "Palun m�rgi sugu!";
	}
		
	//kuup�eva osa
	  if(isset($_POST["birthDay"]) and !empty($_POST["birthDay"])){
	  $birthDay = intval($_POST["birthDay"]);
	  } else {
		  $birthDayError = "Palun vali s�nnikuup�ev!";
	  }
	  
	  if(isset($_POST["birthMonth"]) and !empty($_POST["birthMonth"])){
		  $birthMonth = intval($_POST["birthMonth"]);
	  } else {
		  $birthMonthError = "Palun vali s�nnikuu!";
	  }
	  
	  if(isset($_POST["birthYear"]) and !empty($_POST["birthYear"])){
		  $birthYear = intval($_POST["birthYear"]);
	  } else {
		  $birthYearError = "Palun vali s�nniaasta!";
	  }
	  
	  //kontrollin, kas valitud kuup�ev on valiidne ehk reaalselt olemas ja moodustan kuup�eva objekti
	  if(!empty($birthDay) and !empty($birthMonth) and !empty($birthYear)){
		if(checkdate($birthMonth, $birthDay, $birthYear)){
		  $tempDate = new DateTime($birthYear ."-" .$birthMonth ."-" .$birthDay);
		  $birthDate = $tempDate->format("Y-m-d");
		} else {
			$birthDateError = "Kahjuks pole valitud kuup�ev korrektne, olemas!";
		}
	  }
	
	//email ehk kasutajatunnus
	if (isset($_POST["email"]) and !empty($_POST["email"])){
	  $email = test_input($_POST["email"]);
	} else {
	  $emailError = "Palun sisesta e-postiaadress!";
	}
	  
	  //parool ja selle kaks korda sisestamine
	if (!isset($_POST["password"]) or empty($_POST["password"])){
	  $passwordError = "Palun sisesta salas�na!";
	} else {
	  if(strlen($_POST["password"]) < 8){
	    $passwordError = "Liiga l�hike salas�na (sisestasite ainult " .strlen($_POST["password"]) ." m�rki).";
	  }
	}
	  
	if (!isset($_POST["confirmpassword"]) or empty($_POST["confirmpassword"])){
	  $confirmpasswordError = "Palun sisestage salas�na kaks korda!";  
	} else {
	  if($_POST["confirmpassword"] != $_POST["password"]){
	    $confirmpasswordError = "Sisestatud salas�nad ei olnud �hesugused!";
	  }
	}
	
	//kui k�ik on olemas, korras, siis salvestame kasutaja
	if(empty($nameError) and empty($surnameError) and empty($birthMonthError) and empty($birthYearError) and empty($birthDayError) and empty($birthDateError) and empty($genderError) and empty($emailError) and empty($passwordError) and empty($confirmpasswordError)){
		$notice = signUp($name, $surname, $email, $gender, $birthDate, $_POST["password"]);
	} else {
		$notice = "Ei saa salvestada, andmed on puudulikud!";
	}
	
  }//kui on nuppu vajutatud
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>Katselise veebi uue kasutaja loomine</title>
  </head>
  <body>
    <h1>Loo endale kasutajakonto</h1>
	<p>See leht on valminud TL� �ppet�� raames ja ei oma mingisugust, m�testatud v�i muul moel v��rtuslikku sisu.</p>
	<hr>
	<p>Tagasi <a href="home.php">avalehele</a></p>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Eesnimi:</label><br>
	  <input name="firstName" type="text" value="<?php echo $name; ?>"><span><?php echo $nameError; ?></span><br>
      <label>Perekonnanimi:</label><br>
	  <input name="surName" type="text" value="<?php echo $surname; ?>"><span><?php echo $surnameError; ?></span>
	  <br>
	  
	  <label><input type="radio" name="gender" value="2" <?php if($gender == "2"){		echo " checked";} ?>>Naine</label>
	  <label><input type="radio" name="gender" value="1" <?php if($gender == "1"){		echo " checked";} ?>>Mees</label><br>
	  <span><?php echo $genderError; ?></span><br>
	    
	  <br>
	  <label>S�nnip�ev: </label>
	  <?php
	    echo '<select name="birthDay">' ."\n";
		echo "\t\t" .'<option value="" selected disabled>p�ev</option>' ."\n";
		for($i = 1; $i < 32; $i ++){
			echo "\t\t" .'<option value="' .$i .'"';
			if($i == $birthDay){
				echo " selected";
			}
		echo ">" .$i ."</option> \n";
		}
		echo "\t </select>";
	  ?>
	  
	  <label>S�nnikuu: </label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label>S�nniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthDateError ." " .$birthDayError ." " .$birthMonthError ." " .$birthYearError; ?></span>
	  
	  <br>
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>"><span><?php echo $emailError; ?></span><br>
	  <label>Salas�na (min 8 t�hem�rki):</label><br>
	  <input name="password" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake salas�na:</label><br>
	  <input name="confirmpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submitUserData" type="submit" value="Loo kasutaja"><span><?php echo $notice; ?></span>
	</form>
	<hr>
		
  </body>
</html>