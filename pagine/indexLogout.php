<?php
ob_start();
session_start();

require_once 'load_settings.php';
require_once 'impostazioni.php';
require_once '../version.php';

require_once 'accessoDatabase.php';
$con = accesso();

require_once('browser.php');
$browser = new Browser();

if (!isset($_SESSION["loggato"])) {
    header("Location:../index.php");
}
if (!isset($_SESSION["idutente"])) {
    header("Location:../index.php");
}

if (isset($_SESSION["ruolo"])) {
    $ruolo = $_SESSION["ruolo"];
    if ($ruolo != "genitore")
        header("Location:../index.php");
} else {
    header("Location:../index.php");
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- CSS only -->
    <link href="../css/login_new.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../immagini/favicon.ico">
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
                        <h2 class="w3-margin w3-jumbo"><img class="schermo_intero"
                                src="../immagini/<?php echo $__settings->config->imgLogo ?>"></h2>
                        <br>
                        <h3 class="adatta_testo">PERMESSI DI USCITA </h3>
                        <p class="adatta_testo"><?php echo $_SESSION["anno_scolastico"]; ?></p>
                        <div class="adatta_testo"><b>Permessi di uscita:</b></div>
                        <div class="adatta_testo">dalle ore <?php echo $_SESSION["permessi_ora_inizio_stringa"]; ?> del
                            giorno precedente alle ore <?php echo $_SESSION["permessi_ora_fine_stringa"]; ?> del giorno
                            del permesso</div>
                        <br>
                        <div class="adatta_testo"><b>Credenziali:</b></div>
                        <?php
                        if ($__settings->config->credenzialiMastercom == true) {
                            echo '<div class="adatta_testo">Le credenziali di accesso sono le stesse del registro elettronico di Mastercom</div>';
                        }
                        ?>
                        <br>
                        <div class="adatta_testo"><u>Ottimizzato per Google Chrome</u></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main">
                    <div class="login-form adatta_testo">
                        <form name="modulo" action="#" method="GET">
                            <?php
                            $query = "SELECT * FROM login WHERE idUtente=" . $_SESSION["idutente"];
                            //echo "<h1>".$query."</h1>";
                            
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_array($result);
                                $nomegenitore = $row["cognome_genitore"] . " " . $row["nome_genitore"];
                            }
                            echo "<h4>Benvenuto <b>" . $nomegenitore . "</b></h4>";
                            date_default_timezone_set("Europe/Rome");
                            $ora = date("H:i");

                            if ($browser->getBrowser() != Browser::BROWSER_IE && $browser->getBrowser() != Browser::BROWSER_SAFARI) {
                                //09:00:00 - 15:00:00
                                if ($__settings->config->limitaOrarioPermessi == true) {
                                    if ($ora < $_SESSION["permessi_ora_fine"] || $ora > $_SESSION["permessi_ora_inizio"]) {
                                        echo "<br><br><button type='button' class='btn btn-danger btn-block' onclick=window.location.href='nuovoPermesso.php'>NUOVO PERMESSO</button>";
                                    } else {
                                        echo "<div style=color:red><br>IL PULSANTE DEI PERMESSI SI ABILITERA' DOPO LE ORE " . $_SESSION['permessi_ora_inizio_stringa'] . "</div>";
                                    }
                                } else {
                                    echo "<br><br><button type='button' class='btn btn-danger btn-block' onclick=window.location.href='nuovoPermesso.php'>NUOVO PERMESSO</button>";
                                }
                            } else {
                                echo "Il browser che si sta utilizzando non è aggiornato, si consiglia di usare Google Chrome per creare un permesso.";
                            }
                            ?>
                            <br><br>
                            <button type="button" class='btn btn-primary btn-block'
                                onclick="window.location.href='storico.php'">STORICO PERMESSI</button>

                            <?php
                            ?>
                            <br><br>
                            <?php
                            if ($__settings->config->credenzialiMastercom == false) {
                                echo '<button type="button" class="btn btn-info btn-block" onclick="window.location.href=\'cambiapassword.php\'">CAMBIA PASSWORD</button><br><br> ';
                            }
                            ?>

                            <button type="submit" class="btn btn-warning btn-block" name="logout">LOGOUT</button>
                        </form>
                        <?php
                        if (isset($_GET["logout"])) {
                            session_destroy();
                            header("Location: ../index.php");
                            ob_flush();
                        }
                        ?>
                        <br>
                        <br>
                        <p style="font-size:14px"><strong><?php echo $__software_copyright ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>