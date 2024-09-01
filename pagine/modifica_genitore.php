<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
if($_SESSION["nomeutente"] != "201800" && $_SESSION["password"] != "Staff2019"){
    header("Location:../index.php");
}
?>
<html>
<title>Gestione permessi - Modifica Dati Genitore</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/stile.css">
<link rel="stylesheet" href="../css/layout.css">
<link rel="stylesheet" href="../css/login_new.css">
<link rel="stylesheet" href="../css/fonts.css">

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
    <a href="frontoffice.php" class="w3-bar-item w3-button w3-padding-large w3-white">Front Office</a>
    <a href="pannello_controllo.php" class="w3-bar-item w3-button w3-padding-large w3-white">Pannello di controllo</a>

  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="frontoffice.php" class="w3-bar-item w3-button w3-padding-large">Front Office</a>
    <a href="pannello_controllo.php" class="w3-bar-item w3-button w3-padding-large">Pannello di controllo</a>

    
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h1 class="w3-margin w3-jumbo testata">Modifica Dati Genitore</h1>
</header>

<!-- First Grid -->
<?php
//if(isset($_GET["idrigamodifica"])){
if (isset($_SESSION["idUtente"])){
    $idrigainfo= $_SESSION["idUtente"];
}
else{
    $idrigainfo= $_GET["idrigagenitore"];
}

//echo "INFO: ".$_GET["idrigainfo"];
include 'accessoDatabase.php';
$con= accesso();
$query= "SELECT * FROM login WHERE idUtente=$idrigainfo";

                
$result=mysqli_query($con,$query);
$utenteSelezionato= mysqli_fetch_array($result);
//}
echo "<h3 style='color:red'>GENITORE: ".$utenteSelezionato['cognome_genitore']." ".$utenteSelezionato['nome_genitore']."</h3>";
?>

<div class="w3-row-padding w3-padding-64 w3-container">
    <form name="modificaDatiGenitore" action="#" method="GET">
        <p>Nome Utente<input type="text" name="nomeutente" placeholder="Nome Utente" value="<?php echo $utenteSelezionato["nomeutente"]?>"></p>
        <p>Password <br>(es. anno2022) - Ci pensa il programma a criptarla<input type="text" name="passw" placeholder="Password" value="<?php echo $utenteSelezionato["password"]?>"></p>
        <p><input type='hidden' name='idrigagenitore' value="<?php echo $utenteSelezionato["idUtente"]?>"></p>
        <p><button class="btn btn-black adatta_testo1" type="submit" name="salvamodifica"><b>MODIFICA</b> </button></p>        
    </form>
    <?php
    //include 'accessoDatabase.php';
    if(isset($_GET["salvamodifica"])){
        //$con= accesso();
        $nomeutente= $_GET["nomeutente"];
        //echo $nickname;
        $passw= $_GET["passw"];
        
        $idMaster= $_GET["idrigagenitore"];
        //echo $idMaster;
        //Preparated Statement
        // prepare and bind
        $stmt = $con->prepare("UPDATE login SET nomeutente=?,password=?,password_cambiata=? WHERE idUtente=?");
        $stmt->bind_param("sssi", $nomeutente1,$passw1,$passwordcambiata1,$idMaster1);

        // set parameters and execute
        $nomeutente1= $nomeutente;
        $passw1= md5($passw);
        $passwordcambiata1="no";
        $idMaster1= $idMaster;
        $_SESSION["idUtente"]= $idMaster1;
        $stmt->execute();
        //--------------------
        echo "<h3 style='color:red'>AGGIORNAMENTO AVVENUTO CON SUCCESSO</h3>";
        //header("Location: modifica_genitore.php");  
        header('Refresh: 1; url=pannello_controllo.php');

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













