<?php


class Mysql {
 
  private $pdo = FALSE;

  public function __construct ($config) {
    //connect to database
    if (!$this->pdo)  {
      try
      {
        $this->pdo = new PDO('mysql:host=' . $config['dbhost'] . ';dbname=' . $config['dbname'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->pdo;
      }
      catch (PDOException $e)
      {
        print $e->getMessage();
        exit();
      }
    }
    else
    {
      return $this->pdo;
    }
  }

  public function query($sql, $params = array()) {  

    try{

      $stmt = $this->pdo->prepare($sql);

      if (empty($params)) {
        $stmt->execute();
      }
      else{
        foreach ($params as $field => $value) {
          $stmt->bindValue(":$field", $value);
        }

        return $stmt->execute();
      }
          
      return $stmt;
    }
    catch (Exception $e){
      return FALSE;
    }
  }

  public function getAll($sql) {
    $result = $this->query($sql);
    $list = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $list[] = $row;
    }

    return $list;
  }
}