<html>
<head>
    <title>SOCIALSITE</title>
</head>

  <!DOCTYPE html>
  <html lang="sv">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Användare</title>
  </head>


<style>
*{
  box-sizing:border-box;
  margin:0;
  padding:
}

  body {




      margin: 0;
      padding: 0;
      background-image: url('/bakgrundsbild/storbild.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
  }

  .header {
      z-index: 1;
      width:100%;
      background-color: rgba(255, 255, 255, 1);
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
  }

a{
  text-align: center;
  
}
  
  .titel {
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
      color: #333; 
  }

  .banner {
      margin-top: 20px;
  }

  .banner a {
      display: inline-block;
      margin: 0 10px;
      padding: 5px 10px;
      text-decoration: none;
      color: #333; 
      border: 2px solid #333;
      border-radius: 5px;
  }

  .banner a:hover {
      background-color: #333; 
      color: #fff;
  }

  footer {
     z-index:1030123;
      background-color: rgba(0, 0, 0, 1)
      color: #fff;
      padding: 10px;
      text-align: center;
  }

  .userlist {
    text-align: center;
    margin-top: 40px;
    color: black;
  }

  .lista {

    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .lista p {
    margin-bottom: 10px;
  }

  .lista a {
    display: inline-block;
    margin-right: 10px;
    padding: 5px 10px;
    text-decoration: none;
    color: black;
    background-color: white;
    border: 2px solid black;
    border-radius: 5px;
  }

  .lista a:hover {
    background-color: black;
    color: white;
  }

  .lista hr {
    border: none;
    height: 1px;
    background-color: rgba(0, 0, 0, 0.1);
    margin: 20px 0;
  }

  @media screen and (max-width: 600px) {

    body {
        background-image: url('/bakgrundsbild/mobil.png');
    }
    
      .header {
          background-color: rgba(255, 255, 255, 0.8);
          padding: 10px;
          text-align: center;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }
      .titel {
          font-size: 18px;
          font-weight: bold;
      }
      .banner {
          margin-top: 15px;
      }
      .banner a {
          display: block;
          margin: 10px 0;
          padding: 5px 10px;
      }
      .lista {
          margin: 0;
          padding: 10px;
      }
      .lista a {
          display: block;
          margin: 10px 0;
          padding: 5px 10px;
      }
      .lista hr {
          margin: 10px 0;
      }
  }


  
</style>

    <?php
   
    ?>


    <body>
  
      <div class="header">
         <a class="titel" href="/">SOCIALSITE</a>
        <div class="banner">
          <a href="/">Se det senaste</a>
         <a href="/Register">Registrera</a>
         <a href="/Login">Logga in</a>
         <a href="/Users">Alla användare</a>
  <?php
    
          if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
       
        echo "<a href='/Logout'>Logga ut</a>";
          
    }
       echo "<br>";
       echo "<br>";
          
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
              
      echo "<a href='/viewProfile/".$_SESSION['user_id']."'>Till din profil</a>";
           
    }
          ?>
   </div>   
  </div>
    
      <footer></footer>
    </body>

</html>


