<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    include 'accessoDatabase.php';
    $con= accesso();
    if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si")
    {
        $username= $_SESSION["nomeutente"];
        $password= $_SESSION["password"];
        if($username=="201800" && $password=="Staff2019")
        {
            header("Location:frontoffice.php");
        }
        else
        if($username=="usertest" && $password=="buonarroti2024")
        {
            header("Location:frontoffice.php");
        }
        else
        {
            header("Location:indexLogout.php");
        }
    }
    else
    {
        $username= $_POST["nomeutente"];
        $password= $_POST["password"];
        //echo "sono qui";
        $esiste= esiste($username,$con);
        if($esiste>0)
        {           
            if (($username=="201800" && $password=="Staff2019") || ($username=="usertest" && $password=="buonarroti2024"))
            {
                $_SESSION["nomeutente"]= $username;//$username;
                $_SESSION["password"]=$password;
                $_SESSION["loggato"]= "si";
                $_SESSION["idutente"]= $esiste;
                header("Location:frontoffice.php");
            }

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
            {
                    $_SESSION["loggato"]= "no";
                    header("Location:../index.php");
            } 
            else 
            {
                    $array = json_decode($response, true);
                    if ($array["auth"] == false)
                {
                    header("Location: ../index.php");
                }
                    else
                {
                        $_SESSION["nomeutente"]= $username;//$username;
                        $_SESSION["password"]=$password;
                        $_SESSION["loggato"]= "si";
                        $_SESSION["idutente"]= $esiste;
                     header("Location: indexLogout.php");
                }
            }    
        }
    }
}
else
{
  header("Location: ../index.php");
}


function esiste($username,$con){    
    $user= mysqli_real_escape_string($con,$username);
    //msqli_query($con,"set names 'utf8'");
    /*if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
    else{*/
    //echo $username;
    $stringa= "SELECT * FROM login WHERE nomeutente='$user'";
    //echo $stringa;
    $result= mysqli_query($con,$stringa);
    
    
    if(mysqli_num_rows($result)>0){
        $row= mysqli_fetch_array($result);
        return $row["idUtente"];
    }
    else
        return 0;
    
}

