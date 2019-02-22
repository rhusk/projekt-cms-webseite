-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 22. Feb 2019 um 09:54
-- Server-Version: 5.7.23
-- PHP-Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `online_wallet`
--
CREATE DATABASE IF NOT EXISTS `online_wallet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `online_wallet`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `bankart` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `kontonummer` varchar(255) NOT NULL,
  `vornamep` varchar(255) NOT NULL,
  `nachnamep` varchar(255) NOT NULL,
  `emailp` varchar(255) NOT NULL,
  `gueltig` varchar(255) NOT NULL
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

INSERT INTO `user` (`id`, `vorname`, `nachname`, `password`, `email`) VALUES
(1, '.rhusk.', '.wallet', '$2y$10$7b.BHdmwwP3UEr04HH8FTuozAKVUH6s.VRWmKssz/N4TGPahND0x.', 'asdf1234'),


--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
  
--
----
--

  ALTER TABLE `profile`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
