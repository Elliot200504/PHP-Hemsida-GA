<?php
require_once 'Sql.php';
class Auth{
    static public function Login(){
        $conn = Sql::connect();
      
        $username = $_POST['username'];
        $password = $_POST['password'];
      
        $loginQuery = "SELECT * FROM users WHERE username = '$username'";


      

        $result = $conn->query($loginQuery);
      
        $row = $result->fetchArray($mode = SQLITE3_ASSOC);
      
        if ($row) {
            if (password_verify($password, $row['user_password'])) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_name"] = $row["username"];
                $_SESSION["logged_in"] = true;   
                header("Location: /");
            } 
            else {
               echo '<p> Fel lösernod - <a href="/Login">Logga in</a> </p>';
            }
        } 
        else {
          echo '<p> Användaren finns inte - <a href="/Login">Logga in</a> </p>';
        }
  
    }

  
  static public function Register(){
      $conn = Sql::connect();
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $picture = $_POST['url'];

     
      $Usernamequery = "SELECT * FROM users WHERE username = '$username'";
      $Emailquery ="SELECT * FROM users WHERE user_email = '$email'";
      $result = $conn->query($Usernamequery);
      $existing_user = $result->fetchArray(SQLITE3_ASSOC);
      $result = $conn->query($Emailquery);
      $existing_email = $result->fetchArray(SQLITE3_ASSOC);
      if($existing_user) {
          echo "Användarnamnet används redan. Välj gärna ett annat.";
          echo "<br>";
          echo "<p><a href='/Register'>Försök igen.</a></p>";
         echo '<p>Har du redan ett konto? - <a href="/Login">Logga in</a> </p>';
      }
      else if($existing_email){
          echo "Mailadressen används redan. Välj gärna en annan";
          echo "<br>";
          echo "<p><a href='/Register'>Försök igen.</a></p>";
         echo '<p>Har du redan ett konto? - <a href="/Login">Logga in</a> </p>';
        }
      else {
          $query = "INSERT INTO users (username, user_email, user_password, user_picture ) VALUES ('$username', '$email', '$password', '$picture')";
          $conn->exec($query);
          header("Location: /Login");
      }
  }
}
?>