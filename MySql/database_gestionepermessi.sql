-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Set 03, 2024 alle 19:53
-- Versione del server: 5.7.35-cll-lve
-- Versione PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suffix_gestionepermessi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `login`
--

CREATE TABLE `login` (
  `idUtente` int(11) NOT NULL,
  `cognome` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cognome_genitore` varchar(200) DEFAULT NULL,
  `nome_genitore` varchar(200) DEFAULT NULL,
  `nomeutente` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `cambiata` varchar(4) NOT NULL,
  `classe` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `permesso`
--

CREATE TABLE `permesso` (
  `idPermesso` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `orauscita` varchar(30) NOT NULL,
  `cognomenomegenitore` varchar(200) NOT NULL,
  `cognomenomestudente` varchar(200) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `motivazione` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `fkUtente` int(11) NOT NULL,
  `stato` int(11) NOT NULL,
  `fatto` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nomeutente` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `ruolo` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idUtente`);

--
-- Indici per le tabelle `permesso`
--
ALTER TABLE `permesso`
  ADD PRIMARY KEY (`idPermesso`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`),
  ADD KEY `username_index` (`nomeutente`),
  ADD KEY `cognome_nome_index` (`cognome`,`nome`),
  ADD KEY `email_index` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `login`
--
ALTER TABLE `login`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `permesso`
--
ALTER TABLE `permesso`
  MODIFY `idPermesso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
