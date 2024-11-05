<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

session_start();

// se non è un utente loggato manda alla pagina iniziale

if(!isset($_SESSION["loggato"])){
    header("Location:../index.php");
}
if($_SESSION["loggato"]== "no"){
    header("Location:../index.php");
}
if (! isset($_SESSION["ruolo"]) || $_SESSION["ruolo"] != 'admin') {
    header("Location:../index.php");
}
if (isset($_SESSION["ruolo"])) {
    $ruolo = $_SESSION["ruolo"];
} else {
    $ruolo = "nessun";
}
?>
<!DOCTYPE html>
<html>
<head>
<!-- boostrap -->
<link rel="stylesheet" href="../common/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../common/jsgrid-1.5.3-dist/jsgrid.min.css">
<link rel="stylesheet" href="../common/jsgrid-1.5.3-dist/jsgrid-theme.min.css">
<script type="text/javascript" src="../common/jquery-3.3.1-dist/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../common/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../common/jsgrid-1.5.3-dist/jsgrid.min.js"></script>

<style>
.hide { display: none; }
</style>

<title>Gestione Genitori</title>

<meta charset="UTF-8">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}

.button {
        border-collapse collapse;
        border-top-color rgb(221, 221, 221);
        border-top-style solid;
        border-top-width 1px;
        box-sizing border-box;
        color rgb(51, 51, 51);
        display table-cell;
        font-family Lato, sans-serif;
        font-size 14px;
        font-weight 700;
        height 64.5px;
        line-height 20px;
        padding-bottom 8px;
        padding-left 8px;
        padding-right 8px;
        padding-top 8px;
        text-align left;
        text-indent 0px;
        text-size-adjust 100%;
        background-color: white;
    }
</style>
</head>

<body>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <form name="logout_admin" action="#" method="POST">
        <button class="w3-bar-item w3-button  w3-padding-large w3-white" type='submit' name='logoutadmin'>LOGOUT</button>
        <!-- <a class="w3-bar-item w3-button w3-padding-large w3-white" href="pannello_controllo.php">PANNELLO DI CONTROLLO</a> -->
    </form>
    <?php
    if(isset($_POST["logoutadmin"])){
        if (isset($_SESSION["loggato"]))
        {
            $_SESSION["loggato"]="no";
            unset($_SESSION["loggato"]);
            unset($_SESSION["nomeutente"]);
            unset($_SESSION["password"]);
            unset($_SESSION["loggato"]);
            unset($_SESSION["idutente"]);
            unset($_SESSION["ruolo"]);
        }

        session_destroy();
        session_unset();
        header("Location: ../index.php");
    }
    ?>
  </div>
</div>

<div class="container">
    <br />
    <div class="table-responsive">
        <h3>Gestione dei Genitori - <?php echo $ruolo;?></h3><br />
        <div id="grid_table"></div>
    </div>
</div>
</body>
</html>

<script>
$('#grid_table').jsGrid({

    width: "100%",
    height: "900px",

    filtering: true,
    inserting:true,
    editing: true,
    sorting: true,
    paging: true,
    autoload: true,
    pageSize: 20,
    pageButtonCount: 5,
    deleteConfirm: "Sei sicuro di volere cancellare?",

    controller: {
        loadData: function(filter){
            return $.ajax({
                type: "GET",
                url: "gestioneGenitoriData.php",
                data: filter
            });
        },
    insertItem: function(item){
        return $.ajax({
            type: "POST",
            url: "gestioneGenitoriData.php",
            data:item
        });
    },
    updateItem: function(item){
        return $.ajax({
            type: "PUT",
            url: "gestioneGenitoriData.php",
            data: item
        });
    },
    deleteItem: function(item){
        return $.ajax({
            type: "DELETE",
            url: "gestioneGenitoriData.php",
            data: item
        });
    },
},

fields: [
    {
        name: "idUtente",
        type: "hidden",
        css: 'hide'
    },
    {
        name: "cognome",
        type: "text",
        width: 100,
        validate: "required"
    },
    {
        name: "nome",
        type: "text",
        width: 100,
        validate: "required"
    },
    {
        name: "cognome_genitore",
        type: "text",
        width: 100,
        validate: "required"
    },
    {
        name: "nome_genitore",
        type: "text",
        width: 100,
        validate: "required"
    },
    {
        name: "nomeutente",
        type: "text",
        width: 50
    },
    {
        name: "classe",
        type: "text",
        width: 50
    },
    {
        type: "control"
    }
]
});
</script>