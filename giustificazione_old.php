<!DOCTYPE html>
<?php
session_start();
require_once('browser.php');
$browser = new Browser();
if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
else{
    if(($_SESSION["password"]=="12345678")){
        header("Location:cambiapasswordpa.php");
    }
}
$ora= date("H:i");
//Mettere 16
if (!($ora<"08:00:00" || $ora>"12:00:00")){
    header("Location:../index.php");   
}
if($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_SAFARI){
    header("Location:../index.php");
}
?>
<html>
<title>Giustificazione assenze</title>
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
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <!--<a href="elencomastercompleto.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Elenco</a>

    <a href="nuovoCommerciale.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo Commerciale</a>
    <a href="nuovoPuntoVendita.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo PVR</a>
    <a href="elencomaster.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerca</a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <!--<a href="../index.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <a href="nuovoPermesso.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Permesso</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large">Storico</a>
    <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large">Cambia Password</a>
    -->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:40px 16px">
  <h2 class="w3-margin w3-jumbo">Giustificazione assenze</h2>
  <!--<h4>per casi sospetti o accertati di infezione da Covid-19</h4>-->
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
<h1 style="text-align:center"></h1>   
        <div id="dimensione">
            <form name="modulo" action="#" method="GET" >
                <div class="imgcontainer">
                    <!--<img src="../immagini/user.png" alt="Avatar" class="avatar">-->
                </div>

                <div class="imgcontainer">
                    <!--<label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="nomeutente" >
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" > -->   
                    <?php
                        //echo $_SESSION["idutente"];
                        include 'accessoDatabase.php';
                        $con= accesso();
                        $query= "SELECT * FROM login WHERE idUtente=".$_SESSION["idutente"];
                        $result=mysqli_query($con,$query);   
                        if(mysqli_num_rows($result)>0){
                            $row= mysqli_fetch_array($result);
                            $nomegenitore= $row["cognome_genitore"]." ".$row["nome_genitore"];
                        }
                        
                        echo "<h4>Benvenuto <b>".$nomegenitore."</b></h4>";
                        echo "<h4>MOTIVI DI SALUTE CON CONDIZIONI:</h4>";
                        $ora= date("H:i");
        
                        echo "<br><br><button type='button' class='btn btn-danger' onclick=window.location.href='modulo_sospetto.php'>sospette Covid-19</button>";
                        echo "<br><br><button type='button' class='btn btn-primary' onclick=window.location.href='modulo_non_sospetto_minore3.php'>NON sospette Covid-19</button>";
                        echo "<br><br><button type='button' class='btn btn-primary' onclick=window.location.href='modulo_non_sospetto_maggiore3.php'>NON sospette Covid-19 superiore a 3 giorni</button>";
                        echo "<br><br><button type='button' class='btn btn-secondary' onclick=window.location.href='modulo_motivi_personali_maggiore3.php'>Motivi personali</button>";
                        echo "<br><br><button type='button' class='btn btn-info' onclick=window.location.href='modulo_entrata_ritardo.php'>Giustificazione entrata in ritardo</button>";
                    ?>
                                     
                </div>
            </form>
            
            
        </div>
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
