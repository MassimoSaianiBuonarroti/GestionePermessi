<html>
<head>
    <?php
    ob_start (); 
    session_start();
    include "impostazioni.php";

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
    if (!($ora<$_SESSION["giustificazioni_ora_fine"] || $ora>$_SESSION["giustificazioni_ora_inizio"])){
        header("Location:../index.php");   
    }
    if($browser->getBrowser() == Browser::BROWSER_IE || $browser->getBrowser() == Browser::BROWSER_SAFARI){
        header("Location:../index.php");
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- CSS only -->
    <link href="../css/login_new.css" rel="stylesheet"  >
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <title>Giustificazioni</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="sidenav">
                    <div class="login-main-text">
                        <h2 class="w3-margin w3-jumbo"><img class="schermo_intero" src="../immagini/Buonarroti_Logo_Bianco.png" ></h2>
                        <br>
                        <h3 class="adatta_testo">PERMESSI DI USCITA E GIUSTIFICAZIONE ASSENZE</h3>
                        <p class="adatta_testo"><?php echo $_SESSION["anno_scolastico"];?></p>
                        <div class="adatta_testo"><b>Permessi di uscita:</b></div>
                        <div class="adatta_testo">dalle ore <?php echo $_SESSION["permessi_ora_inizio_stringa"];?> del giorno precedente alle ore <?php echo $_SESSION["permessi_ora_fine_stringa"];?> del giorno del permesso</div>
                        <br>
                        <div class="adatta_testo"><b>Giustificazioni:</b></div> 
                        <div class="adatta_testo">dalle ore <?php echo $_SESSION["giustificazioni_ora_inizio_stringa"];?> alle ore <?php echo $_SESSION["giustificazioni_ora_fine_stringa"];?> <br>Per favorire il controllo della Segreteria Didattica e tutelare la salute di tutti, si prega di giustificare congiuntamente al rientro a scuola</div>
                        <br>
                        <div class="adatta_testo"><u>Ottimizzato per Google Chrome</u></div>
                        <br><button type='button' style='font-size:20px' class='btn btn-default btn-block' onclick='window.location.href="../index.php"'>HOME</button>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main">      
                    <div class="login-form adatta_testo">
                        <form name="modulo" action="#" method="GET" >
                            <?php
                            //echo $_SESSION["idutente"];
                            //include 'accessoDatabase.php';
                            //$con= accesso();
                            $query= "SELECT * FROM login WHERE idUtente=".$_SESSION["idutente"];
                            $result=mysqli_query($con,$query);   
                            if(mysqli_num_rows($result)>0){
                                $row= mysqli_fetch_array($result);
                                $nomegenitore= $row["cognome_genitore"]." ".$row["nome_genitore"];
                            }
                            
                            echo "<h4>Benvenuto <b>".$nomegenitore."</b></h4>";
                            echo "<br><h4>GIUSTIFICAZIONE PER MOTIVI DI SALUTE CON CONDIZIONI:</h4>";
                            $ora= date("H:i");
            
                            echo "<br><br><button type='button' class='btn btn-danger btn-block' onclick=window.location.href='modulo_sospetto.php'>Sospette Covid-19</button>";
                            echo "<br><br><button type='button' class='btn btn-primary btn-block' onclick=window.location.href='modulo_non_sospetto_minore3.php'>NON sospette Covid-19</button>";
                            echo "<br><br><button type='button' class='btn btn-primary btn-block' onclick=window.location.href='modulo_non_sospetto_maggiore3.php'>NON sospette Covid-19 superiore a 3 giorni</button>";
                            echo "<br><br><button type='button' class='btn btn-secondary btn-block' onclick=window.location.href='modulo_motivi_personali_maggiore3.php'>Motivi personali</button>";
                            echo "<br><br><button type='button' class='btn btn-info btn-block' onclick=window.location.href='modulo_entrata_ritardo.php'>Giustificazione entrata in ritardo</button>";
                            ?>      
                        </form>    
                        <br>
                        <p style="font-size:14px">© 2024 ITT Buonarroti - Trento. Tutti i diritti riservati.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>