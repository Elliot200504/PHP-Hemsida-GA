<style>
  /* General styling */
  body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
  }

  .info {
      max-width: 600px;
      margin: 0 auto;
  }

  /* Post styling */
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
  
</style>
     <?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }  

      $user=(User::show($id));
      $posts=(Post::showPost($id));
    ?>


  <div class="Profile">
      <div class="Account">
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
          <h2>Upplägg:</h2>
          <div class="info">
              <?php
              // Visar userns posts
            if (count($posts) > 0) {
                foreach ($posts as $post) {
                   echo "<div class='border'>";
                    echo "<h1>" . $post['title'] . "</h1>";
                    echo "<p>" . $post['description'] . "</p>";
                  echo"<br>";
                   echo "<img src='" . $post['image'] . "' alt='Picture'>";
                  echo"<br>";
                   if(isset($_SESSION["logged_in"]) && $_SESSION["user_id"]==$id){
                     echo "<a href='/deletePost?user_id={$user['id']}&post_id={$post['post_id']}'>Delete this post</a>";
                   }
                  echo "</div>";
                  echo"<br>";
                  echo"<br>";

                }
            }
            else{
               echo "<h1>No posts</h1>";
            }
              ?>
          </div>
        <?php
         if(isset($_SESSION["logged_in"]) && $_SESSION["user_id"]==$id){
        echo
          '<div class="edit">
              <!-- Form för att redigera profilbild -->
              <form action="/viewss/profile" method="POST">
                  <input type="text" name="url" placeholder="Ny profilbild" required>     
                  <input type="hidden" value="' . $user['id'] . '" name="id">
                  <input type="submit" value="Ändra">
              </form>
              <br>
              <!-- Form för att lägga in ett nytt upplägg -->
              <form action="/profilepost" method="POST">
                  <input type="text" name="title" placeholder="Title" required>   
                  <input type="text" name="post_picture" placeholder="Bild" required>   
                  <input type="text" name="description" placeholder="Text om ditt uplägg" required>  
                  <input type="hidden" value="' . $user['id'] . '" name="id">
                  <input type="submit" value="Läggupp">
              </form>
          </div>';
          }
            ?>
      </div>
  </html>
