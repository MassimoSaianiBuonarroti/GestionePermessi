<?php

require_once 'accessoDatabase.php';
$con = accesso();

    /*
    Per modificare il testo visualizzato sulla homepage.
    */
    $_SESSION["anno_scolastico"]= $__settings->config->anno_scolastico;
    $_SESSION["permessi_ora_inizio_stringa"]= $__settings->config->permessiOraInizio;
    $_SESSION["permessi_ora_fine_stringa"]= $__settings->config->permessiOraFine;
    $_SESSION["limita_orario_permessi"]= $__settings->config->limitaOrarioPermessi;
 
    // Create a DateTime object for a specific date and time
    $dateTime = new DateTime("");
    echo $dateTime->format('Y-m-d H:i:s');

    // Check Daylight Saving Time
    $isDST = $dateTime->format("I");
    echo $isDST;

    // 1 ora legale (Estate)
    // 0 ora solare (Inverno)

    if ($isDST == 1)
    {
      $inizio = new DateTime($__settings->config->permessiOraInizio);
      echo $inizio->format('Y-m-d H:i:s');
      $fine = new DateTime($__settings->config->permessiOraFine);
      echo $fine->format('Y-m-d H:i:s');
      $inizio->add(new DateInterval('PT1H'));
      echo $inizio->format('Y-m-d H:i:s');
      $fine->add(new DateInterval('PT1H'));
      echo $fine->format('Y-m-d H:i:s');
  
      $_SESSION["permessi_ora_inizio"] = $inizio->format("H:i");
      $_SESSION["permessi_ora_fine"] = $fine->format("H:i");
      echo $inizio->format("H:i");
      echo $fine->format("H:i");
    }

?>