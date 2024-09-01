<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="../css/login_new.css" rel="stylesheet"  >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
session_start();
include "impostazioni.php";

require_once('browser.php'); 
$browser = new Browser();

if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
else
    if(($_SESSION["password"]=="12345678")){
        header("Location:cambiapasswordpa.php");
    }
$ora= date("H:i:s");
if (!($ora<$_SESSION["giustificazioni_ora_fine"] || $ora>$_SESSION["giustificazioni_ora_inizio"])){
    //echo "<br><br><button type='button' class='btn btn-danger' onclick=window.location.href='nuovoPermesso.php'>NUOVO PERMESSO</button>";
    header("Location:../index.php");   
}
if($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_SAFARI){
    header("Location:../index.php");
}
?>
<html>
<title>Giustificazione assenze</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
    <a href="giustificazione.php" class="w3-bar-item w3-button w3-padding-large w3-white"><< MODULI</a>
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
<header class="w3-container w3-center testata" style="padding:40px 16px">
  <h2 class="w3-margin w3-jumbo testata">Modulo </h2>
  <h4 >Motivi di salute, con condizioni sospette Covid-19 </h4>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
    <?php
    //include 'accessoDatabase.php';
    //$con= accesso();
    //$query= "SELECT * FROM login WHERE idUtente=".$_SESSION["idutente"];
    $passw= md5($_SESSION["password"]);
    $query= "SELECT * FROM login WHERE nomeutente=".$_SESSION["nomeutente"]." AND password='".$passw."'";
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
    <form name="nuovoPermesso" enctype="multipart/form-data" action="#" method="POST">    
        <div>
            <label>
                <!--<input type="radio" class="option-input radio" name='opzione' value="entrata" checked />-->
                <!--ENTRATA-->
            </label>
            <label>
              <input type="radio" class="option-input radio" name='opzione' value="condizioni_sospette" checked/>
             GIUSTIFICAZIONE
            </label>
            
        </div>
        
        
        
        <!--
        <input type='radio' name='opzione' value="entrata" checked> ENTRATA<br><br>
        <input type='radio' name='opzione' value="uscita" > USCITA<br><br>-->
        <!--<input type='radio' name='opzione' value="assenza" > ASSENZA<br><br>-->
        <div style="padding-top:2%">DATA DI INVIO: </div>
        <?php
        echo "<b>".date("d-m-y")."</b><br>";
    
        ?>
        
        <!--<div style="padding-top:2%">DATA DI INVIO <input type="date" name="data" placeholder="Data" required></div>
        <div></div>--><br>
        <p><input type="text" name="cognomenomegenitore" placeholder="Cognome e Nome del Genitore" readonly value="<?php echo $nomegenitore?>"></p>
        <?php
        $passw= md5($_SESSION["password"]);
        $query1= "SELECT * FROM login WHERE nomeutente=".$_SESSION["nomeutente"]." AND password='".$passw."'";
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
        <!--<p>NOTE<br><textarea name="note" rows="7" cols="40"></textarea></p>-->
        <br><br>
        <div style="font-size: 20px; color:red">Allegato 1 - Attestazione del pediatra/medico curante per rientro a scuola
        <a href="https://www.buonarroti.tn.it/images/20_21_fotovarie/Allegato1.pdf" target="_blank">(Download)</a></div>
        <hr>
        <br /><h3>Allegare il certificato (Allegato 1) </h3>
        E' possibile caricare un solo documento in formato PDF (dimensione MAX 4 Mb):<br><br>
        <input type="file" name="file_inviato"> 

        <p><input type="hidden" name="tipo" value="com"></p>
        <br><br>
        <p><button class="btn btn-black adatta_testo1" type="submit" name="invia"><b>INVIA</b> </button></p>       
    </form>
    <?php
    //include 'accessoDatabase.php';

    if(isset($_POST["invia"])){
        //$con= accesso();
        $tipo= $_POST["opzione"];
        //echo $tipo."<br>";

        $data= date("Y-m-d");//$_POST["data"];
        //echo $data."<br>";
        //$orauscita= $_POST["orauscita"];
        //echo $orauscita;
        $cognomenomegenitore= $_POST["cognomenomegenitore"];
        //echo $cognomenomegenitore."<br>";
        $luogonascita= "";
        $datanascita= "";
        $scuola= "";
        $nomedottore= "";
        $assenzadal= "";
        $assenzaal= "";
        
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
        $motivazione= "";//$_POST["motivazione"];
        //echo $motivazione."<br>";
        $note= "";//$_POST["note"];
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
            if($data>$data_domani){
                //echo "<div style=color:red>Non è possibile creare GIUSTIFICAZIONI nei giorni successivi a domani.</div>";
                //echo "<div style=color:red>Selezionare una DATA corretta.</div>";  
                $risposta= "Non è possibile creare GIUSTIFICAZIONI nei giorni successivi a domani. Selezionare una DATA corretta";
                echo "<script>alert('".$risposta."')</script>";
                echo "<div class='alert alert-danger'>
                        <strong>".$risposta."</strong> 
                        </div>";                             
            }  
            else{
                // se ci sono stati problemi nell'upload del file
	            if(!isset($_FILES['file_inviato']) OR $_FILES['file_inviato']['error'] != UPLOAD_ERR_OK){
                    //echo "<div style=color:red>Nessun FILE allegato. Selezionare un file pdf.</div>";                          
                    $risposta= "Nessun FILE allegato. Selezionare un file pdf";
                    echo "<script>alert('".$risposta."')</script>";
                    echo "<div class='alert alert-danger'>
                        <strong>".$risposta."</strong> 
                        </div>";  
                }
                else{
                    // recupero alcune informazioni sul file inviato
                    $nome_file_temporaneo = $_FILES['file_inviato']['tmp_name'];
                    //echo "ECCO: ".$nome_file_temporaneo;
	                $nome_file_vero = $_FILES['file_inviato']['name'];
                    $tipo_file = $_FILES['file_inviato']['type'];
                    
                    $ext_ok = array('pdf');
                    $temp = explode('.', $nome_file_vero);
                    $ext = end($temp);
                    if (!in_array($ext, $ext_ok)) {
                        //echo "Il file ha un'estensione non ammessa! Selezionare un file pdf.";
                        $risposta= "Il file ha un'estensione non ammessa! Selezionare un file pdf";
                        echo "<script>alert('".$risposta."')</script>";
                        echo "<div class='alert alert-danger'>
                        <strong>".$risposta."</strong> 
                        </div>";  
                        //exit;
                    }
                    else{
                        // limito la dimensione massima a 4MB
                        if ($_FILES['file_inviato']['size'] > 4194304) {
                            //echo 'Il file è troppo grande!';
                            $risposta= "Il file è troppo grande";
                            echo "<script>alert('".$risposta."')</script>";
                            echo "<div class='alert alert-danger'>
                            <strong>".$risposta."</strong> 
                            </div>";  
                        }
                        else{
	                        // leggo il contenuto del file
	                        $dati_file = file_get_contents($nome_file_temporaneo);

	                        // preparo il contenuto del file per la query
	                        $dati_file = addslashes($dati_file);
                            
                            salvaGiustificazione($con,$tipo,$data,$cognomenomegenitore,$luogonascita,$datanascita,$scuola,$nomedottore,$cognomenomestudente,$classe,$motivazione,$note,$fkUtente,$assenzadal,$assenzaal);                  
                            echo "<script>alert('INSERIMENTO AVVENUTO CON SUCCESSO')</script>";
                            echo "<div class='alert alert-success'>
                            <strong>Inserimento avvenuto con successo</strong> 
                            </div>";
                        }
                    }
                }
            }      
        }
        else{
            //echo "<div style=color:red>Non è possibile creare GIUSTIFICAZIONI nei giorni antecedenti al giorno corrente.</div>";
            //echo "<div style=color:red>Selezionare una DATA corretta.</div>";
            $risposta= "Non è possibile creare GIUSTIFICAZIONI nei giorni antecedenti al giorno corrente. Selezionare una DATA corretta";
            echo "<script>alert('".$risposta."')</script>";
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
    <i><img src="../immagini/logoscuola_icona.png" style="width:70px;height:auto"></i>
    
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