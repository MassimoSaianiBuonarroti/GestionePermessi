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
<title>Gestione Permessi - Informazioni</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/stile.css">
<link rel="stylesheet" href="../css/layout.css">
<link rel="stylesheet" href="../css/login_new.css">
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

<!-- SCRIPT CHE CONFERMA L'ELIMINAZIONE DI UN COMMERCIALE E DI UN PV DI MASTER E IL PV DI UN COMMERCIALE-->
<!--<script>
function confermaElimina(nome){
    return confirm('Sei sicuro di voler eliminare '+nome.nicknamerigaelimina.value+'?');               
}
function confermaEliminaPV(nome){
    return confirm('Sei sicuro di voler eliminare '+nome.nicknamerigaeliminapv.value+'?');               
}
function confermaTrasferimento(nome){
    return confirm('Sei sicuro di voler trasferire '+nome.ragsocialetrasferisci.value+'?');               
}
function confermaTrasferimentopvcom(nome){
    return confirm('Sei sicuro di voler trasferire '+nome.ragsocialetrasferiscipvcom.value+'?');               
}
</script>-->

<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="frontoffice.php" class="w3-bar-item w3-button w3-padding-large w3-white">Front Office</a>
    <a href="pannello_controllo.php" class="w3-bar-item w3-button w3-padding-large w3-white">Pannello di controllo</a>

    <!--<a href="elencomastercompletoPV.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Elenco</a>
    <a href="nuovoPuntoVenditaPV.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo PVR</a>
    <a href="elencomasterPV.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerca</a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="frontoffice.php" class="w3-bar-item w3-button w3-padding-large">Front Office</a>
    <a href="pannello_controllo.php" class="w3-bar-item w3-button w3-padding-large">Pannello di controllo</a>
    <!--<a href="elencomastercompletoPV.php" class="w3-bar-item w3-button w3-padding-large">Elenco</a>
    <a href="nuovoPuntoVenditaPV.php" class="w3-bar-item w3-button w3-padding-large">Nuovo PVR</a>
    <a href="elencomasterPV.php" class="w3-bar-item w3-button w3-padding-large">Cerca</a>-->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h1 class="w3-margin w3-jumbo testata">Informazioni</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">

<!--<div>
    <form name="ricerca" action="#" method="GET">
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='completo' checked>COMPLETO</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='studente' >STUDENTE</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='classe' >CLASSE</span>
        
        <p><input type="text" name="nomedacercare" placeholder="Descrizione"></p>
        <span><button class='btn btn-danger' type='submit' name='ricerca'>RICERCA</button></span>
    </form>
</div>-->
<br>
 
<?php
include 'accessoDatabase.php';
$con= accesso();

//RICERCA
if(isset($_GET["info_studente"])){
    $idrigastudente= $_GET["idrigastudente"];
    $cognomerigastudente= mysqli_real_escape_string($con,$_GET["cognomerigastudente"]);
    $nomerigastudente= mysqli_real_escape_string($con,$_GET["nomerigastudente"]);
    $classerigastudente= $_GET["classerigastudente"];
    echo "<h3>STUDENTE: $cognomerigastudente". " "."$nomerigastudente</h3>";
    echo "<h3>CLASSE: $classerigastudente</h3>";
    echo "<h3 style='color:red'>DATI GENITORI</h3>";
    $query= "SELECT * FROM login WHERE cognome LIKE '%$cognomerigastudente%' AND nome LIKE '%$nomerigastudente%' AND classe='".$classerigastudente."' ORDER BY cognome,nome ASC";
    //echo $query;
    $result= mysqli_query($con,$query);

    echo '<div style="overflow-x: auto;">';
    echo "<table class='table table-striped'>";               
    echo "<th>COGNOME</th><th>NOME</th><th>USERNAME</th><th>PASSWORD</th><th>PASSWORD CAMBIATA</th><th></th><th></th>";
    while($row= mysqli_fetch_array($result)){
        echo "<tr>";                              
        echo "<td>";
        echo $row["cognome_genitore"];                              
        echo "</td>";
        echo "<td>";
        echo $row["nome_genitore"];                              
        echo "</td>";
        echo "<td>";
        echo $row["nomeutente"];                              
        echo "</td>";
        echo "<td>";
        echo $row["password"];                              
        echo "</td>";
        echo "<td>";
        echo $row["password_cambiata"];                              
        echo "</td>";

        //CANCELLO LA VARIABILE DI SESSIONE
        unset($_SESSION["idUtente"]);
        //INFO
        echo "<form name='modifica_genitore' action='modifica_genitore.php' method='GET'>";
        echo "<td>";  
        echo "<input type='hidden' name='idrigagenitore' value='".$row["idUtente"]."'>";
        echo "<button class='btn btn-primary' type='submit' name='modifica_genitore'>MODIFICA</button>";
        echo "</td>";                
        echo "</form>";

        

        echo "</tr>";   
    }
    echo "</table>";  
    echo '</div>';
    
}
//---------------------------------------------
            

            
//ELIMINA UTENTE (PV DEL COMMERCIALE)
if(isset($_GET["eliminapv"])){
    //echo "pronto per eliminare";
    $idrigainfo= $_GET["idrigaeliminapv"];
               
    $query= "DELETE  FROM pianovisite WHERE idUtente=$idrigainfo"; 
    //echo "alert('$query')";
    $result=mysqli_query($con,$query);
                
    //$query= "DELETE  FROM associazione WHERE associazione.fkPadre=$idrigainfo";               
    //$result=mysqli_query($con,$query);
                
    //$query= "DELETE  FROM associazione WHERE fkFiglio=$idrigainfo ";               
    //$result=mysqli_query($con,$query);
} 
else{
    //echo "nooooooooooo";
}
//-------------------------------
?>
</div>
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
