<?php
  
class Render 
{

  public static function html($content)
    {


      
      
      // Skydd mot XSS
   $content = htmlspecialchars($content);
      
    $html = file_get_contents("views/profile.php");
    $html = str_replace("{{content}}", $content, $html);
    return $html;
 
   }
}