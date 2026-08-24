<style>
  .latestPosts {
    background-color: white;
    color: black;
    padding: 15px;
    border-radius: 8px;
    max-width: 1000px; 
    margin: 0 auto; 
  }

  .Title h2 {
    font-size: 25px;
    margin-bottom: 15px;
  }
  .Kommentarer {
    padding:10px;
    border:1px solid black;
    margin-top: 20px;
  }

  .Kommentarer p {
    font-size:3rem;
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

  .Kommentarer a {
    padding:1%;
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

  .Account {
    margin-bottom: 20px; 
  }

  .post {
    border: 1px solid lightgrey; 
    padding: 8px;
    border-radius: 5px;
  }

  .post-content h3 {
    font-size: 24px;
    margin-bottom: 8px;
  }

  .post-content p {
    font-size: 20px;
    line-height: 1.4;
    margin-bottom: 8px;
  }

  .post-content img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-top: 8px;
  }

  
</style>

<?php 

$latestPosts = Post::getLatestPosts(3); 

 foreach($latestPosts as $post) {

   $user=(User::show($post['post_id']));
 }
?>


<div class="latestPosts">
  <div class="Title">
    <h2>Kolla in de senaste inläggen:</h2>
  </div>
  <?php if(!empty($latestPosts)) { ?>
    <?php foreach($latestPosts as $post) { ?>
      <div class="Account">
        <div class="post">
          <div class="post-content">
            <h3><?php echo $post['title']; ?></h3>
            <p><?php echo $post['description']; ?></p>
   <!--           <p>A</p> -->
            
            <img src="<?php echo $post['image']; ?>" alt="Post Image">
            <?php
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
                } else {
                    echo "";
                }
            } else {
                echo "";
            }

            if(isset($_SESSION["user_id"])){
              $id=$_SESSION["user_id"];
            } else {
              $id=null;
            }
           
              if(isset($_SESSION["logged_in"])){
                echo'
                <form action="/profileComment" method="POST">
                <input type="text" name="comment" placeholder="Lägg en kommentar" required>   
                <input type="hidden" name="post_id" value="'.$post['post_id'].'">
                <input type="hidden" name="id" value="'.$id.'"> 
                </form>';
              }

              echo "</div>";
            ?>       
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } else { ?>
    <p>Inga inlägg hittades</p>
  <?php } ?>
</div>