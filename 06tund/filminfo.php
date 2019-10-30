<?php 
 require ("../../../config_vp2019.php");
 require ("functions_film.php");
 
 $username = "Edgar Lainelo";
 $database = "if19_edgar_la_1";
 
 
 
 
 
 $filmInfoHTML = readAllFilms ();
 
 
 require("header.php");
 echo "<h1>" .$username .", veebiprogrameerimine2019</h1>";
?>

  <p> See veebileht on valminud.....</p>
  <hr>
  <h2> Eesti filmid</h2>
  <p>Meie andmebaasis leiduvad järgmised filmid: </p>
  <hr>
  <?php
    echo $filmInfoHTML;
  ?>

</body>
</html>