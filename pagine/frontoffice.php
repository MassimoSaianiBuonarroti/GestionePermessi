<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

session_start();

// se non è un utente loggato manda alla pagina iniziale

if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}

?>

<!DOCTYPE html>
<html>
<title>Permessi di uscita</title>
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

.button {
        border-collapse collapse;
        border-top-color rgb(221, 221, 221);
        border-top-style solid;
        border-top-width 1px;
        box-sizing border-box;
        color rgb(51, 51, 51);
        display table-cell;
        font-family Lato, sans-serif;
        font-size 14px;
        font-weight 700;
        height 64.5px;
        line-height 20px;
        padding-bottom 8px;
        padding-left 8px;
        padding-right 8px;
        padding-top 8px;
        text-align left;
        text-indent 0px;
        text-size-adjust 100%;
        background-color: white;
    }
</style>

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
    <form name="logout_admin" action="#" method="POST">
        <button class="w3-bar-item w3-button  w3-padding-large w3-white" type='submit' name='logoutadmin'>LOGOUT</button>
        <a class="w3-bar-item w3-button w3-padding-large w3-white" href="pannello_controllo.php">PANNELLO DI CONTROLLO</a>
    </form>
    <?php
    if(isset($_POST["logoutadmin"])){
        session_destroy();
        header("Location: ../index.php");
    }
    ?>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large">LOGOUT</a>
    <a href="pannello_controllo.php" class="w3-bar-item w3-button w3-padding-large">PANNELLO DI CONTROLLO</a>
    <!--<a href="nuovoPermesso.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Permesso</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large">Storico</a>
    <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large">Cambia Password</a>-->
    
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center testata" style="padding:70px 16px">
<!--style="padding:100px 16px">-->
  <h2 class="w3-margin w3-jumbo testata">FRONT OFFICE</h2>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">


<br>
<!-- SELEZIONA LA DATA-->
<div style="float:left; display:block; width:320px; height:100px;">
<form name="elencoData" action="#" method="POST"> 
    <div>SELEZIONA LA DATA:
    <span style="padding-top:2%"><input type="date" name="data" placeholder="Data"></span>
    </div>
    <button class="btn btn-danger" type="submit" name="ricercadata">RICERCA </button> 
</form>
</div>
<!-- ***************** -->

<!-- CHECKBOX VISUALIZZA TUTTI -->
<div style="float:left; display:block; width:350px; height:100px;">
<form name="visualizzaTutti" action="#" method="POST">
    <!--<div class="form-check">
    <input class="form-check-input" type="checkbox" name="visualizza_tutti" value="" id="flexCheckDefault" >
    <label class="form-check-label" for="flexCheckDefault">
        VISUALIZZA TUTTI I PERMESSI DEL GIORNO
    </label>
    </div>-->
    <button class="btn btn-primary" type="submit" name="visualizzaTutti">VISUALIZZA TUTTI I PERMESSI DEL GIORNO </button>
</form<>
</div>
<div style="clear:both;"></div>
<!-- ***************** -->

</div>
<?php

require_once 'accessoDatabase.php';
$con= accesso();
          
//SPUNTA PERMESSO 
if(isset($_POST["esito_fatto_no"])){   
    $idrigainfo= $_POST["idrigasel"];                                 
    $query= "UPDATE permesso SET fatto='si' WHERE idPermesso=$idrigainfo";  
    $result=mysqli_query($con,$query); 
} 
else{
    //echo "nooooooooooo";
}
if(isset($_POST["esito_fatto_si"])){   
    $idrigainfo= $_POST["idrigasel"];                                 
    $query= "UPDATE permesso SET fatto='no' WHERE idPermesso=$idrigainfo";  
    $result=mysqli_query($con,$query); 
} 
else{
    //echo "nooooooooooo";
}
//-------------------------------

//SALVA ANNOTAZIONE FRONTOFFICE NEL CAMPO "MOTIVAZIONE"
if(isset($_POST["annota_salva"])){   
    $idrigainfo= $_POST["idrigasel"];                                 
    $query= "UPDATE permesso SET motivazione='".$_POST['annota']."' WHERE idPermesso=$idrigainfo";  
    $result=mysqli_query($con,$query); 
} 
else{
    //echo "nooooooooooo";
}
//-------------------------------
            
            
//ELENCO DEI PERMESSI PER GENITORE           
/*$query= "SELECT * FROM permesso WHERE fkUtente=".$_SESSION['idutente']. " AND stato=0 ORDER BY data";
//echo $query;
$result=mysqli_query($con,$query);
$row1= mysqli_fetch_array($result);
echo "<div style='font-size:20px'><b>GENITORE:</b> <br><b style='color:red'>".$row1["cognomenomegenitore"]."</b></div><br>";
echo "<div style='font-size:20px'><b>STUDENTE:</b> <br><b style='color:red'>".$row1["cognomenomestudente"]."</b></div><br>";
echo "<div style='font-size:20px'><b>CLASSE:</b> <br><b style='color:red'>".$row1["classe"]."</b></div><br>";*/

if(isset($_POST["data"]) && $_POST["data"] != ""){
    $_SESSION["datascelta"]= $_POST["data"];
    unset($_SESSION["cosa"]);
}
else{
    //$_SESSION["datascelta"]= date("Y-m-d");
    //$_SESSION["cosa"]=="no";
}

//if(isset($_POST["ricercadata"])){
    //echo $_POST["ricerca"];
    //echo "SONO QUI";
    
    if(isset($_SESSION["datascelta"])){
        $data_corrente= $_SESSION["datascelta"];
        
    }
    else{
        $data_corrente= date("Y-m-d");
        //echo $data_corrente;
    }
    $data_corrente_esplosa= explode("-",$data_corrente); 
    $Y= $data_corrente_esplosa[0];
    $m= $data_corrente_esplosa[1];
    $d= $data_corrente_esplosa[2];
    $data_visualizzata= $d."-".$m."-".$Y;
    echo "<div style='font-size:30px'><b>RICHIESTE DI PERMESSO IN DATA: ".$data_visualizzata."</b></div>";
    
    if  ( (!isset($_SESSION["cosa"])) && (!isset($_POST["ordinaora"])) && (!isset($_POST["ordinaclasse"])) ) 
    {
        //echo "QUI";
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 AND fatto='no' ORDER BY data,classe";
        $result=mysqli_query($con,$query);
        echo "<div style='font-size:30px'><b>ORDINATE PER CLASSE"."</b></div>";

    }
    else{
        if ((isset($_SESSION["cosa"]) && ($_SESSION["cosa"]=="ordineClasse")) && (isset($_POST["ordinaclasse"])))
        {
            $query= "SELECT * FROM permesso WHERE data='" . $data_corrente. "' AND stato=0 AND fatto='no' ORDER BY data,classe";
        }
        else
        {
            $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 AND fatto='no' ORDER BY data,orauscita";
        }
        $result=mysqli_query($con,$query);
        //echo "<div style='font-size:30px'><b>ORDINATE PER ORA"."</b></div>";

    }

    //SPUNTA VISUALIZZA TUTTI
    if(isset($_POST["visualizzaTutti"])){  
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data,classe";
        $result=mysqli_query($con,$query);
    } 
    else{
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 AND fatto='no' ORDER BY data,classe";
        $result=mysqli_query($con,$query);
    }
    ?>

    <?php
    echo '<div style="overflow-x: auto;">';
    echo "<table class='table table-striped'>";
    echo "<th>STUDENTE</th><th><form name='ordinaClasse' action='#' method='POST'><button type='submit' name='ordinaclasse'>CLASSE</button></form></th><th><form name='ordinaClasse' action='#' method='POST'><button type='submit' name='ordinaora'>ORA</button></form></th><th>GENITORE</th><th>NOTE</th><th>ANNOTAZIONE - DOCENTE</th><th>FATTO</th>";
    if(isset($_POST["ordinaclasse"])){
        
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data,classe";
        $result=mysqli_query($con,$query);
        $_SESSION["cosa"]="ordinaclasse";
        echo "<div style='font-size:30px'><b>ORDINATE PER CLASSE"."</b></div>";
    }
    else
    if(isset($_POST["ordinaora"])){
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 AND fatto='no' ORDER BY data,orauscita";
        $result=mysqli_query($con,$query);
        $_SESSION["cosa"]="ordinaora";
        echo "<div style='font-size:30px'><b>ORDINATE PER ORA"."</b></div>";
    }
    else{
        //unset($_SESSION["cosa"]);
    }
    
    while($row= mysqli_fetch_array($result)){
        echo "<tr>";                              
        //echo "<td>";
        //echo $row["idUtente"];                              
        //echo "</td>";
        echo "<td>";
        // Creo una array dividendo la data YYYY-MM-DD sulla base del trattino
        //$array = explode("-", $row["data"]); 
        // Riorganizzo gli elementi in stile DD/MM/YYYY
        //$data_it = $array[2]."/".$array[1]."/".$array[0]; 
        echo $row["cognomenomestudente"];
        echo "</td>";
        echo "<td>";
        echo $row["classe"];                              
        echo "</td>";
        echo "<td>";
        echo $row["orauscita"];                              
        echo "</td>";
        //echo "<td>";
        //echo $row["motivazione"];                              
        //echo "</td>";
        /*echo "<td>";
        echo $row["cognomenomegenitore"];                              
        echo "</td>";
        echo "<td>";
        echo $row["cognomenomestudente"];                              
        echo "</td>";
        echo "<td>";
        echo $row["classe"];                              
        echo "</td>";*/
        echo "<td>";
        echo $row["cognomenomegenitore"];                              
        echo "</td>";
        echo "<td>";
        echo $row["note"];                              
        echo "</td>";   

        echo "<form name='annotazione' action='#' method='POST'>";  
        echo "<td style='text-align:center'>"; 
        echo "<input type='hidden' name='idrigasel' value='".$row["idPermesso"]."'>";
        //echo "<input type='hidden' name='datarigaannulla' value='".$row["data"]."'>";                             
        echo "<span style='float:left;'><input type='text' size='25' name='annota' value='".$row["motivazione"]."'></span>";                          
        echo "<span style='float:left;'><button class='btn btn-danger' type='submit' name='annota_salva'><i class='fa fa-save'></i></button></span>";
        echo "</td>";                
        echo "</form>";


        echo "<form name='fatto' action='#' method='POST'>";  
        echo "<td style='text-align:center'>"; 
        echo "<input type='hidden' name='idrigasel' value='".$row["idPermesso"]."'>";
        //echo "<input type='hidden' name='datarigaannulla' value='".$row["data"]."'>";                             
        if($row["fatto"]=="no")
            echo "<button class='btn btn-danger' type='submit' name='esito_fatto_no'></button>";                          
        else
            echo "<button class='btn btn-success' type='submit' name='esito_fatto_si'></button>";                          

        echo "</td>";                
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    
//}

    ?>
    </div>
    


    


    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
    <div class="w3-xlarge w3-padding-32">
        <i><img src="../immagini/<?php echo $__settings->config->imgLogoQuadrato?>"  style="width:70px;height:auto"></i>
        
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
