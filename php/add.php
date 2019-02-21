<?php
require('mysqlconnector.php');
require('../profile.php')
session_start();
$mysqlconnector = new MysqlConnector("localhost", "rhusk", "asdf1234");
$error = false;
error_log("Im registry");
if(!empty($_POST['save'])) {

    $bankart = ($_POST['bankart']);
    $kontonummer = ($_POST['kontonummer']);
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $gueltig = $_POST['gueltig'];

    error_log("Submitted clicked");

    $bankart_error = "";
    $kontonummer_error = "";
    $vorname_error = "";
    $nachname_error = "";
    $email_error = "";
    $gueltig_error = "";

    //if submitted, then validate
    error_log("Validating vorname");
    if(empty($vorname))
    {
        $error=true;
        $vorname_error=' * Bitte geben Sie Ihren voramen ein';
        error_log("Vorname scheisse");
    }
        error_log("Validating nachname");
        if(empty($nachname))
        {
        $error=true;
        $nachname_error=' * Bitte geben Sie einen nachnamen ein.';
        error_log("nachname scheisse");
    }
    error_log("Validating email on empty....");

    if(empty($password))
    {
        $error=true;
        $password_error=' * Bitte geben Sie ein password ein.';
        error_log("Password scheisse ....");

    }

    if(empty($email))
    {
        $email_error = " * Bitte geben Sie eine gültige E-Mail Adresse ein.";
        $error=true;
        error_log("Email scheisse");

    }else{
        error_log("Validating email on syntx....");
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Unvalid email!
            $email_error = " * Bitte geben Sie eine gültige E-Mail Adresse ein.";
            $error=true;
            error_log("Check if user exists");
        }
        if($mysqlconnector->user_exists($email)){
            error_log("User already existing");
            $email_error = " * Der Benutzer existiert bereits. Bitte einloggen.";
            $error = true;

        }
    }
    error_log("Validating password....");

    if(false === $error)
        {
        //Validation Success!
        //Do form processing like email, database etc here
        error_log("Inserting user...");
        $mysqlconnector->insert_profile($bankart, $kontonummer, $vorname, $nachname, $email, $gueltig);
        //echo 'User inserted';
        error_log("Schreiben des Users in die Session...");
        $_SESSION['loggedin'] = $email;

        error_log('Nun ist der User in der Session in loggedin : ' . $_SESSION['loggedin']);
        header('Location: add.php');
        }
}

?>
