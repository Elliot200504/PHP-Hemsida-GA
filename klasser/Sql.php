<?php


class Sql{
  
  public static $databaseFile = 'SQL/databas.db';
  
  public static function connect(){
    
    $conn = new SQLite3(self::$databaseFile);
    return $conn;
    
  }
}

?>