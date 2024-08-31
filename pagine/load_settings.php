<?php

/**
 *  This file is part of Gestione Permessi
 *  @author     Massimo Saiani <massimo.saiani@buonarroti.tn.it>
 *  @copyright  (C) 2024 Massimo Saiani
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */


// read JSON settings file
$json = file_get_contents(__DIR__ . '/../GestionePermessi.json');

// decode JSON
$__settings = json_decode($json);

// include version number for cache busting
require_once __DIR__ . '/../version.php';
?>