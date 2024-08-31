<?php 
// connessione e selezione del database
include "accessoDatabase.php";
$con= accesso();
// query per recuperare il file
$id= 35;
$query = 'SELECT * FROM giustificazione WHERE idGiustificazione = '.$id;
//echo $query;
$risultato = mysqli_query($con,$query) or die('Query non valida: ' . mysqli_error($con));

$tmp = mysqli_fetch_array($risultato);


// invio una intestazione contenente il tipo MIME
header('Content-Type: '.$tmp['tipo_file']);

// invio il contenuto del file
echo $tmp['dati_file'];

//header("Content-Type: application/octet-stream");
//header("Content-Disposition: attachment; filename=\"$tmp[nome_file]\"");



?>