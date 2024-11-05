<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */


if (!isset($connect)) {
   // per qualche ragione se includo load_settings.php poi non visualizza la riga dopo un update del record
   // require_once __DIR__ . '/load_settings.php';
   $json = file_get_contents(__DIR__ . '/../GestionePermessi.json');
   $__settings = json_decode($json);

   $dbHost = $__settings->db->host;
   $dbName= $__settings->db->database;
   $dbUser= $__settings->db->user;
   $dbPassword= $__settings->db->password;

   $connect = new PDO("mysql:host=".$dbHost.";dbname=".$dbName, $dbUser, $dbPassword);
}

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET') {
   $data = array(
      ':cognome'   => "%" . $_GET['cognome'] . "%",
      ':nome'   => "%" . $_GET['nome'] . "%",
      ':nomeutente'   => "%" . $_GET['nomeutente'] . "%",
      ':classe'   => "%" . $_GET['classe'] . "%"
      );
   $query = "SELECT * FROM login WHERE cognome LIKE :cognome AND nome LIKE :nome AND nomeutente LIKE :nomeutente AND classe LIKE :classe ORDER BY classe ASC, cognome ASC, nome ASC";
   $statement = $connect->prepare($query);
   $statement->execute($data);

   $result = $statement->fetchAll();
   foreach($result as $row) {
      $output[] = array(
         'idUtente'    => $row['idUtente'],   
         'cognome'  => $row['cognome'],
         'nome'   => $row['nome'],
         'cognome_genitore'   => $row['cognome_genitore'],
         'nome_genitore'   => $row['nome_genitore'],
         'nomeutente'   => $row['nomeutente'],
         'classe'   => $row['classe']
      );
   }
   header("Content-Type: application/json");
   echo json_encode($output);
}

if($method == "POST") {
   $data = array(
      ':cognome'  => $_POST['cognome'],
      ':nome'  => $_POST["nome"],
      ':cognome_genitore'  => $_POST['cognome_genitore'],
      ':nome_genitore'  => $_POST["nome_genitore"],
      ':nomeutente'    => $_POST["nomeutente"],
      ':classe'   => $_POST["classe"]
   );
   $query = "INSERT INTO login (cognome, nome, cognome_genitore, nome_genitore, nomeutente, classe) VALUES (:cognome, :nome, :cognome_genitore, :nome_genitore, :nomeutente, :classe)";
   $statement = $connect->prepare($query);
   $statement->execute($data);
}

if($method == 'PUT') {
   parse_str(file_get_contents("php://input"), $_PUT);
   $data = array(
      ':idUtente'   => $_PUT['idUtente'],
      ':cognome' => $_PUT['cognome'],
      ':nome' => $_PUT['nome'],
      ':cognome_genitore' => $_PUT['cognome_genitore'],
      ':nome_genitore' => $_PUT['nome_genitore'],
      ':nomeutente'   => $_PUT['nomeutente'],
      ':classe'  => $_PUT['classe']
   );
   $query = "UPDATE login SET cognome = :cognome, nome = :nome, cognome_genitore = :cognome_genitore, nome_genitore = :nome_genitore, nomeutente = :nomeutente, classe = :classe WHERE idUtente = :idUtente";
   $statement = $connect->prepare($query);
   $statement->execute($data);
}

if($method == "DELETE") {
   parse_str(file_get_contents("php://input"), $_DELETE);
   $query = "DELETE FROM login WHERE idUtente = '".$_DELETE["idUtente"]."'";
   $statement = $connect->prepare($query);
   $statement->execute();
}

?>
