 function newPassword($password){
   
   $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
   $stmt = $conn->prepare("SELECT id FROM vpusers2 WHERE email = ?");
   echo $conn->error;
   $stmt->bind_param("s", $email);
	$stmt->bind_result($idFromDb);
	$stmt->execute();
	if($stmt->fetch()){
         $stmt->close;
		 $stmt = $conn->prepare("UPDATE vpusers2 SET password = ? WHERE id = ".$_SESSION["userId"]."");
		 echo $conn->error;
		 
		 
		 $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	     $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
		 
		 $stmt->bind_param("s", $pwdhash);
		 
		 if($stmt->execute()){
			 $notice = "Password on uuendatud";
		 } else {
			 $notice = "Passwordi uuendamisel tekkis tõrge! " .$stmt->error;
		 }
   
	}
   
   $stmt->close();
   $conn->close();
 }




if(isset($_POST["submitNewPassword"])){
	  
	  

  
  
    if (!isset($_POST["oldPassword"]) or empty($_POST["oldPassword"])){
	  $confirmpasswordError = "Palun sisestage salasõna kaks korda!";  
	} else {
	  if($_POST["oldPassword"] != $_POST["oldPassword2"]){
	    $confirmpasswordError = "Sisestatud salasõnad ei olnud ühesugused!";
	  }
	}
	
	
  	if($_POST["oldPassword"] != $parool and $_POST["oldPassword2"] != $parool){
		$notice2 = "Parool ei ole õige!";
	} else {
		$notice2 = null;
	}
  
  
    
  
    if (!isset($_POST["password"]) or empty($_POST["password"])){
	  $passwordError = "Palun sisesta salasõna! ";
	} else {
	  if(strlen($_POST["password"]) < 8){
	    $passwordError = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["password"]) ." märki). ";
	  }
	}
	
	
	if(empty($passwordError) and empty($notice2) and empty($confirmPasswordError)){
		$notice = newPassword($_POST["password"]);
	} else {
		$notice = "Ei saa salvestada, andmed on puudulikud!";
	}
  }