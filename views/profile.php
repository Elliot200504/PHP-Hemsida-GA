
  <!DOCTYPE html>
  <html lang="sv">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Användare</title>
    
<style>

  #options-btn {
      background-color: white; 
      border: 1px solid black;
      color: black; 
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
      border-radius: 5px;
  }



  
  .profileinfo {
      background-color: #fff;
      padding: 20px;
      border: 1px solid #dddfe2;
      border-radius: 5px;
      margin-bottom: 20px;
  }

  .profileinfo h1 {
      font-size: 24px;
      margin: 0;
      color: #333;
  }

  h2 {
      font-size: 20px;
      margin-top: 20px;
      margin-bottom: 10px;
      color: #333;
  }


  
  .Profile {
    display: flex;
    margin-top: 20px;
    width: 60%; 
    margin: auto; 
  }

  .Account {
    background-color: rgba(255, 255, 255, 1);
    padding: 80px;
    border-radius: 20px; 
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
  }

  .pfp {
    width: 200px; 
    height: 200px; 
    border-radius: 50%; 
    overflow: hidden;
    margin-bottom: 20px;
  }

  .pfp img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
  }


  .edit {
    margin-top: 20px;
    text-align: center;
  }

  .edit form {
    display: flex;
    align-items: center;
  }

  .edit input[type="text"] {
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .edit input[type="submit"] {
    padding: 10px 20px;
    background-color: white;
    color: black;
    border: none;
    border:1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
  }

  .edit input[type="submit"]:hover {
    background-color: black;
    color:white;
  }

  .border {
      border: 1px solid #dddfe2;
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
  }

 
  
  
  .border h1 {
      font-size: 24px;
      margin: 0 0 10px;
  }

  .border p {
      font-size: 16px;
      margin: 0 0 10px;
  }

  .border img {
    border:1px solid black;
    padding:1%;
    border-radius:5px;
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
  }

  .border a {
      color: #385898;
      text-decoration: none;
  }

  .border a:hover {
      text-decoration: underline;
  }
  .info a {
    color: #333;
    text-decoration: none;
    display: inline-block;
    padding: 5px 10px;
    background-color: #f2f2f2;
    border: 1px solid #333;
    border-radius: 5px;
  }
  .info a:hover {
    color: #555;
    background-color: #e6e6e6;
  }

  .edit {
      margin-top: 20px;
      text-align: center;
      display: none; 
    cursor:pointer;
  }

  
  .edit.show {
      display: block;
  }
  .Kommentarer {
    padding:10px;
    border:1px solid black;
    margin-top: 20px;
  }

  .Kommentarer p {
    font-size: 1.2em;
    margin-bottom: 10px;
  }

  .Kommentarer form {
    margin-top: 10px;
  }

  .Kommentarer input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .Kommentarer input[type="text"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

  .Kommentarer input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .Kommentarer input[type="submit"]:hover {
    background-color: #0056b3;
  }

  .delete{
    display: inline-block;
    margin-left: 95%; 
    padding: 2%;
    text-decoration: none;
    color: black;
    background-color: white;
    border: 2px solid black;
    border-radius: 5px;
  }

  .delete:hover {
    background-color: black;
    color: white;
  }

  .Kommentarer a {
    text-decoration: none;
    color: black;
    background-color: white;
    border: 2px solid black;
    font-size:1rem;
  }

  .Kommentarer a:hover {
    background-color: black;
    color: white;
    text-decoration:none;
    cursor:pointer;
  }

  @media (max-width: 768px) {
    .Profile {
      width: 100%;
      align-items: flex-start;
    }

    .Account {
      width: 100%;
      padding: 20px; 
      box-sizing: border-box;
    }

    .edit {
      display:none;
      text-align: left; 
    }

    .edit input[type="text"],
    .edit input[type="submit"] {
      width: 100%; 
    }

    @media screen and (max-width: 800px) {
        .delete {
            display: block;
            margin-left:70%;
            margin-top: 20px;
            width:30%;
            padding: 5px;
            text-align: center;
        }
    }
   

    
  }
</style>

     <?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }  
    
      $user=(User::show($id));
      $posts=(Post::showPost($id));
      $conn = Sql::connect();
      $query = "SELECT * FROM users";
      $result = $conn->query($query);
      $row = $result->fetchArray();
      /* $posts=(Post::showComment($id)); */
    ?>

    
<body> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="Profile">
      <div class="Account">
        <?php 
         if(isset($_SESSION["logged_in"]) && $_SESSION["user_id"]==$id){
       echo "<a class='delete' href='/deleteUser/{$user['id']}'>Delete Profile</a>";
         } ?> 
          <div class="pfp"> 
              <?php
              // Kollar ifall användaren har en bild
              if ($user['user_picture']) {
                  echo "<img src='" . $user['user_picture'] . "' alt='Profile Picture'>";
              } else {
                  // Default bilden
                  echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' alt='Profile Picture'>";
              }
              ?>
          </div>
          <div class="profileinfo">
              <h1><?php echo $user["username"]; ?></h1>
          </div>
          <div class="info">
              <?php
              // Visar userns posts
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                   echo "<div class='border'>";
                  echo "<div class='text'>";
                    echo "<h1>" . $post['title'] . "</h1>";
                    echo "<p>" . $post['description'] . "</p>";
                  echo "</div>";
                  echo"<br>";
                   echo "<img src='" . $post['image'] . "' alt='Picture'>";
                  echo"<br>";
                   if(isset($_SESSION["logged_in"]) && $_SESSION["user_id"]==$id){
                     echo "<a href='/deletePost?user_id={$user['id']}&post_id={$post['post_id']}'>Ta bort detta inlägg</a>";
                   }

     echo '<div class="Kommentarer"> ';
     echo '<p>Kommentarer:</p>';
      if ($post["comment"] !== null) {
       $comments = json_decode($post["comment"]); 
      if ($comments !== null) {
         foreach ($comments as $c) {
         $c = (array) $c;
         echo "<br>";
         echo "<p> [" . $c['time'] . "] - " . $c['username'] . ": " . $c['comment']; 
           if(isset($_SESSION["logged_in"]) && $_SESSION["user_id"]==$c['user_id']){
           
             echo " - <a href='/deleteComment?user_id={$c['user_id']}&post_id={$post['post_id']}&comment_id={$c['comment_id']}'>Ta bort</a>";
   }
        
      else{
        echo "";
        }
      echo "</p>";
      echo "<br>";
      echo "<hr>";
      }
    } 
  else {
    echo "";
  }
} 
else {
  echo "";
}

      
                echo'
                <form action="/profileComment" method="POST">
                <input type="text" name="comment" placeholder="Lägg en kommentar" required>   
                <input type="hidden" name="post_id" value="'.$post['post_id'].'"> 
                <input type="hidden" name="id" value="'.$id.'"> 
                </form>';
        
              echo "</div>";
               echo '</div>';
              echo"<br>";
            }
          }
        
            else{
               echo "<h1>Inga inlägg har gjorts</h1>";
            }
            
              ?>
          </div>
        <?php
         if(isset($_SESSION["logged_in"]) && $_SESSION["user_id"]==$id){
        echo'
          <div class="options-container">
    <button id="options-btn" class="fa fa-gear"></button>
    <div class="edit" id="additional-options">
        <form action="/viewss/profile" method="POST">
            <input type="text" name="url" placeholder="Ny profilbild" required>     
            <input type="hidden" value="' . $user['id'] . '"name="id">
            <input type="submit" value="Ändra">
        </form>
        <br>
        <!-- Form för att lägga in ett nytt upplägg -->
        <form action="/profilepost" method="POST">
            <input type="text" name="title" placeholder="Title" required>   
            <input type="text" name="post_picture" placeholder="Bild" required>   
            <input type="text" name="description" placeholder="Text om ditt uplägg" required>  
            <input type="hidden" value="'. $user['id'] . '"name="id">
            <input type="submit" value="Lägg upp">
        </form>
    </div>
</div>';
          }         
        
            ?>
      </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      var optionsBtn = document.getElementById('options-btn');
      var additionalOptions = document.getElementById('additional-options');

      optionsBtn.addEventListener('click', function() {
          additionalOptions.classList.toggle('show');
      });
  });
  </script>

  
</body>
  </html>