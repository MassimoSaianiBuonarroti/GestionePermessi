<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

session_start();

global $__settings;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    require_once 'accessoDatabase.php';
    
    $con= accesso();

    // se l'utente è già connesso

    if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si")
    {
        $username= $_SESSION["nomeutente"];
        $password= $_SESSION["password"];
        $ruolo =  $_SESSION["ruolo"];

        if ($ruolo == "admin") // se è admin va al frontoffice
        {
            header("Location:frontoffice.php");
        }
        else // se è un genitore vai alla pagina del genitore
        {
            header("Location:indexLogout.php");
        }
    }
    
    else
    // se l'utente non è connesso

    {
        // prendo i dati dalla form di login

        $username= $_POST["nomeutente"];
        $password= $_POST["password"];

        // verifico se esiste un utente admin con qs credenziali

        $esiste_utente= esiste_utente($username,$password, $con);

        // esiste un utente con un id>0

        if($esiste_utente>0) // esiste utente admin
        {           
            $_SESSION["nomeutente"]= $username;//$username;
            $_SESSION["password"]=$password;
            $_SESSION["loggato"]= "si";
            $_SESSION["idutente"]= $esiste_utente;
            $_SESSION["ruolo"]= "admin";
            header("Location:frontoffice.php");
        }
        
        // se non è un admin controllo se è un genitore

        if ($__settings->config->credenzialiMastercom == true)
        // se Mastercom è abilitato
        {
            // verifico se il nome utente esiste nel database
            $esiste_login= esiste_login($username,$password, $con, false);
        
            if($esiste_login>0)
            {

                $curl = curl_init();
            
                curl_setopt_array($curl, [
                CURLOPT_URL => "https://buonarroti-tn.registroelettronico.com/mastercom/register_manager.php?form_user=" . $username . "&form_password=" . $password,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_COOKIE => "PHPSESSID=b8gdo8db857lfrjrdnu8pmtt16",
                CURLOPT_HTTPHEADER => [
                    "User-Agent: insomnia/9.2.0"
                ],
                ]);
            
                $response = curl_exec($curl);
                $err = curl_error($curl);
            
                curl_close($curl);
            
                if ($err) 
                // c'è stato un errore nella richiesta
                {
                        $_SESSION["loggato"]= "no";
                        header("Location:../index.php");
                } 
                else 
                {
                    $array = json_decode($response, true);
                    if ($array["auth"] == false)
                    // autenticazione KO
                    {
                        $_SESSION["loggato"]= "no";
                        header("Location: ../index.php");
                    }
                    else
                    // autenticazione OK
                    {
                        $_SESSION["nomeutente"]= $username;//$username;
                        $_SESSION["password"]=$password;
                        $_SESSION["loggato"]= "si";
                        $_SESSION["idutente"]= $esiste_login;
                        $_SESSION["ruolo"]= "genitore";
                        header("Location: indexLogout.php");
                    }
                }
            } 
            else
            // non esiste username nel database
            {
                $_SESSION["loggato"]= "no";
                header("Location: ../index.php");
            }   
        }
        else
        // Mastercom non è attivo - usiamo la password del database
        {
            // verifico se il nome utente esiste nel database
            $esiste_login= esiste_login($username,$password, $con, true);
        
            if($esiste_login>0)
            {
                $_SESSION["nomeutente"]= $username;//$username;
                $_SESSION["password"]=$password;
                $_SESSION["loggato"]= "si";
                $_SESSION["idutente"]= $esiste_login;
                $_SESSION["ruolo"]= "genitore";
                header("Location: indexLogout.php");
            }
            else
            // non esiste username nel database o password sbagliata
            {
                $_SESSION["loggato"]= "no";
                header("Location: ../index.php");
            }   
        }
    }
}
else
// se viene richiamata direttamente la pagina rimando l'utente alla pagina iniziale
{
  header("Location: ../index.php");
}

// controlla se esiste nella tabella UTENTE l'utente cercato
function esiste_utente($username,$password,$con){    

    $user= mysqli_real_escape_string($con,$username);
    $pass= mysqli_real_escape_string($con,$password);

    $pass= md5($pass);
    $stringa= "SELECT * FROM utente WHERE nomeutente='$user' AND password='$pass'";
   
    $result= mysqli_query($con,$stringa);
        
    if(mysqli_num_rows($result)>0){
        $row= mysqli_fetch_array($result);
        return $row["idUtente"];
    }
    else
        return 0;    
}

// controlla se esiste nella tabella LOGIN l'utente del genitore cercato
function esiste_login($username,$password,$con,$mastercom){    

    $user= mysqli_real_escape_string($con,$username);
    $pass= mysqli_real_escape_string($con,$password);

    if ($mastercom == true)
    // controllo solo se esiste userid
    {
        $stringa= "SELECT * FROM login WHERE nomeutente='$user'";
    }
    else
    // controllo se esiste usedid e password
    {
        
        $pass= md5($pass);
        $stringa= "SELECT * FROM login WHERE nomeutente='$user' AND password='$pass'";
    }

    $result= mysqli_query($con,$stringa);
    
    if(mysqli_num_rows($result)>0){
        $row= mysqli_fetch_array($result);
        return $row["idUtente"];
    }
    else
        return 0;    
}

