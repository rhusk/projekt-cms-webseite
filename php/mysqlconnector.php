<?php

class MysqlConnector {
  public $servername;
  public $username;
  public $password;
  public $connection;


  /* Konstruktor verbindet zur Datenbank */
  public function __construct($servername, $username, $password){
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;
      $databasename = 'online_wallet';
      $this->connection = mysqli_connect($servername, $username, $password, $databasename);

      if (!$this->connection) {
          die("Connection failed: " . mysqli_connect_error());
      }
  }

  /* Schreiben der User-Daten in die Datenbank */
  public function insert_user($vorname, $nachname, $password, $email){
      $encrytedpassword = password_hash($password, PASSWORD_DEFAULT);
      $sqlinsert = "INSERT INTO user ( vorname, nachname, password, email )"
      . " VALUES ('$vorname','$nachname', '$encrytedpassword', '".$email."');";
      if ($this->connection->query($sqlinsert) === TRUE) {
        error_log("User created");
        return true;
      } else {
        error_log("User not created : " .$this->connection->error);
        return false;
      }
    }


    public function show_profile($email){

    $sql = "SELECT * FROM profile where email = '" .$email ."''";
    error_log('selecting profile for email : ' .$email);
    $result = $mysqlconnector->query($sql);
        error_log('macht select');
        while($row = $result->fetch_assoc()) {
            return $row;
        }

    }


  //Methode gibt boolean zurück, ob der Benutzer im System ist
  public function user_exists($email){
    $userexists = false;
    $sqlquery = "Select * from user where email = '" . $email . "';";
    $result = $this->connection->query($sqlquery);
    if ($result->num_rows > 0) {
      $userexists = true;
      error_log ('User existiert');
    } else {
      error_log ('User existiert nicht');
    }
    return $userexists;
  }

  /* Überprüfung, ob das password zur eingegebenen E-Mail passt */
  public function checkpassword($email, $password){
    $sql = "SELECT * FROM user WHERE email = '$email';";
    $result = $this->connection->query($sql);
    $row = $result->fetch_assoc();
    $verschluesseltespasswordausdb = $row['password'];
    $iscorrect = password_verify($password, $verschluesseltespasswordausdb);
      return  $iscorrect;
    }


    public function insert_profile($bankart, $iban, $kontonummer, $vornamep, $nachnamep, $emailp, $gueltig){
        $sqlinsert = "INSERT INTO profile ( bankart, iban, kontonummer, vornamep, nachnamep, emailp, gueltig )"
        . " VALUES ('".$bankart."', '".$iban."', '".$kontonummer."', '".$vornamep."', '".$nachnamep."', '".$emailp."', '".$gueltig."');";
        if ($this->connection->query($sqlinsert) === TRUE) {
            error_log("User created");
            return true;
        } else {
            error_log("User not created : " .$this->connection->error);
            return false;
    }
}
}
?>
