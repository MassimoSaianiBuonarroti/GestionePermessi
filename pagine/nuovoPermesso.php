<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

 ?>

<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="../css/login_new.css" rel="stylesheet">
<!--<script src="../js/bootstrap.min.js"></script>-->
<script src="../js/jquery-1.11.1.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<?php
ob_start();
session_start();
global $settings;
require_once('browser.php'); 
$browser = new Browser();

if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
date_default_timezone_set("Europe/Rome");
$ora= date("H:i:s");

if (!($ora<$_SESSION["permessi_ora_fine"] || $ora>$_SESSION["permessi_ora_inizio"])){
    //echo "<br><br><button type='button' class='btn btn-danger' onclick=window.location.href='nuovoPermesso.php'>NUOVO PERMESSO</button>";
    header("Location:../index.php");   
}
if($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_SAFARI){
    header("Location:../index.php");
}
?>
<html>
<title>Permessi di uscita</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/stile.css">
<link rel="stylesheet" href="../css/styleradio.css">
<link rel="stylesheet" href="../css/layout.css">
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
    <a href="indexLogout.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large w3-white">Storico</a>
    <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large w3-white">Cambia Password</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="indexLogout.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <a href="nuovoPermesso.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Permesso</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large">Storico</a>
    <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large">Cambia Password</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h2 class="w3-margin w3-jumbo testata">Nuovo Permesso</h2>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <?php
    require_once 'accessoDatabase.php';
    $con= accesso();
    //$query= "SELECT * FROM login WHERE idUtente=".$_SESSION["idutente"];
    $passw= md5($_SESSION["password"]);
    $query= "SELECT * FROM login WHERE nomeutente=".$_SESSION["nomeutente"];
    //echo $query;
    
    $result=mysqli_query($con,$query);
    //echo mysqli_num_rows($result);
    if(mysqli_num_rows($result)>0){
        $row= mysqli_fetch_array($result);
        $nomegenitore= $row["cognome_genitore"]." ".$row["nome_genitore"];
        //$nomestudente= $row["cognome"]." ".$row["nome"];
        //$classe= $row["classe"];*/       
    }
    ?>
    <form name="nuovoPermesso" action="#bottom" method="POST">    
        <div>
            <label>
                <!--<input type="radio" class="option-input radio" name='opzione' value="entrata" checked />-->
                <!--ENTRATA-->
            </label>
            <label>
              <input type="radio" class="option-input radio" name='opzione' value="uscita" checked/>
             USCITA
            </label>
            
        </div>
        
        
        
        <!--
        <input type='radio' name='opzione' value="entrata" checked> ENTRATA<br><br>
        <input type='radio' name='opzione' value="uscita" > USCITA<br><br>-->
        <!--<input type='radio' name='opzione' value="assenza" > ASSENZA<br><br>-->
        <div style="padding-top:2%">DATA <input type="date" name="data" placeholder="Data" required></div>
        <div></div><br>
        <!--<p><input type="text" name="orauscita" placeholder="Ora HH:MM"></p>-->      
        <div style="padding-top:2%">ORA <input type="time" name="orauscita" required></div>
        <p><input type="text" name="cognomenomegenitore" required placeholder="Cognome e Nome del Genitore" value="<?php echo $nomegenitore?>"readonly></p>
        <?php
        $passw= md5($_SESSION["password"]);
        $query1= "SELECT * FROM login WHERE nomeutente=".$_SESSION["nomeutente"];
        //echo $query;   
        $result1=mysqli_query($con,$query1);
        //echo mysqli_num_rows($result);
        if(mysqli_num_rows($result1)>0){ 
            echo '<div style="font-size:16px">SELEZIONA STUDENTE</div>';
            echo "<select name='idfiglio'>";
            while($row= mysqli_fetch_array($result1)){                            
                echo "<option value=".$row["idUtente"].">".$row["cognome"]."  ".$row["nome"]." - ".$row["classe"]."</option>";      
            }            
            echo "</select>";
        }
        ?>
        <!--<p><input type="text" name="cognomenomestudente" placeholder="Cognome e Nome dello studente" value="<?php //echo $nomestudente?>"></p>
        <p><input type="text" name="classe" placeholder="Classe" value="<?php //echo $classe?>"></p>-->
        <!--<p><input type="text" name="motivazione" placeholder="Motivazione"></p> -->       
        <br><br>
        <p>MOTIVAZIONE RICHIESTA PERMESSO<br><textarea name="note" rows="7" cols="40" required></textarea></p>
        <p><input type="hidden" name="tipo" value="com"></p>
        <p><button class="btn btn-black adatta_testo1" type="submit" name="invia"><b>INVIA</b> </button></p>       
    </form>
    <?php
    //include 'accessoDatabase.php';

    if(isset($_POST["invia"])){
        //$con= accesso();
        $tipo= $_POST["opzione"];
        //echo $tipo."<br>";
        $data= $_POST["data"];
        //echo $data."<br>";
        $orauscita= $_POST["orauscita"];
        //echo $orauscita;
        $cognomenomegenitore= $_POST["cognomenomegenitore"];
        //echo $cognomenomegenitore."<br>";
        
        $idstudentesel= $_POST["idfiglio"];
        $query2= "SELECT * FROM login WHERE idUtente=$idstudentesel";
        //echo $query;   
        $result2=mysqli_query($con,$query2);
        //echo mysqli_num_rows($result);
        if(mysqli_num_rows($result2)>0){ 
            $row= mysqli_fetch_array($result2);
            $cognomenomestudente= $row["cognome"]." ".$row["nome"];                          
            $classe= $row["classe"];             
        }
        
        //$cognomenomestudente= $_POST["cognomenomestudente"];
        //echo $cognomenomestudente."<br>";
        //$classe= $_POST["classe"];
        //echo $classe."<br>";
        //$motivazione= $_POST["motivazione"];
        //echo $motivazione."<br>";
        $note= $_POST["note"];
        //echo $note."<br>";
        $fkUtente= $idstudentesel; //$_SESSION["idutente"];
        //echo $fkUtente."<br>";
        //CONTROLLO DELLA DATA - NON DEVE ESSERE ANTECEDENTE L GIORNO CORRENTE
        $data_corrente= date("Y-m-d");
        //echo $data_corrente;
        $data_corrente_esplosa= explode("-",$data_corrente); 
        $Y= $data_corrente_esplosa[0];
        $m= $data_corrente_esplosa[1];
        $d= $data_corrente_esplosa[2];
        $data_domani=  date('Y-m-d', mktime(0,0,0,date($m),date($d)+1,date($Y)));
        //echo "OGGI: ". $data." DOMANI: ".$data_domani;

        if($data>=$data_corrente){ 
            //CONTROLLO CHE LA DATA NON SIA SUCCESSIVA A DOMANI
            if($__settings->config->limitaDataPermessi == true && $data>$data_domani){
                //echo "<div style=color:red>Non è possibile creare PERMESSI nei giorni successivi a domani.</div>";
                //echo "<div style=color:red>Selezionare una DATA corretta.</div>";  
                $risposta= "Non è possibile creare PERMESSI nei giorni successivi a domani. Selezionare una DATA corretta";
                    echo "<script>alert('".$risposta."')</script>";
                    echo "<div class='alert alert-danger'>
                        <strong>".$risposta."</strong> 
                        </div>";   
            }  
            else{
                $risposta= "Il permesso è stato creato correttamente.";
                echo "<script>alert('".$risposta."'); </script>";
                echo "<div id='bottom' class='alert alert-success'>
                            <strong>".$risposta."</strong> 
                            </div>";
                salvaPermesso($con,$tipo,$data,$orauscita,$cognomenomegenitore,$cognomenomestudente,$classe,$note,$fkUtente);
            }
        }
        else{
            //echo "<div style=color:red>Non è possibile creare PERMESSI nei giorni antecedenti al giorno corrente.</div>";
            //echo "<div style=color:red>Selezionare una DATA corretta.</div>";
            $risposta= "Non è possibile creare PERMESSI nei giorni antecedenti al giorno corrente. Selezionare una DATA corretta";
            echo "<script>alert('".$risposta."'); </script>";
            echo "<div class='alert alert-danger'>
                        <strong>".$risposta."</strong> 
                        </div>";
        }
        
    }
    ?>  
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <i><img class="schermo_intero" src="../immagini/<?php echo $__settings->config->imgLogoQuadrato?>" style="width:70px;height:auto"></i>
    
 </div>
 <p style="font-size:14px"><strong><?php echo $__software_copyright ?></strong></p>
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













