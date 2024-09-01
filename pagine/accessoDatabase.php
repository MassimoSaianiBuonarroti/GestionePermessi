<?php

require_once __DIR__ . '/load_settings.php';

//funzioner per connettersi al database
function accesso(){

global $__settings;

$dbHost = $__settings->db->host;
$dbName= $__settings->db->database;
$dbUser= $__settings->db->user;
$dbPassword= $__settings->db->password;

$connessione= mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if(!$connessione){
    die("Connessione fallita: ".mysqli_error($connessione));
}
return $connessione;
}

//FUNZIONE CHE SALVA IL PERMESSO
function salvaPermesso($con,$tipo,$data,$orauscita,$cognomenomegenitore,$cognomenomestudente,$classe,$motivazione,$fkUtente){ 
    //Preparated Statement
    // prepare and bind
    $stmt = $con->prepare("INSERT INTO permesso(tipo,data,orauscita,cognomenomegenitore,cognomenomestudente,classe,motivazione,fkUtente,stato) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssii", $tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$fkUtente1,$stato1);

    // set parameters and execute
    $tipo1= $tipo;
    $data1= $data;
    $orauscita1= $orauscita;
    $cognomenomegenitore1= $cognomenomegenitore;
    $cognomenomestudente1= $cognomenomestudente;
    $classe1= $classe;
    $motivazione1= $motivazione;
    $fkUtente1= $fkUtente;
    $stato1= 0;
    $stmt->execute();
    //--------------------
    //echo "INSERIMENTO AVVENUTO CON SUCCESSO";
    /*if (invioEmail($tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$note1)== true){
        header("Location: email_esitoPositivo.php");      
    }
    else{
        header("Location: email_esitoNegativo.php");
    }*/
     
    //header("Location: indexLogout.php");  
}

function modificaPassword($con,$nuovapassword,$nuovapassword_ripeti,$fkUtente){
    //Preparated Statement
    // prepare and bind
    $stmt = $con->prepare("UPDATE login SET password=?,cambiata=? WHERE nomeutente=?");
    $stmt->bind_param("ssi", $nuovapassword1,$cambiata,$fkUtente1);
    // set parameters and execute
    $nuovapassword1= md5($nuovapassword);
    $cambiata= "si";
    $fkUtente1= $fkUtente;
    $stmt->execute();
    //--------------------
    return true;  
    //header("Location: elencomastercompleto.php");  
}

?>
