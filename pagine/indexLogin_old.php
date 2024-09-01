<!DOCTYPE html>
<html>
<?php
session_start();
if($_SESSION["loggato"]=="no"){
    echo "<script>alert('NOME UTENTE O PASSWORD NON CORRETTA');</script>";
    unset($_SESSION["loggato"]);
}
?>
<title>Permessi di uscita</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/stile.css">
<link rel="stylesheet" href="../css/layout.css">
<link rel="stylesheet" href="../css/fonts.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>



<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <!--<a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="pagine\nuovoCommerciale.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo Commerciale</a>
    <a href="pagine\nuovoPuntoVendita.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo Punto Vendita</a>
    -->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
   <!-- <a href="pagine\nuovoCommerciale.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Commerciale</a>
    <a href="pagine\nuovoPuntoVendita.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Punto Vendita</a>
    -->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:40px 16px">
    <h2 class="w3-margin w3-jumbo"><img src="../immagini/logoscuola.png" style="width:300px;height:140px"></h2>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
<h1 style="text-align:center">PERMESSI DI USCITA<br>E GIUSTIFICAZIONE ASSENZE <br>a.s. 2020/2021</h1>   
    <div style="text-align:center"><b>Permessi di uscita:</b> dalle ore 17 del giorno precedente alle ore 9 del giorno del permesso</div>
    <div style="text-align:center"><b>Giustificazioni:</b> dalle ore 17 del giorno precedente il rientro alle ore 7 del giorno del rientro</div>
        <div id="dimensione">
            <form name="modulo" action="controlloLogin.php" method="POST" >
                <div class="imgcontainer">
                    <!--<img src="../immagini/user.png" alt="Avatar" class="avatar">-->
                    <label><h4>LOGIN</h4></label>
                </div>

                <div class="imgcontainer">
                    <label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="nomeutente" required>
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" required>        					
                    <button type="submit" class="btn btn-primary"  >ACCEDI</button>                   
                </div>
            </form>
        </div>
    <div style="text-align:center;color:red;font-size:16px">Ottimizzato per Google Chrome</div> 
    <div style="text-align:center;color:blue;font-size:16px">Per problemi di accesso inviare una email a: <br><b>registroelettronico@buonarroti.tn.it</b></div>
    
    

  
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <i><img src="../immagini/logoscuola_icona.png" style="width:90px;height:70px"></i>
    
 </div>
 <p>© 2020 ITT Buonarroti - Trento. Tutti i diritti riservati. </p>
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
