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
      $this->connection = mysqli_connect($servername, $username, $password, $databasename);  // einzig wichtige Zeile in diesem Constructor
      //echo 'Connect to <br>';
      //echo 'Servername : ' . $servername;
      //echo 'Username : ' .  $username .'<br>';
      //echo 'Databasename : ' . $databasename .'<br>';
      // Check connection
      if (!$this->connection) {
          die("Connection failed: " . mysqli_connect_error());
      }
          //echo "Connected successfully";
  }


  /* Schreiben der User-Daten in die Datenbank */
  public function insert_user($vorname, $nachname, $password, $email){
//public function insert_user($name, $email, $password, $username){
  // INSERT INTO user ( email, password, name, username  ) VALUES ('niclas@sae.de', 'password', 'niclas', 'niclas92');
  $encrytedpassword = password_hash($password, PASSWORD_DEFAULT);
  $sqlinsert = "INSERT INTO user ( vorname, nachname, password, email ) " // bauen das SQL, das wir nutzen, um den
  . " VALUES ('$vorname','$nachname', '$encrytedpassword', '".$email."');";//Benutzer in die Datenbank zu schreiben als String
  if ($this->connection->query($sqlinsert) === TRUE) { //query führt das SQL auf der Datenbank aus
      //echo "New record created successfully";
      error_log("User created");
      return true;
  } else {
      //echo "Error: " . $sqlinsert . "<br>" . $this->connection->error;
      error_log("User not created : " .$this->connection->error);
      return false;
  }
}

  //Methode gibt boolean zurück, ob der Benutzer im System ist

  public function user_exists($email){
    $userexists = false;
    //select * from user where email = 'niclas@web.de';
    $sqlquery = "Select * from user where email = '" . $email . "';";
    $result = $this->connection->query($sqlquery); //suchen in der Datenbank
    //echo var_dump($result);
    if ($result->num_rows > 0) { // überprüfen ob die Anzahl der Resultate > 0 sind, also die Zeilen in der Datenbank
      $userexists = true;
      error_log ('User existiert');
    }else {
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
}
?>
