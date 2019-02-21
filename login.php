<?php

// Initialisierung der Session.
session_start();

// Löschen aller Session-Variablen.
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Zum Schluß, löschen der Session.
session_destroy();
  error_log('delete session');

 //
 //
 //

require('php/mysqlconnector.php');
session_start();
error_log('session created');
$mysqlconnector = new MysqlConnector("localhost", "rhusk", "asdf1234");
error_log('sql connectet');
$error = false;
if(!empty($_POST['submit'])) // Überprüfung, ob Button geklickt wurde
{
    error_log('button');
    //get the values from the POST REQUEST
    $password = $_POST['password']; $email = $_POST['email'];
    // set the error messages empty
    $email_error = ""; $password_error = "";
    //if submitted, then validate
    if(empty($email))
    {
        $email_error = " * Bitte geben Sie eine E-Mail Adresse ein.";
        $error=true;
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = " * Bitte geben Sie eine gültige E-Mail Adresse ein.";
            $error=true;
        }
        if($mysqlconnector->user_exists($email)){
          $error = false;
        }else{
                $email_error = " * Der Benutzer existiert nicht. Bitte registrieren.";
                $error = true;
        }
    }
    if(empty($password))
	{
		$error=true;
        $password_error=' * Bitte geben Sie ein Passwort ein.';
    }else{
        if($mysqlconnector->checkpassword($email, $password)){
            $error = false;
          }else{
                  $password_error = " * Passwort falsch. Bitte erneut eingeben. ";
                  $error = true;
                  error_log ('Falsches Passwort eingegeben');
          }
    }
    if(false === $error)
	{
        $_SESSION['loggedin'] = $email;
        error_log("User in Session : " . $_SESSION['loggedin']);
        header('Location: profile.php');
        error_log ('Validation funktioniert');
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
                <h2 class="mb-0 site-logo"><a href="index.html">Rhusk.Wallet</a></h2>
              </div>
              <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                  <div class="container">
                    <!-- d-lg-none -->
                    <div class="d-inline-block ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu h3"></span></a></div>
                     <!-- d-lg-block -->
                    <ul class="icon-menu js-clone-nav d-none">
                      <li class="active">
                        <a href="index.html">Home</a>
                      </li>
                      <li><a href="login.php">Login</a></li>
                      <li><a href="registry.php">Registry</a></li>
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
            <h1 class="mb-4 mb_4">Login</h1>
            <form action="login.php" method="POST">
              <label class="form_regisry" for="">Email</label><br>
              <input type="email" name="email" value="">
              <br>
              <label class="form_regisry" for="">Passwort</label><br>
              <input type="password" name="password" value="">
              <br><br>
              <input name="submit" type="submit" value="Submit">
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
