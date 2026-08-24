<?php
session_start();

// Inkluderar filer som skapar tabellen och lägger till data
require_once 'klasser/Sql.php';
require_once 'users/user_tabell.php';
require_once 'klasser/Post.php';
require_once 'klasser/Render.php';
require_once 'klasser/Auth.php';
require_once 'klasser/User.php';
require_once 'router.php';
require_once 'action/debug.php';


post('/Login', "Auth::Login");

post('/profileComment', function(){

$post_id = $_POST['post_id'];
$comment = $_POST['comment'];
$id = $_POST['id'];


$result = Post::createComment($post_id, $comment, $id);


});


post('/viewss/profile', function() {
    $id = $_POST['id'];
    $url = $_POST['url'];
    User::editProfilePicture($id, $url);
});



post('/profilepost', function(){
 
  $id = $_POST['id']; 
  $title = $_POST['title'];
  $description = $_POST['description'];
  $post_picture = $_POST['post_picture'];

  
  $result = Post::createPost($id, $title, $description, $post_picture);

});
  

post('/Register', "Auth::Register");

post('/viewss/profile', function() {
    $id = $_POST['id'];
    $url = $_POST['url'];
    User::editProfilePicture($id, $url);
});

get('/deleteUser/$id', "User::deleteUser");

get('/deleteComment',  function(){
    if (isset($_GET['user_id']) && isset($_GET['post_id'])) {
        $user_id = $_GET['user_id'];
        $post_id = $_GET['post_id'];
      $comment_id = $_GET['comment_id'];
        Post::deleteComment($user_id, $post_id, $comment_id);
    }
    });

get('/deletePost', function(){
if (isset($_GET['user_id']) && isset($_GET['post_id'])) {
    $user_id = $_GET['user_id'];
    $post_id = $_GET['post_id'];
    Post::deletePost($user_id, $post_id);
}
});
get('/Logout', "User::logout");

include("views/start.php");

get("/", function(){

  include("views/latestPost.php");
  
});
  
get('/Login', function(){
    include("views/login_form.html");    
});

get('/Register', function(){
    include("views/registration_form.html");  
});


get('/viewProfile/$id', "views/profile.php");

get('/Users', function(){

  
  $conn = Sql::connect();
  $query = "SELECT * FROM users";
  $result = $conn->query($query);
    if ($result) {
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
        echo '<div class="lista">';
        while ($row = $result->fetchArray()) {
          ?>
          <style>
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
          </style>
          <?php    echo "<br>"; ?>
           <div class="pfp">
         <?php if ($row['user_picture']) {
                 echo "<img src='" . $row['user_picture'] . "' alt='Profile Picture'>";
             } else {
                 // Default bilden
                 echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' alt='Profile Picture'>";
             } ?> 
           </div>
           <p>Användarnamn: <?php out($row['username'])?></p>
           <p>E-post:       <?php out($row['user_email'])?></p>
 <?php echo "     <a href='/viewProfile/{$row['id']}'>View profile</a>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<hr>";

          ?>

          
          <?php
        }

       echo '</div>';
    } 
    else {
        echo "Error: Could not fetch user data.";

    }
  
});


//TEST
get('/theusers/$id', "views/test.php" );

get('/test', function(){

 debug( Post::getLatestPosts() );
  
});

?>

