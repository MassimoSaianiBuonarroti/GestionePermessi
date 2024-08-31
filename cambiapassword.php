<!DOCTYPE html>
<?php
session_start();
require_once('browser.php');
$browser = new Browser();
if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
else
    if(($_SESSION["password"]=="12345678")){
        header("Location:cambiapasswordpa.php");
}

if($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_SAFARI){
    header("Location:../index.php");
}
?>
<html>
<title>Cambio Password</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/stile.css">
<link rel="stylesheet" href="../css/layout.css">
<link href="../css/login_new.css" rel="stylesheet">
<link rel="stylesheet" href="../css/fonts.css">

<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<script type="text/javascript">
    function showPwd() {
            var input = document.getElementById('pwd');
            if (input.type === "password") {
            input.type = "text";
            } else {
            input.type = "password";
            }
        }
    function showPwd1() {
        var input = document.getElementById('pwd1');
        if (input.type === "password") {
        input.type = "text";
        } else {
        input.type = "password";
        }
    }
</script>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <!--<a href="elencomastercompleto.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Elenco</a>
    <a href="nuovoCommerciale.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo Commerciale</a>
    <a href="nuovoPuntoVendita.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo PVR</a>
    <a href="elencomaster.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerca</a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <a href="nuovoPermesso.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Permesso</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large">Storico</a>
    <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large">Cambia Password</a>
    
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h2 class="w3-margin w3-jumbo testata">Cambia Password</h2>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <form name="cambiapassword" action="#" method="POST">                       
        <div>INSERISCI LA NUOVA PASSWORD:</div>
        <p><input type="password" name="nuovapassword" placeholder="Nuova Password" id="pwd"></p>  
        <input type="button" onclick="showPwd()" value="Mostra/nascondi password">
        <br><br>
        <div>RIPETI LA NUOVA PASSWORD:</div>
        <p><input type="password" name="nuovapassword_ripeti" placeholder="Ripeti Nuova Password" id="pwd1"></p> 
        <input type="button" onclick="showPwd1()" value="Mostra/nascondi password">
        <p><button class="btn btn-danger" type="submit" name="modificapassword">MODIFICA PASSWORD</button></p>       
    </form>
    <?php
    include 'accessoDatabase.php';

    if(isset($_POST["modificapassword"])){
        $con= accesso();        
        $nuovapassword= $_POST["nuovapassword"]; 
        $nuovapassword_ripeti= $_POST["nuovapassword_ripeti"];
        $fkUtente= $_SESSION["nomeutente"];//$_SESSION["idutente"];
        if($nuovapassword == $nuovapassword_ripeti){
            if(modificaPassword($con,$nuovapassword,$nuovapassword_ripeti,$fkUtente)==true){
                $_SESSION["password"]= $nuovapassword;
                echo "<p>LA PASSWORD E' STATA MODIFICATA CON SUCCESSO.</p>";
                echo "<p>AL PROSSIMO ACCESSO, RICORDA DI UTILIZZARE LA NUOVA PASSWORD.</p>";
                echo "<p>STAI PER ESSERE REINDIRIZZATO ALLA HOMEPAGE</p>";
                header("refresh:5;url=indexLogout.php");
            }
            else{
                echo "LA PASSWORD NON E' STATA MODIFICATA";
            }
        }
        else{
            echo "<p style=color:red>LE DUE PASSWORD NON SONO UGUALI</p>";
        }
    }
    ?>  
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <i><img src="../immagini/logoscuola_icona.png" style="width:70px;height:auto"></i>
    
 </div>
 <p>© 2024 ITT Buonarroti - Trento. Tutti i diritti riservati. </p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>













