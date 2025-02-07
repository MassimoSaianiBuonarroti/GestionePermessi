<?php
  ob_start();
/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

?>

<!DOCTYPE html>
<html>
<title>Permessi di uscita</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/stile.css">
<link rel="stylesheet" href="css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/fonts.css">
<link rel="icon" type="image/x-icon" href="./immagini/favicon.ico">
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

  <?php
  session_start();

  if (isset($_SESSION["loggato"]) && $_SESSION["loggato"] == "si") 
  {
    if ($_SESSION["ruolo"] == "admin")
    {
      header("Location: pagine/frontoffice.php");
    } 
    else 
    {
       header("Location: pagine/indexLogout.php");
    }
  }
  else 
  {
    header("Location: pagine/indexLogin.php");
  }
?>

</body>

</html>