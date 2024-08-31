<?php
include 'accessoDatabase.php';
$con= accesso();
$stringa= "SELECT * FROM impostazioni";
$result= mysqli_query($con,$stringa);
if(mysqli_num_rows($result)>0){
    $row= mysqli_fetch_array($result);
    /*
    Per modificare il testo visualizzato sulla homepage.
    */
    $_SESSION["anno_scolastico"]= "a.s. 2024/2025";//$row["anno_scolastico"];
    $_SESSION["permessi_ora_inizio_stringa"]= "17:00";//($row["permessi_ora_inizio"]+2);
    $_SESSION["permessi_ora_fine_stringa"]= "9:00";//$row["permessi_ora_fine"]+2;
    $_SESSION["giustificazioni_ora_inizio_stringa"]= "17:00";//($row["giustificazioni_ora_inizio"]+2);
    $_SESSION["giustificazioni_ora_fine_stringa"]= "7:00";//$row["giustificazioni_ora_fine"]+2;
    
    //Dati per i controlli PERMESSI
    /*
    Per ora legale: <7 >15 (estate)
    Per ora solare <8  >16 (inverno)
    
    Rispettare il formato dell'orario
    */
    $_SESSION["permessi_ora_inizio"]= "15:00:00";//$row["permessi_ora_inizio"];
    $_SESSION["permessi_ora_fine"]= "07:00:00";//$row["permessi_ora_fine"];
    
    //Dati per i controlli GIUSTIFICAZIONI
    /*
    Per ora legale: <5 >15 (estate)
    Per ora solare <6  >16 (inverno)
    */
    
    $_SESSION["giustificazioni_ora_inizio"]= "15:00:00";//$row["giustificazioni_ora_inizio"];
    $_SESSION["giustificazioni_ora_fine"]= "05:00:00";//06//$row["giustificazioni_ora_fine"];
}
?>