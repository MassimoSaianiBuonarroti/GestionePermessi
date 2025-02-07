<!DOCTYPE html>
<?php
ob_start();
session_start();
if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
if($_SESSION["nomeutente"] != "201800" && $_SESSION["password"] != "Staff2019"){
    header("Location:../index.php");
}
?>
<html>
<title>Gestione Permessi - Pannello</title>
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
    <!--<a href="elencomastercompletoPV.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Elenco</a>
    <a href="nuovoPuntoVenditaPV.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo PVR</a>
    <a href="elencomasterPV.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerca</a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="frontoffice.php" class="w3-bar-item w3-button w3-padding-large">Front Office</a>
    <!--<a href="elencomastercompletoPV.php" class="w3-bar-item w3-button w3-padding-large">Elenco</a>
    <a href="nuovoPuntoVenditaPV.php" class="w3-bar-item w3-button w3-padding-large">Nuovo PVR</a>
    <a href="elencomasterPV.php" class="w3-bar-item w3-button w3-padding-large">Cerca</a>-->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h1 class="w3-margin w3-jumbo testata">Ricerca</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">

<div>
    <form name="ricerca" action="#" method="GET">
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='completo' checked>COMPLETO</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='studente' >STUDENTE</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='classe' >CLASSE</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='genitore' >GENITORE</span>
        <!--<span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='cognome' >COGNOME</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='citta' >CITTA'</span>
        <span style="margin-right: 3%;font-size: 16px"><input type='radio' name='ricercaper' value='provincia' >PROVINCIA</span>-->
        <p><input type="text" name="nomedacercare" placeholder="Descrizione"></p>
        <span><button class='btn btn-black adatta_testo1' type='submit' name='ricerca'><b>RICERCA</b></button></span>
    </form>
</div>
<br>
 
<?php
include 'accessoDatabase.php';
$con= accesso();

//RICERCA
if(isset($_GET["ricerca"])){
    $scelta= $_GET["ricercaper"];
    $descrizione= $_GET["nomedacercare"];
    
    if($scelta=="completo"){
        echo "<h3>RICERCA COMPLETA</h3>";
        //include 'elencoricercacompletoPV.php';
        $query= "SELECT DISTINCT cognome,nome,classe,idUtente,cognome_genitore,nome_genitore FROM login GROUP BY cognome,nome ORDER BY cognome,nome ASC";
    }
    elseif($scelta=="studente" && $descrizione!=""){
        echo "<h3>RICERCA PER STUDENTE: <b>".$descrizione."</b></h3>";
        //include 'elencoricercacompletoPV.php';
        $query= "SELECT DISTINCT cognome,nome,classe,idUtente,cognome_genitore,nome_genitore FROM login WHERE cognome LIKE '%".$descrizione."%' GROUP BY cognome,nome ORDER BY cognome,nome ASC";
    }
    elseif($scelta=="classe" && $descrizione!=""){
        echo "<h3>RICERCA PER CLASSE: <b>".$descrizione."</b></h3>";
        //include 'elencoricercaragsocialePV.php';
        $query= "SELECT DISTINCT cognome,nome,classe,idUtente,cognome_genitore,nome_genitore FROM login WHERE classe='".$descrizione."' GROUP BY cognome,nome ORDER BY cognome,nome ASC";

    }
    elseif($scelta=="genitore" && $descrizione!=""){
        echo "<h3>RICERCA PER GENITORE: <b>".$descrizione."</b></h3>";
        //include 'elencoricercaragsocialePV.php';
        $query= "SELECT DISTINCT cognome,nome,classe,idUtente,cognome_genitore,nome_genitore FROM login WHERE cognome_genitore='".$descrizione."' GROUP BY cognome,nome ORDER BY cognome,nome ASC";

    }
    //echo $query;
    $result= mysqli_query($con,$query);

    echo '<div style="overflow-x: auto;">';
    echo "<table class='table table-striped'>";               
    echo "<th>COGNOME</th><th>NOME</th><th>CLASSE</th><th> 1° GENITORE</th><th></th><th></th><th></th>";
    while($row= mysqli_fetch_array($result)){
        echo "<tr>";                              
        echo "<td>";
        echo $row["cognome"];                              
        echo "</td>";
        echo "<td>";
        echo $row["nome"];                              
        echo "</td>";
        echo "<td>";
        echo $row["classe"];                              
        echo "</td>";
        echo "<td>";
        echo $row["cognome_genitore"]." ".$row["nome_genitore"];                              
        echo "</td>";

        // //INFO
        // echo "<form name='info_studente' action='info_studente.php' method='GET'>";
        // echo "<td>";  
        // echo "<input type='hidden' name='idrigastudente' value='".$row["idUtente"]."'>";
        // echo "<input type='hidden' name='cognomerigastudente' value='".$row["cognome"]."'>";
        // echo "<input type='hidden' name='nomerigastudente' value='".$row["nome"]."'>";
        // echo "<input type='hidden' name='classerigastudente' value='".$row["classe"]."'>";
        // echo "<input type='hidden' name='genitorerigastudente' value='".$row["cognome_genitore"]."'>";
        // echo "<button class='btn btn-primary' type='submit' name='info_studente'>INFO</button>";
        // echo "</td>";                
        // echo "</form>";

        //PERMESSI
        echo "<form name='permessi_studente' action='permessi_studente.php' method='GET'>";
        echo "<td>";  
        echo "<input type='hidden' name='idrigastudente' value='".$row["idUtente"]."'>";
        echo "<input type='hidden' name='cognomerigastudente' value='".$row["cognome"]."'>";
        echo "<input type='hidden' name='nomerigastudente' value='".$row["nome"]."'>";
        echo "<input type='hidden' name='classerigastudente' value='".$row["classe"]."'>";
        echo "<input type='hidden' name='genitorerigastudente' value='".$row["cognome_genitore"]."'>";
        echo "<button class='btn btn-danger' type='submit' name='permessi_studente'>PERMESSI</button>";
        echo "</td>";                
        echo "</form>";

        //GIUSTIFICAZIONI
        // echo "<form name='giustificazioni_studente' action='giustificazioni_studente.php' method='GET'>";
        // echo "<td>";  
        // echo "<input type='hidden' name='idrigastudente' value='".$row["idUtente"]."'>";
        // echo "<input type='hidden' name='cognomerigastudente' value='".$row["cognome"]."'>";
        // echo "<input type='hidden' name='nomerigastudente' value='".$row["nome"]."'>";
        // echo "<input type='hidden' name='classerigastudente' value='".$row["classe"]."'>";
        // echo "<input type='hidden' name='genitorerigastudente' value='".$row["cognome_genitore"]."'>";
        // echo "<button class='btn btn-warning' type='submit' name='giustificazioni_studente'>GIUSTIFICAZIONI</button>";
        // echo "</td>";                
        // echo "</form>";

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
