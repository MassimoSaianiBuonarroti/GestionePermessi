<?php

require_once 'accessoDatabase.php';
$con = accesso();

    /*
    Per modificare il testo visualizzato sulla homepage.
    */
    $_SESSION["anno_scolastico"]= $__settings->config->annoScolastico;
    $_SESSION["permessi_ora_inizio_stringa"]= $__settings->config->permessiOraInizio;
    $_SESSION["permessi_ora_fine_stringa"]= $__settings->config->permessiOraFine;
    $_SESSION["limita_orario_permessi"]= $__settings->config->limitaOrarioPermessi;
 
    // Create a DateTime object for a specific date and time
    $dateTime = new DateTime("");
    echo "ora attuale " . $dateTime->format('Y-m-d H:i:s');

    // Check Daylight Saving Time
    $isDST = $dateTime->format("I");
//    echo "dst " . $isDST;

    // 0 ora legale (Estate)
    // 1 ora solare (Inverno)

    $inizio = new DateTime($__settings->config->permessiOraInizio);
//    echo $inizio->format('Y-m-d H:i:s');
    $fine = new DateTime($__settings->config->permessiOraFine);
//    echo $fine->format('Y-m-d H:i:s');

    if ($isDST == 0)
    {
      $inizio->sub (new DateInterval('PT2H'));
//      echo $inizio->format('Y-m-d H:i:s');
      $fine->sub(new DateInterval('PT2H'));
//      echo $fine->format('Y-m-d H:i:s');  
    }
    else
    {
      $inizio->sub(new DateInterval('PT1H'));
//      echo $inizio->format('Y-m-d H:i:s');
      $fine->sub(new DateInterval('PT1H'));
//      echo $fine->format('Y-m-d H:i:s');  
    }
  
    $_SESSION["permessi_ora_inizio"] = $inizio->format("H:i");
    $_SESSION["permessi_ora_fine"] = $fine->format("H:i");
//    echo $inizio->format("H:i");
//    echo $fine->format("H:i");
    $ora= date("H:i");
    if ( $ora<$_SESSION["permessi_ora_fine"] || $ora>$_SESSION["permessi_ora_inizio"] )
    {
        echo "permessi abilitati.";
    }
    else
    {
        echo "permessi non abilitati.";
    }

?>