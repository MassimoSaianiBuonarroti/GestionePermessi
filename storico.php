<!DOCTYPE html>
<?php
session_start();
require_once('browser.php'); 
$browser = new Browser();

if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
// else
//     if(($_SESSION["password"]=="12345678")){
//         header("Location:cambiapasswordpa.php");
//     }
$ora= date("H:i:s");
/*if (!($ora<"08:00:00" || $ora>"16:00:00")){
    //echo "<br><br><button type='button' class='btn btn-danger' onclick=window.location.href='nuovoPermesso.php'>NUOVO PERMESSO</button>";
    header("Location:../index.php");   
}*/
if($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_SAFARI){
    header("Location:../index.php");
}
?>
<html>
<title>Storico Permessi</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/stile.css">
<link rel="stylesheet" href="../css/layout.css">
<link href="../css/login_new.css" rel="stylesheet">
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
<script>
function confermaAnnulla(nome){
    var stringadata= nome.datarigaannulla.value;
    var stringadata1= stringadata.split('-');
    var stringafinale= stringadata1[2]+"/"+stringadata1[1]+"/"+stringadata1[0];
    return confirm('Sei sicuro di voler annullare l\'operazione in data  '+stringafinale+'?');               
}
</script>

<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="indexLogout.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <!--<a href="elencomastercompleto.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Elenco</a>

    <a href="nuovoCommerciale.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo Commerciale</a>
    <a href="nuovoPuntoVendita.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo PVR</a>
    <a href="elencomaster.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerca</a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="indexLogout.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <a href="nuovoPermesso.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Permesso</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large">Storico</a>
    <!-- <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large">Cambia Password</a>
     -->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h2 class="w3-margin w3-jumbo testata">Storico Permessi</h2>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">


<br>
 
<?php
include 'accessoDatabase.php';
$con= accesso();
            
//ANNULLA PERMESSO 
if(isset($_POST["annulla"])){
    //echo "pronto per eliminare";
    $idrigainfo= $_POST["idrigaannulla"];

                                 
    $query= "UPDATE permesso SET stato=1 WHERE idPermesso=$idrigainfo";  
    $result=mysqli_query($con,$query); 
    
    //$query_annulla= "SELECT * FROM permesso WHERE fkUtente=".$_SESSION['idutente']. " AND stato=0 AND idPermesso=".$idrigainfo;
    //echo $query;
    $query_annulla= "SELECT * FROM permesso WHERE idPermesso=".$idrigainfo;
    $result_annulla=mysqli_query($con,$query_annulla);
    
    if(mysqli_num_rows($result_annulla)>0){
        $row_annulla= mysqli_fetch_array($result_annulla);
        $tipo1= $row_annulla["tipo"];
        $data1= $row_annulla["data"];
        $orauscita1= $row_annulla["orauscita"];
        $cognomenomegenitore1= $row_annulla["cognomenomegenitore"];
        $cognomenomestudente1= $row_annulla["cognomenomestudente"];
        $classe1= $row_annulla["classe"];
        $motivazione1= $row_annulla["motivazione"];
        $note1= $row_annulla["note"];
        /*if (invioEmail_Annulla($tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$note1)== true){
            header("Location: email_esitoPositivo.php");
        }
        else{
         header("Location: email_esitoNegativo.php");
        }*/
        
    }
} 
else{
    //echo "nooooooooooo";
}
//-------------------------------
            
            
//ELENCO DEI PERMESSI PER GENITORE 
$vetIdUtente= array();
$i= 0;
$query= "SELECT * FROM login WHERE nomeutente=".$_SESSION["nomeutente"];
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result)){
    $cognomenomegenitore1= $row["cognome_genitore"]." ".$row["nome_genitore"];
    $vetIdUtente[$i]= $row["idUtente"];
    $i++;
}
echo "<div style='font-size:20px'><b>GENITORE:</b> <br><b style='color:red'>".$cognomenomegenitore1."</b></div><br>";

                   
//$query= "SELECT * FROM permesso WHERE fkUtente=".$_SESSION['idutente']. " AND stato=0 ORDER BY data";
//echo $query;

$j= 0;
echo '<div style="overflow-x: auto;">';
echo "<table class='table table-striped'>";
echo "<th>DATA</th><th>ORA</th><th>STUDENTE</th><th>CLASSE</th><th>NOTE</th><th></th>";

while($j < $i){
    //$result=mysqli_query($con,$query);
    //$row1= mysqli_fetch_array($result);
    //echo "<div style='font-size:20px'><b>GENITORE:</b> <br><b style='color:red'>".$row1["cognomenomegenitore"]."</b></div><br>";
    //echo "<div style='font-size:20px'><b>STUDENTE:</b> <br><b style='color:red'>".$row1["cognomenomestudente"]."</b></div><br>";
    //echo "<div style='font-size:20px'><b>CLASSE:</b> <br><b style='color:red'>".$row1["classe"]."</b></div><br>";

    //$query= "SELECT * FROM permesso WHERE fkUtente=".$_SESSION['idutente']. " AND stato=0 ORDER BY data";
    $query= "SELECT * FROM permesso WHERE fkUtente=".$vetIdUtente[$j]. " AND stato=0 ORDER BY data";
    $result=mysqli_query($con,$query);
        while($row= mysqli_fetch_array($result)){
        echo "<tr>";                              
        //echo "<td>";
        //echo $row["idUtente"];                              
        //echo "</td>";
        echo "<td>";
        // Creo una array dividendo la data YYYY-MM-DD sulla base del trattino
        $array = explode("-", $row["data"]); 
        // Riorganizzo gli elementi in stile DD/MM/YYYY
        $data_it = $array[2]."/".$array[1]."/".$array[0]; 
        echo $data_it;
        echo "</td>";
        echo "<td>";
        echo $row["orauscita"];                              
        echo "</td>";
        /*echo "<td>";
        echo $row["tipo"];                              
        echo "</td>";*/
        /*echo "<td>";
        echo $row["cognomenomegenitore"];                              
        echo "</td>";*/
        echo "<td>";
        echo $row["cognomenomestudente"];                              
        echo "</td>";
        echo "<td>";
        echo $row["classe"];                              
        echo "</td>";
        //echo "<td>";
        //echo $row["motivazione"];                              
        //echo "</td>";
        echo "<td>";
        echo $row["note"];                              
        echo "</td>";
                
        echo "<form name='elimina' action='#' method='POST' onsubmit='return confermaAnnulla(this)'>";  
        echo "<td>"; 
        echo "<input type='hidden' name='idrigaannulla' value='".$row["idPermesso"]."'>";
        echo "<input type='hidden' name='datarigaannulla' value='".$row["data"]."'>";                             
        echo "<button class='btn btn-danger' type='submit' name='annulla'>X</button>";                          
        echo "</td>";                
        echo "</form>";
        echo "</tr>";
    }
    
    $j++;
}
echo "</table>";
echo "</div>";
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
