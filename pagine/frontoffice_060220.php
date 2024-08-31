<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
else
    if(($_SESSION["password"]=="12345678")){
        header("Location:cambiapasswordpa.php");
    }
    
if($_SESSION["nomeutente"] != "201800" && $_SESSION["password"] != "Staff2019"){
    header("Location:../index.php");
}
?>
<html>
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
    <form name="logout_admin" action="#" method="POST">
        <!--<a href="../index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Logout</a>-->
        <button class="w3-bar-item w3-button  w3-padding-large w3-white" type='submit' name='logoutadmin'>LOGOUT</button>
    </form>
    <?php
    if(isset($_POST["logoutadmin"])){
        session_destroy();
        header("Location: ../index.php");
    }
    ?>
    <!--<form name="creapdf" action="../creaPdf.php" method="POST">-->
    <a href="../creaPdf.php" target="_new" class="w3-bar-item w3-button w3-padding-large w3-white">CREA PDF</a>
    <!--<button class="w3-bar-item w3-button w3-white" type='submit' name='creapdf1'>CREA PDF</button>-->
    <!--</form>-->
   
    
    <!--<a href="elencomastercompleto.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Elenco</a>

    <a href="nuovoCommerciale.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo Commerciale</a>
    <a href="nuovoPuntoVendita.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Nuovo PVR</a>
    <a href="elencomaster.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Cerca</a>-->
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large">Logout</a>
    <a href="../creaPdf.php" target="_new" class="w3-bar-item w3-button w3-padding-large">CREA PDF</a>
    <!--<a href="nuovoPermesso.php" class="w3-bar-item w3-button w3-padding-large">Nuovo Permesso</a>
    <a href="storico.php" class="w3-bar-item w3-button w3-padding-large">Storico</a>
    <a href="cambiapassword.php" class="w3-bar-item w3-button w3-padding-large">Cambia Password</a>-->
    
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:100px 16px">
  <h2 class="w3-margin w3-jumbo">FRONT OFFICE</h2>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">


<br>
<!-- SELEZIONA LA DATA-->

<form name="elencoData" action="#" method="POST"> 
    <div>SELEZIONA LA DATA:
    <span style="padding-top:2%"><input type="date" name="data" placeholder="Data"></span>
    </div>
    <div style="margin-right:75%"><button class="btn btn-danger" type="submit" name="ricercadata">RICERCA </button></div> 
</form>
<!-- ***************** -->
<?php
include 'accessoDatabase.php';
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
    
    if(!isset($_SESSION["cosa"])){
        //echo "QUI";
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data,classe";
        $result=mysqli_query($con,$query);
        echo "<div style='font-size:30px'><b>ORDINATE PER CLASSE"."</b></div>";

    }
    else{
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data,orauscita";
        $result=mysqli_query($con,$query);
        //echo "<div style='font-size:30px'><b>ORDINATE PER ORA"."</b></div>";

    }
    
    echo '<div style="overflow-x: auto;">';
    echo "<table class='table table-striped'>";
    echo "<th>STUDENTE</th><th>CLASSE</th><th><form name='ordinaClasse' class='btn btn-link' action='#' method='POST'><button type='submit' class='btn btn-link' name='ordinaora'>ORA</button></form></th><th>GENITORE</th><th>NOTE</th><th>FATTO</th>";
    /*if(isset($_POST["ordinaclasse"])){
        
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data,classe";
        $result=mysqli_query($con,$query);
    }*/
    if(isset($_POST["ordinaora"])){
        $query= "SELECT * FROM permesso WHERE data='".$data_corrente. "' AND stato=0 ORDER BY data,orauscita";
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
        <i><img src="../immagini/logoscuola_icona.png" style="width:90px;height:45px"></i>
        
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
