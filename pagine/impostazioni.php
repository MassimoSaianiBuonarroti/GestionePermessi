<?php

    //    Per modificare il testo visualizzato sulla homepage.
    global $__settings;

    $_SESSION["anno_scolastico"]= $__settings->config->annoScolastico;
    $_SESSION["permessi_ora_inizio_stringa"]= $__settings->config->permessiOraInizio;
    $_SESSION["permessi_ora_fine_stringa"]= $__settings->config->permessiOraFine;
    $_SESSION["limita_orario_permessi"]= $__settings->config->limitaOrarioPermessi;
 
    // Crea data ed ora attuale
    $dateTime = new DateTime("");

    // Verifica se è DST
    $isDST = $dateTime->format("I");

    // 0 ora legale (Estate)
    // 1 ora solare (Inverno)

    // memorizza i parametri previsti nel JSON
    date_default_timezone_set("Europe/Rome");
    $inizio = new DateTime($__settings->config->permessiOraInizio);
    $fine = new DateTime($__settings->config->permessiOraFine);

    // memorizzo nelle variabili di sessione gli orari per i confronti necessari
                           
    $_SESSION["permessi_ora_inizio"] = $inizio->format("H:i:s");
    $_SESSION["permessi_ora_fine"] = $fine->format("H:i:s");

?>