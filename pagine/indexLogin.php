<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

session_start();

require_once 'load_settings.php';
require_once 'impostazioni.php';
require_once '../version.php';

global $settings;

?>

<html>
<head>
    <?php

    if(isset($_SESSION["loggato"])){
        if($_SESSION["loggato"]=="no"){
            unset($_SESSION["loggato"]);
        }
    }
    $_SESSION["loggato"]= "no";
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../css/login_new.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../immagini/favicon.ico">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="sidenav">
                    <div class="login-main-text">
                        <h2 class="w3-margin w3-jumbo"><img class="schermo_intero" src="../immagini/<?php echo $__settings->config->imgLogo?>" ></h2>
                        <br>
                        <h3 class="adatta_testo">PERMESSI DI USCITA</h3>
                        
                        <p class="adatta_testo"><?php echo $_SESSION["anno_scolastico"];?></p>
                        <div class="adatta_testo"><b>Permessi di uscita:</b></div>
                        <div class="adatta_testo">dalle ore <?php echo $_SESSION["permessi_ora_inizio_stringa"];?> del giorno precedente alle ore <?php echo $_SESSION["permessi_ora_fine_stringa"];?> del giorno del permesso</div>
                        <br>
                        <div class="adatta_testo"><b>Credenziali:</b></div>
                        <?php
                        if ($__settings->config->credenzialiMastercom == true)
                        {
                            echo '<div class="adatta_testo">' . $__settings->config->credenzialiMessageMastercom . '</div>';
                        }
                        else
                        {
                            echo '<div class="adatta_testo">' . $__settings->config->credenzialiMessage . '</div>';
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
                        <form name="modulo" action="controlloLogin.php" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control adatta_testo1" name="nomeutente" placeholder=" Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control adatta_testo1" name="password" placeholder="Enter Password" required>
                            </div>
                            <button type="submit" class="btn btn-black adatta_testo1">Login</button>
                        </form>
                        <br>
                        <?php 
                        if (isset($_GET['err'])) 
                        {
                            if (($_GET['err']) == "nouser")
                            {
                                echo '<b><p style="color:blue;font-size:16px">Le credenziali immesse non sono valide</p></b>';
                            }
                            if (($_GET['err']) == "nouserdb")
                            {
                                echo '<b><p style="color:blue;font-size:16px">IL suo account non è presente nell"elenco dei genitori. Avvisare la segreteria</p></b>';
                            }
                            if (($_GET['err']) == "errmastercom")
                            {
                                echo '<b><p style="color:blue;font-size:16px">Problema di collegamento con Mastercom</p></b>';
                            }
                        }
                        ?>
                        <br>
                        <b><p style="color:red;font-size:20px"><?php echo $__settings->config->genericMessage ?></p></b>
                        <br><br>
                        <div>Dimenticata la password?</div>
                        <div>Inviare una email a <b><a href="mailto:<?php echo $__settings->config->refEmail ?>"><?php echo $__settings->config->refEmail ?></a></b></div>
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