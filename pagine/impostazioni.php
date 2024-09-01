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
    $inizio = new DateTime($__settings->config->permessiOraInizio);
    $fine = new DateTime($__settings->config->permessiOraFine);

    if ($isDST == 0) // estate - sottraggo 2 ore
    {
      $inizio->sub (new DateInterval('PT2H'));
      $fine->sub(new DateInterval('PT2H'));
 
    }
    else // inverno - sottraggo 1 0ra
    {
      $inizio->sub(new DateInterval('PT1H'));
      $fine->sub(new DateInterval('PT1H'));
    }
  
    // memorizzo nelle variabili di sessione gli orari per i confronti necessari
    $_SESSION["permessi_ora_inizio"] = $inizio->format("H:i:s");
    $_SESSION["permessi_ora_fine"] = $fine->format("H:i:s");

?>