<?php
session_start();
if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
else
    if(($_SESSION["password"]=="12345678")){
        header("Location:cambiapasswordpa.php");
    }



include 'accessoDatabase.php';
$con= accesso();
if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si"){
    $username= $_SESSION["nomeutente"];
    $password= $_SESSION["password"];
    
}
else{
    $username= $_POST["nomeutente"];
    $password= $_POST["password"];
    //echo "sono qui";
    $esiste= esiste($username,$password,$con);
    if($esiste>0){   
        $user= mysqli_real_escape_string($con,$username);
        $pass= mysqli_real_escape_string($con,$password);
        
        $_SESSION["nomeutente"]= $user;//$username;
        $_SESSION["password"]= $pass;//$password;  
        $_SESSION["loggato"]= "si";
        $_SESSION["idutente"]= $esiste;
        if($_SESSION["nomeutente"]=="201800" && $_SESSION["password"]=="Staff2019"){
            header("Location:frontoffice.php");
        }
        else{
            //echo $_SESSION["nomeutente"]. " - ". $_SESSION["password"];
            if($_SESSION["nomeutente"]=="202000" && $_SESSION["password"]=="giustificazioni2020"){
                header("Location:frontoffice_giustificazioni.php");
            }
            else{
                
                if(strtolower($_SESSION["password"])!= "anno2023")       
                    header("Location:indexLogout.php");
                else
                    header("Location:cambiapasswordpa.php");
                
            }
        }
    }
    else{
        //echo "<h1>Nome utente o password errata</h1>";
        $_SESSION["loggato"]= "no";
        header("Location:../index.php");
        //header( "refresh:4;url=../index.php");
    }
}

function esiste($username,$password,$con){    
    $user= mysqli_real_escape_string($con,$username);
    $pass= mysqli_real_escape_string($con,$password);
    //msqli_query($con,"set names 'utf8'");
    /*if($con->connect_error){
        die("Connection failed: ". $con->connect_error);
    }
    else{*/
    //echo $username;
    $pass= md5($pass);
    $stringa= "SELECT * FROM login WHERE nomeutente='$user' AND password='$pass'";
    //echo $stringa;
    $result= mysqli_query($con,$stringa);
    
    
    if(mysqli_num_rows($result)>0){
        $row= mysqli_fetch_array($result);
        return $row["idUtente"];
    }
    else
        return 0;
    
    //}
    
}

