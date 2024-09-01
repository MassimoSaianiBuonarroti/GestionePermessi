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
function salvaPermesso($con,$tipo,$data,$orauscita,$cognomenomegenitore,$cognomenomestudente,$classe,$motivazione,$note,$fkUtente){ 
    //Preparated Statement
    // prepare and bind
    $stmt = $con->prepare("INSERT INTO permesso(tipo,data,orauscita,cognomenomegenitore,cognomenomestudente,classe,motivazione,note,fkUtente,stato) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssii", $tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$note1,$fkUtente1,$stato1);

    // set parameters and execute
    $tipo1= $tipo;
    $data1= $data;
    $orauscita1= $orauscita;
    $cognomenomegenitore1= $cognomenomegenitore;
    $cognomenomestudente1= $cognomenomestudente;
    $classe1= $classe;
    $motivazione1= $motivazione;
    $note1= $note;
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

function invioEmail($tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$note1){
    // Creo una array dividendo la data YYYY-MM-DD sulla base del trattino
    $array = explode("-", $data1); 
    // Riorganizzo gli elementi in stile DD/MM/YYYY
    $data_it = $array[2]."/".$array[1]."/".$array[0]; 
    //echo $data_it;

    // definisco mittente e destinatario della mail
    $nome_mittente = $cognomenomegenitore1;
    $mail_mittente = $cognomenomegenitore1;
    $mail_destinatario = "dirigenza@buonarroti.tn.it"; //permessi.studenti@buonarroti.tn.it

    // definisco il subject ed il body della mail
    $mail_oggetto = "Tipo di operazione: ".$tipo1;
    if($tipo1=="entrata" || $tipo1=="uscita"){
        // definisco il messaggio formattato in HTML
        $mail_corpo = '<HTML>
        <html>
            <head>
                <!--<title>Una semplice mail con PHP formattata in HTML</title>-->
            </head>
            <body>
                Il sottoscritto <b style=text-transform:uppercase>'.$cognomenomegenitore1.'</b>,<br> genitore dello studente <b style=text-transform:uppercase>'.$cognomenomestudente1.
                '</b> della classe <b style=text-transform:uppercase>'.$classe1.'</b>,<br> chiede<br> il permesso di <b style=text-transform:uppercase>'.$tipo1.'</b><br> in data <b>'.$data_it.'</b> alle ore <b>'.
                $orauscita1.'</b>,<br> per il seguente motivo: <b style=text-transform:uppercase>'.$motivazione1.'</b>.<br> Eventuali note: <b style=text-transform:uppercase>'.$note1.'</b>
            </body>
        </html>
        </HTML>';
    }           
    /*else{
        $mail_corpo = '<HTML>
        <html>
            <head>
                <!--<title>Una semplice mail con PHP formattata in HTML</title>-->
            </head>
            <body>
                Il sottoscritto <b style=text-transform:uppercase>'.$cognomenomegenitore1.'</b>,<br> genitore dello studente <b style=text-transform:uppercase>'.$cognomenomestudente1.
                '</b> della classe <b style=text-transform:uppercase>'.$classe1.'</b>,<br> giustifica<br> l\'<b>ASSENZA</b><br> del giorno <b>'.$data_it.'</b>,<br> per il seguente motivo: <b style=text-transform:uppercase>'.$motivazione1.'</b>.<br> Eventuali note: <b style=text-transform:uppercase>'.$note1.'</b>
            </body>
        </html>
        </HTML>';    
    
    }   */ 
    //echo $mail_corpo;
    
    // aggiusto un po' le intestazioni della mail
    // E' in questa sezione che deve essere definito il mittente (From)
    // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
    $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
    $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Aggiungo alle intestazioni della mail la definizione di MIME-Version,
    // Content-type e charset (necessarie per i contenuti in HTML)
    $mail_headers .= "MIME-Version: 1.0\r\n";
    $mail_headers .= "Content-type: text/html; charset=iso-8859-1";

    if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers)){
        echo "Messaggio inviato con successo a " . $mail_destinatario;
        return true;
    }
    else{
        echo "Errore. Nessun messaggio inviato.";
        return false;
    }
}

function invioEmail_Annulla($tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$note1){
    // Creo una array dividendo la data YYYY-MM-DD sulla base del trattino
    $array = explode("-", $data1); 
    // Riorganizzo gli elementi in stile DD/MM/YYYY
    $data_it = $array[2]."/".$array[1]."/".$array[0]; 
    //echo $data_it;

    // definisco mittente e destinatario della mail
    $nome_mittente = $cognomenomegenitore1;
    $mail_mittente = $cognomenomegenitore1;
    $mail_destinatario = "dirigenza@buonarroti.tn.it";

    // definisco il subject ed il body della mail
    $mail_oggetto = "Tipo di operazione: ANNULLAMENTO ".$tipo1;
    if($tipo1=="entrata" || $tipo1=="uscita"){
        // definisco il messaggio formattato in HTML
        $mail_corpo = '<HTML>
        <html>
            <head>
                <!--<title>Una semplice mail con PHP formattata in HTML</title>-->
            </head>
            <body>
                Il sottoscritto <b style=text-transform:uppercase>'.$cognomenomegenitore1.'</b>,<br> genitore dello studente <b style=text-transform:uppercase>'.$cognomenomestudente1.
                '</b> della classe <b style=text-transform:uppercase>'.$classe1.'</b>,<br> chiede<br> di <b>ANNULLARE</b> il permesso di <b style=text-transform:uppercase>'.$tipo1.'</b><br> in data <b>'.$data_it.'</b> alle ore <b>'.
                $orauscita1.'</b>
            </body>
        </html>
        </HTML>';
    }           
    /*else{
        $mail_corpo = '<HTML>
        <html>
            <head>
                <!--<title>Una semplice mail con PHP formattata in HTML</title>-->
            </head>
            <body>
                Il sottoscritto <b style=text-transform:uppercase>'.$cognomenomegenitore1.'</b>,<br> genitore dello studente <b style=text-transform:uppercase>'.$cognomenomestudente1.
                '</b> della classe <b style=text-transform:uppercase>'.$classe1.'</b>,<br> chiede di <b>ANNULLARE</b> la giustifica<br> dell\'<b>ASSENZA</b><br> del giorno <b>'.$data_it.'</b>
            </body>
        </html>
        </HTML>';    
    
    }*/   
    //echo $mail_corpo;
    
    // aggiusto un po' le intestazioni della mail
    // E' in questa sezione che deve essere definito il mittente (From)
    // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
    $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
    $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Aggiungo alle intestazioni della mail la definizione di MIME-Version,
    // Content-type e charset (necessarie per i contenuti in HTML)
    $mail_headers .= "MIME-Version: 1.0\r\n";
    $mail_headers .= "Content-type: text/html; charset=iso-8859-1";
    //return true;
    /*if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers)){
        echo "Messaggio inviato con successo a " . $mail_destinatario;
        return true;
    }
    else{
        echo "Errore. Nessun messaggio inviato.";
        return false;
    }*/
}

function modificaPassword($con,$nuovapassword,$nuovapassword_ripeti,$fkUtente){
    //Preparated Statement
    // prepare and bind
    $stmt = $con->prepare("UPDATE login SET password=?,password_cambiata=? WHERE nomeutente=?");
    $stmt->bind_param("ssi", $nuovapassword1,$password_cambiata,$fkUtente1);
    // set parameters and execute
    $nuovapassword1= md5($nuovapassword);
    $password_cambiata= "si";
    $fkUtente1= $fkUtente;
    $stmt->execute();
    //--------------------
    return true;  
    //header("Location: elencomastercompleto.php");  
}

//FUNZIONE CHE SALVA IL PERMESSO
function salvaGiustificazione($con,$tipo,$data,$cognomenomegenitore,$luogonascita,$datanascita,$scuola,$nomedottore,$cognomenomestudente,$classe,$motivazione,$note,$fkUtente,$assenzadal,$assenzaal){ 
    /*$stmt = $con->prepare("INSERT INTO giustificazione(nome_file,tipo_file,dati_file) VALUES(?,?,?)");
    $stmt->bind_param("ssb",$nome_file_vero1,$tipo_file1,$dati_file1);
    $nome_file_vero1= $nome_file_vero;
    $tipo_file1= $tipo_file;
    $dati_file1= $dati_file;
    $stmt->execute();*/

    if($tipo=="condizioni_sospette" || $tipo=="condizioni_non_sospette_maggiore3"){
        //COPIARE IL FILE NELLA CARTELLA "ALLEGATI" che si trova allo stesso livello della
        //pagina che effettua il salvataggio e cioè in PAGINE
        $target_dir = "./allegati/";
	    $target_file = $target_dir . basename($_FILES["file_inviato"]["name"]);
    
        //Splitto $cognomenomestudente per aggiungere il trattino basso
        $cognomenomestudente= trim($cognomenomestudente);
        $cogn_nome_finale= str_replace(" ","_",$cognomenomestudente);
    

        //Nuovo nome
        //echo basename($_FILES["file_inviato"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $nomefile= date("Y_m_d")."_".$cogn_nome_finale."_".$classe.".".$imageFileType;
        $target_newfile = $target_dir .$nomefile;
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
	
        //Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Il file non è stato caricato.";
            // if everything is ok, try to upload file
        }
        else {
            if (move_uploaded_file($_FILES["file_inviato"]["tmp_name"], $target_newfile)) {
                echo "Il file ". basename( $_FILES["file_inviato"]["name"]). " è stato inviato con successo.";
            } else {
                echo "Il file non è stato inviato.";
            }
        }


        /*$stato= 0;
        $cognomenomegenitore_ok= mysqli_real_escape_string($con,$cognomenomegenitore);
        $cognomenomestudente_ok= mysqli_real_escape_string($con,$cognomenomestudente);
        $query= "INSERT INTO giustificazione(tipo,data,cognomenomegenitore,luogonascita,datanascita,scuola,nomedottore,cognomenomestudente,classe,motivazione,note,fkUtente,stato,nome_file,assenzadal,assenzaal) VALUES('$tipo','$data','$cognomenomegenitore_ok','$luogonascita','$datanascita','$scuola','$nomedottore','$cognomenomestudente_ok','$classe','$motivazione','$note',$fkUtente,$stato,'$nomefile','$assenzadal','$assenzaal')";
        echo $query;
        mysqli_query($con,$query);*/


        //Preparated Statement
        // prepare and bind
        $stmt = $con->prepare("INSERT INTO giustificazione(tipo,data,cognomenomegenitore,luogonascita,datanascita,scuola,nomedottore,cognomenomestudente,classe,motivazione,note,fkUtente,stato,nome_file,assenzadal,assenzaal) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssiisss", $tipo1,$data1,$cognomenomegenitore1,$luogonascita1,$datanascita1,$scuola1,$nomedottore1,$cognomenomestudente1,$classe1,$motivazione1,$note1,$fkUtente1,$stato1,$nomefile1,$assenzadal1,$assenzaal1);

        // set parameters and execute
        //$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $tipo1= $tipo;
        $data1= $data;
        //$orauscita1= $orauscita;
        $cognomenomegenitore1= $cognomenomegenitore;
        $luogonascita1= $luogonascita;
        $datanascita1= $datanascita;
        $scuola1= $scuola;
        $nomedottore1= $nomedottore;
        $cognomenomestudente1= $cognomenomestudente;
        $classe1= $classe;
        $motivazione1= $motivazione;
        $note1= $note;
        $fkUtente1= $fkUtente;
        $stato1= 0;
        $nomefile1= $nomefile;
        $assenzadal1= $assenzadal;
        $assenzaal1= $assenzaal;
        $stmt->execute();


        //--------------------
        //echo "<br>INSERIMENTO AVVENUTO CON SUCCESSO";
    }
    else{
        /*$stato= 0;
        $nomefile="";
        $query= "INSERT INTO giustificazione(tipo,data,cognomenomegenitore,luogonascita,datanascita,scuola,nomedottore,cognomenomestudente,classe,motivazione,note,fkUtente,stato,nome_file,assenzadal,assenzaal) VALUES('$tipo','$data','$cognomenomegenitore','$luogonascita','$datanascita','$scuola','$nomedottore','$cognomenomestudente','$classe','$motivazione','$note',$fkUtente,$stato,'$nomefile','$assenzadal','$assenzaal')";
        //echo $query;
        mysqli_query($con,$query);*/

        //Preparated Statement
        // prepare and bind
        $stmt = $con->prepare("INSERT INTO giustificazione(tipo,data,cognomenomegenitore,luogonascita,datanascita,scuola,nomedottore,cognomenomestudente,classe,motivazione,note,fkUtente,stato,nome_file,assenzadal,assenzaal) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssiisss", $tipo1,$data1,$cognomenomegenitore1,$luogonascita1,$datanascita1,$scuola1,$nomedottore1,$cognomenomestudente1,$classe1,$motivazione1,$note1,$fkUtente1,$stato1,$nomefile1,$assenzadal1,$assenzaal1);

        // set parameters and execute
        //$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $tipo1= $tipo;
        $data1= $data;
        //$orauscita1= $orauscita;
        $cognomenomegenitore1= $cognomenomegenitore;
        $luogonascita1= $luogonascita;
        $datanascita1= $datanascita;
        $scuola1= $scuola;
        $nomedottore1= $nomedottore;
        $cognomenomestudente1= $cognomenomestudente;
        $classe1= $classe;
        $motivazione1= $motivazione;
        $note1= $note;
        $fkUtente1= $fkUtente;
        $stato1= 0;
        $nomefile1= "";
        $assenzadal1= $assenzadal;
        $assenzaal1= $assenzaal;
        $stmt->execute();

        //echo "<br>INSERIMENTO AVVENUTO CON SUCCESSO";

    }
    /*if (invioEmail($tipo1,$data1,$orauscita1,$cognomenomegenitore1,$cognomenomestudente1,$classe1,$motivazione1,$note1)== true){
        header("Location: email_esitoPositivo.php");      
    }
    else{
        header("Location: email_esitoNegativo.php");
    }*/
     
    //header("Location: indexLogout.php");  
}
?>
