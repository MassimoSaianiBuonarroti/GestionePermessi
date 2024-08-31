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
    if(!isset($_SESSION["idutente"])){
        header("Location:../index.php");
    }
    // else
    //     if(($_SESSION["password"]=="12345678")){
    //         header("Location:cambiapasswordpa.php");
    //     }
        
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- CSS only -->
    <link href="../css/login_new.css" rel="stylesheet"  >
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="sidenav">
                    <div class="login-main-text">
                        <h2 class="w3-margin w3-jumbo"><img class="schermo_intero" src="../immagini/Buonarroti_Logo_Bianco.png" ></h2>
                        <br>
                        <h3 class="adatta_testo">PERMESSI DI USCITA </h3>
                        <p class="adatta_testo"><?php echo $_SESSION["anno_scolastico"];?></p>
                        <div class="adatta_testo"><b>Permessi di uscita:</b></div>
                        <div class="adatta_testo">dalle ore <?php echo $_SESSION["permessi_ora_inizio_stringa"];?> del giorno precedente alle ore <?php echo $_SESSION["permessi_ora_fine_stringa"];?> del giorno del permesso</div>
                        <br>
                        <div class="adatta_testo"><b>Credenziali:</b></div>
                        <div class="adatta_testo">Le credenziali di accesso sono le stesse del registro elettronico di Mastercom</div>
                        <!--<div class="adatta_testo"><b>Giustificazioni:</b></div> 
                        <div class="adatta_testo">dalle ore <?php echo $_SESSION["giustificazioni_ora_inizio_stringa"];?> alle ore <?php echo $_SESSION["giustificazioni_ora_fine_stringa"];?> <br>Per favorire il controllo della Segreteria Didattica e tutelare la salute di tutti, si prega di giustificare congiuntamente al rientro a scuola</div>-->
                        <br>
                        <div class="adatta_testo"><u>Ottimizzato per Google Chrome</u></div>
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
                            $ora= date("H:i");
                            //echo "<br>Sono le ore <b>".$ora."</b>";
                            //echo "Data di oggi: ".date("Y-m-d");
                            // Per ora legale: <7  >15 (estate)
                            // Per ora solare <8 >16 (inverno)
                            if( $browser->getBrowser() != Browser::BROWSER_IE && $browser->getBrowser() != Browser::BROWSER_SAFARI){
                                //07:00:00 - 15:00:00
                                if($ora<$_SESSION["permessi_ora_fine"] || $ora>$_SESSION["permessi_ora_inizio"]){
                                    echo "<br><br><button type='button' class='btn btn-danger btn-block' onclick=window.location.href='nuovoPermesso.php'>NUOVO PERMESSO</button>";
                                }
                                else{
                                    echo "<div style=color:red><br>IL PULSANTE DEI PERMESSI SI ABILITERA' DOPO LE ORE ". $_SESSION['permessi_ora_inizio_stringa']."</div>";
                                }
                            }
                            else{
                                echo "Il browser che si sta utilizzando non è aggiornato, si consiglia di usare Google Chrome per creare un permesso.";
                            }
                        ?>
                        <br><br>
                        <button type="button" class='btn btn-primary btn-block' onclick="window.location.href='storico.php'">STORICO PERMESSI</button>
                        <hr>
                        <?php
                        /*if( $browser->getBrowser() != Browser::BROWSER_IE && $browser->getBrowser() != Browser::BROWSER_SAFARI){
                                //07
                                if($ora<$_SESSION["giustificazioni_ora_fine"] || $ora>$_SESSION["giustificazioni_ora_inizio"]){
                                    echo "<button type='button' class='btn btn-danger btn-block' onclick=window.location.href='giustificazione.php'>GIUSTIFICAZIONE ASSENZE / ENTRATE</button>";
                                }
                                else{
                                    echo "<div style=color:red><br>IL PULSANTE DELLE GIUSTIFICAZIONI SI ABILITERA' DOPO LE ORE ".$_SESSION["giustificazioni_ora_inizio_stringa"] ."</div>";
                                }
                        }
                        else{
                                echo "Il browser che si sta utilizzando non è aggiornato, si consiglia di usare Google Chrome per creare un permesso.";
                        }*/
                        ?>
                        <!--<br><br>
                        <button type="button" class='btn btn-primary btn-block' onclick="window.location.href='storicogiustificazione.php'">STORICO GIUSTIFICAZIONI</button>-->
                        <hr>
                        <!-- <br><br>
                        <button type="button" class='btn btn-info btn-block' onclick="window.location.href='cambiapassword.php'">CAMBIA PASSWORD</button>
                        <br><br> -->
                        <button type="submit" class="btn btn-warning btn-block"  name="logout">LOGOUT</button>            
                        </form>
                        <?php
                            if(isset($_GET["logout"])){
                                session_destroy();
                                header("Location: ../index.php");
                                ob_flush();
                            }
                        ?>
                        <br>
                        <p style="font-size:14px">© 2024 ITT Buonarroti - Trento. Tutti i diritti riservati.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>