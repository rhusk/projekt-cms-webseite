-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 20. Feb 2019 um 15:57
-- Server-Version: 5.7.23
-- PHP-Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `Online Wallet`
--
CREATE DATABASE IF NOT EXISTS `online_wallet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `online_wallet`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile`
--

CREATE TABLE `profile` (
  `iban` varchar(255) NOT NULL,
  `kontonummer` varchar(255) NOT NULL,
  `vornamep` varchar(255) NOT NULL,
  `nachnamep` varchar(255) NOT NULL,
  `emailp` varchar(255) NOT NULL,
  `gueltig` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

--
INSERT INTO `profile` (iban`, `kontonummer`, `vorname`, `nachname`, `email`, `gueltig`) VALUES
(DE719839018041414', '9018041414', 'G', 'K', 'G@K.de', '2020-02-05');
--

--
INSERT INTO `user` (`id`, `vorname`, `nachname`, `password`, `email`) VALUES
(1, 'Gary', 'K', '1234asdf', 'gary@rhusk.de');
--

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
