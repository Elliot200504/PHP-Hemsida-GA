<?php
require_once 'Sql.php';
class Post{ 

   public static function deletePost($user_id, $post_id) {
    if($_SESSION['logged_in']== true){
      $conn = Sql::connect();
      
      $deleteQuery = "DELETE FROM posts WHERE post_id = '$post_id'";
      
      
      $result = $conn->exec($deleteQuery);
       header("Location: /viewProfile/$user_id");  

     }
      else if(!$_SESSION['logged_in']){
        echo "<h1 class='ERROR'>Du behöver logga in</h1>";
         echo "<a class='ERROR' href='/Login'>Logga in</a>";
      }

      else if($_SESSION['user_id']!=$user_id){

      echo "<h1>Not your profile</h1>";
      echo "<a href='/Logout'>Logga ut om det behövs</a>";

      }
  } 

  public static function deleteComment($user_id, $post_id, $comment_id) {
      $conn = Sql::connect();

      $post = self::getPostById($post_id);
      $comments = json_decode($post['comment'], true);

    // Kollar arrayen
  /*     debug($comments);
      debug($comment_id);
 */
    $newcomments = [];

    foreach($comments as $c){
        if($c['comment_id'] != $comment_id){
            $newcomments[] = $c;
        }
    }

    /* debug($newcomments);
     */
    $updateQuery = "UPDATE posts SET comment = :comment WHERE post_id = :post_id";

    $stmt = $conn->prepare($updateQuery);


    $newcomments = json_encode($newcomments);
    
    $stmt->bindParam(":comment", $newcomments, SQLITE3_TEXT);
    $stmt->bindParam(":post_id", $post_id, SQLITE3_INTEGER);
    $stmt->execute();

     $id= null;
    
     
      if ($_SESSION["user_id"]) {
          $id = $_SESSION["user_id"];
      } else {
          $id = "0";
      }

      if ($id == $_SESSION["user_id"]) {
          header("Location: /");
      } else { 
          header("Location: /viewProfile/$id");
      }
  }

  

public static function createComment($post_id, $comment,$id){
/*   debug($post_id);
  debug($comment); */
  
  if($_SESSION['logged_in']==true){

  $allPosts = self::getLatestPosts(-1);
    //debug($allPosts);
$post="";
    foreach($allPosts as $p){

      if($p["post_id"] == $post_id){
        $post = $p;
        break;
      }
      
    }

/*     debug($post['comment']); */
 
    $comments = [];
      if($post['comment'] != null){
        $comments = (array) json_decode($post['comment']);
      }
      else{

        $comments = [];
        
      }

    
      $conn = Sql::connect();


    /* byt 'test' till $comment & post_id -> $post_id samt använd dig av prepare statements */

    $currentUTCDate = time(); 
    $currentDate = new DateTime("@$currentUTCDate");
    $currentHour = $currentDate->format('G')+2; 
    $currentMinute = $currentDate->format('i'); 

    $comment_id = uniqid();
    
    $newcomment = [
        "comment_id" =>  $comment_id,
        "user_id" => $_SESSION["user_id"],
        "username" => $_SESSION["user_name"],
        "time" => $currentHour . ":" . $currentMinute,
        "comment" => $comment
    ];
  


    
       $setPost = "UPDATE posts SET comment = :comment WHERE post_id= :post_id ";
      $stmt = $conn->prepare($setPost);

      // Lägg till din nya kommentar till de gamla
    $comments[] = $newcomment;
    $comments = json_encode($comments);
      $stmt->bindParam(":comment",$comments, SQLITE3_TEXT);
      $stmt->bindParam(":post_id",$post_id, SQLITE3_INTEGER);

      $result = $stmt->execute(); 

    if($id == $_SESSION["user_id"]){
      header("Location: /");
    }
    else{ 
    header("Location: /viewProfile/$id");
   }

  }
  
}
  
  
public static function createPost($id, $title, $description, $post_picture) {
   if($_SESSION['logged_in']== true && $_SESSION['user_id']==$id){
$conn = Sql::connect();


$insertQuery = "INSERT INTO posts (user_id, title, description, image) VALUES (:id, :title, :description, :post_picture)";


     
$stmt = $conn->prepare($insertQuery);


$stmt->bindParam(':id', $id, SQLITE3_INTEGER);
$stmt->bindParam(':title', $title, SQLITE3_TEXT);
$stmt->bindParam(':description', $description, SQLITE3_TEXT);
$stmt->bindParam(':post_picture', $post_picture, SQLITE3_TEXT);


$result = $stmt->execute();

    
     
   header("Location: /viewProfile/$id");  




     
   }
  else if(!$_SESSION['logged_in']){
      echo "<h1 class='ERROR'>Du behöver logga in</h1>";
       echo "<a class='ERROR' href='/Login'>Logga in</a>";
    }

    else if($_SESSION['user_id']!=$id){

    echo "<h1>Not your profile</h1>";
    echo "<a href='/Logout'>Logga ut om det behövs</a>";

    }

  }

  public static function getPostById($post_id) {
      $conn = Sql::connect();

      $query = "SELECT * FROM posts WHERE post_id = :post_id";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":post_id", $post_id, SQLITE3_INTEGER);
      $result = $stmt->execute();

      
      if ($result && $row = $result->fetchArray()) {
          return $row; 
      } else {
          return null; 
      }
  }
  
  
  // Funktion att hämta posts från SQL-bibloteket till showPost
    public static function getPostsByUserId($id) {
        $conn = Sql::connect();
        $postquery = "SELECT * FROM posts WHERE user_id = $id"; 
        $postresult = $conn->query($postquery);

        $posts = [];

        while ($postrow = $postresult->fetchArray(SQLITE3_ASSOC)) {
            $posts[] = $postrow;
        }
        return $posts;
    } 

  // Funktion att visa posts på sidan
     public static function showPost($id){

      $post = [];

      $p = self::getPostsByUserId($id);
     
      if(count($p) == 0) return $post;

      return $p;

     }

  // Funktion att visa sista posten
  public static function getLatestPosts($limit = -1) {
      $conn = Sql::connect();
      $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT :limit";
      $stmt = $conn->prepare($query);
      $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
      $result = $stmt->execute();

      $latestPosts = [];
      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $latestPosts[] = $row;
      }

      return $latestPosts;
  }

  
}
  ?>