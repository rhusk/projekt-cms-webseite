<?php

    require('php/mysqlconnector.php');
    $mysqlconnector = new MysqlConnector("localhost", "test", "test", "profile");
    $profile = $mysqlconnector->show_profile($_SESSION['loggedin']);
    echo 'KontoNummer : ' .$profile->kontonummer;
?>
