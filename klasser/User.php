<?php
require_once 'Sql.php';
class User{

  public static function deleteUser($id){
    $conn = Sql::connect();


    if(!empty($_SESSION['logged_in']) && ($_SESSION['user_id'] ?? null) == $id){
      $conn = Sql::connect();
      // SQL-förfrågan för att ta bort en användare med en specifik ID
      $deleteQuery = "DELETE FROM users WHERE id = $id";
      $deletePostQuery = "DELETE FROM posts WHERE post_id = '$id'";
      // Kör sql förfrågan

      $result = $conn->exec($deleteQuery);
      $result = $conn->exec($deletePostQuery);
      session_destroy();
      header("Location: /Users");
    }
    else if(empty($_SESSION['logged_in'])){
      echo "<h1 class='ERROR'>Du behöver logga in</h1>";
       echo "<a class='ERROR' href='/Login'>Logga in</a>";
    }
  
    else if(($_SESSION['user_id'] ?? null) != $id){

    echo "<h1>Inte din profil</h1>";
    echo "<a href='/Logout'>Logga ut om det behövs</a>";

    }

  }
  public static function getUserData() {
      $conn = Sql::connect();
      $query = "SELECT * FROM users";
      $result = $conn->query($query);

      $users = [];
    
      while ($row = $result->fetchArray($mode = SQLITE3_ASSOC)) {
          $users[] = $row;
      }
    return $users;
  }

  
public static function logout(){
  $conn = Sql::connect();
  session_destroy();
  header("Location: /");
  
}
  
public static function index(){

  return self::getUserData();
  
}

public static function show($id){

  $user = ["message"=>"No user found"];

  foreach(self::getUserData() as $u){
    if($u["id"] == $id){
      $user = $u;
      break;
    }     
  }
  return $user;
}
  
  public static function editProfilePicture($id, $url) {

    if(!empty($_SESSION['logged_in']) && ($_SESSION['user_id'] ?? null) == $id){
        $conn = Sql::connect();

        $query = "UPDATE users SET user_picture = '$url' WHERE id = $id";

        $conn->exec($query);
        header("Location: /viewProfile/$id");  
    
    }
      else if(empty($_SESSION['logged_in'])){
        echo "<h1>Du behöver logga in</h1>";
        echo "<a href='/Login'>Logga in</a>";
      }
  else if(($_SESSION['user_id'] ?? null) != $id){

    echo "<h1>Inte din profil</h1>";
    echo "<a href='/Logout'>Logga ut om du vill</a>";

  }
}
  
}
