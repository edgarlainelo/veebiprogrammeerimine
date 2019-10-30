<?php

  $username = "Edgar Lainelo";
  $database = "if19_edgar_la_2";

  require ("../../../config_vp2019.php");
  require ("userprofile.php");






  if(isset($_POST["submitProfile"])){
      if(!empty($_POST["description"])){
		storeUserProfile($_POST["mydescription"], $_POST["mybgcolor"], $_POST["mytxtcolor"]);
  }
  }

?>



<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>
	
	
	


<a href="home.php"><input type="button" value="Tagasi" name="tagasi home"></input>