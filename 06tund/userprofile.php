<?php
  function storeUserProfile ($mydescription, $mybgcolor, $mytxtcolor){
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("INSERT INTO vpuserprofiles (description, bgcolor, txtcolor) VALUES (?,?,?)");
	  echo $conn->error;
	  $stmt->bind_param("sii", $mydescription, $mybgcolor, $mytxtcolor);
	  $stmt->execute();
	  
	  $stmt->close();
	  $conn->close();
  }

  function showAllData (){
	  $conn = new msqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("SELECT description, bgcolor, txtcolor) FROM vpuserprofiles");
	  echo $conn->error;
	  $stmt->bind_result($mydescription, $mybgcolor, $mytxtcolor);
	  $stmt->execute();
	  echo $stmt->error;
	  
	
	  
  }

?>