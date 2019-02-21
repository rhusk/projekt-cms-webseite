<?php

    require('php/mysqlconnector.php');
    $mysqlconnector = new MysqlConnector("localhost", "rhusk", "asdf1234", "profile");
    $error = false;
    error_log("Connect Datenbank");
    if(!empty($_POST['save']))
    {

        error_log("button");
        $iban = $_POST['iban'];
        $kontonummer = $_POST['kontonummer'];
        $vornamep = $_POST['vorname'];
        $nachnamep = $_POST['nachname'];
        $emailp = $_POST['email'];
        $gueltig = $_POST['gueltig'];

        error_log("Button clicked");
        $iban_error = "";
        $kontonummer_error = "";
        $vornamep_error = "";
        $nachnamep_error = "";
        $email_errorp = "";
        $gueltig_error = "";

        if(empty($iban))
        {
            $error=true;
            $iban_error=' * Bitte geben sie ihre Iban an';
            error_log("Iban scheisse");
        }
            error_log("Validating Iban");


        if(empty($kontonummer))
        {
            $error=true;
            $kontonummer_error=' * Bitte geben Sie ihre Kontonummer an';
            error_log("Kontonummer scheisse");
        }
            error_log("Validating Kontonummer");

        if(empty($vornamep))
        {
            $error=true;
            $vornamep_error=' * Bitte geben Sie ihren Vornamen an';
            error_log("Vorname scheisse");
        }
            error_log('Validing Vorname');

        if(empty($nachnamep))
        {
            $nachnamep_error = " * Bitte geben Sie ihren nachnamen an";
            $error=true;
            error_log("Nachname scheisse");
        }
            error_log('Validing Nachname');

        if(empty($emailp))
        {
            $error=true;
            $emailp_error=' * Bitte geben Sie ihre Email an';
            error_log("Email scheisse");
        }
            error_log('Validing Email');

        if(empty($gueltig))
        {
            $gueltig_error = " * Bitte geben Sie ein Datum an";
            $error=true;
            error_log("Datum scheisse");
        }
            error_log('Validing Datum');

        if(false === $error)
        {
            error_log("Inserting user...");
            $mysqlconnector->insert_profile($iban, $kontonummer, $vornamep, $nachnamep, $emailp, $gueltig);

            error_log("Schreiben des Users in die Session...");
            $_SESSION['loggedin'] = $emailp;

            error_log('Nun ist der User in der Session in loggedin : ' . $_SESSION['loggedin']);
            header('Location: profile.php');
            }
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CMS Projekt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <!-- mobile site -->
  <div class="site-wrap">
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

  <!-- side nav -->
    <div class="site-navbar-wrap js-site-navbar bg-white">

      <div class="container">
        <div class="site-navbar bg-light">
          <div class="py-1">
            <div class="row align-items-center">
              <div class="col-2">
                <h2 class="mb-0 site-logo"><a href="">Rhusk.Wallet</a></h2>
              </div>
              <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                  <div class="container">
                    <!-- d-lg-none -->
                    <div class="d-inline-block ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu h3"></span></a></div>
                     <!-- d-lg-block -->
                    <ul class="icon-menu js-clone-nav d-none">
                      <li class="active">
                        <a href="">Home</a>
                      </li>
                      <li><a href="">Login</a></li>
                      <li><a href="">Registry</a></li>
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- main container -->
    <div class="site-blocks-cover overlay">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="mb-4 mb_4">Profile</h1>
            <form action="profile.php" method="POST">
              <label class="form_konto" for="">IBAN </label>
              <br>
              <input type="text" name="iban" value="" style="width:150px;">
              <br>
              <label class="form_konto" for="">Kontonummer</label>
              <br>
              <input type="number" name="kontonummer" value="" style="width:150px;">
              <br>
              <label class="form_konto" for="">Vorname </label>
              <br>
              <input type="text" name="vorname" value="" style="width:150px;">
              <br>
              <label class="form_konto" for="">Nachname</label>
              <br>
              <input type="text" name="nachname" value="" style="width:150px;">
              <br>
              <label class="form_konto" for="">Email</label>
              <br>
              <input type="email" name="email" value="" style="width:150px;">
              <br>
              <label class="form_konto" for="">Gültig Bis</label>
              <br>
              <input type="date" name="gueltig" value="" style="width:150px;">
              <br><br>
              <input name="save" type="submit" value="Save">
            </form>
            <br>
            <form action="login.php" method="post">
              <input name="logout" type="submit" value="Logout" />
            </form>
          </div>
        </div>
      </div>
    </div>


  <!-- footer -->
    <div class="py-5 quick-contact-info-v2">
      <div class="container">
        <div class="row">
          <div class="col-md-4 text-center">
            <div>
              <span class="icon-room text-white h2 d-block"></span>
              <h2>Where</h2>
              <p class="mb-0">Berlin</p>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div>
              <span class="icon-clock-o text-white h2 d-block"></span>
              <h2>When</h2>
              <p class="mb-0">March 21 2019</p>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <div>
              <span class="icon-comments text-white h2 d-block"></span>
              <h2>Email</h2>
              <p class="mb-0">Email: rhusk@wallet.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/mediaelement-and-player.min.js"></script>
  <script src="js/main.js"></script>

  </body>
</html>
