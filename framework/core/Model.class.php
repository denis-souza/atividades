<?php


class Model{
  protected $db; 
  protected $table;
  protected $fields = array();

  public function __construct($table){
    $dbconfig['dbhost'] = DB_HOST;
    $dbconfig['dbname'] = DB_NAME;
    $dbconfig['dbuser'] = DB_USER;
    $dbconfig['dbpass'] = DB_PASS;
    
    $this->db = new Mysql($dbconfig);
    $this->table = $table;
  }

  public function insert($data){
      
    $fields = implode(',', array_keys($data));
    $placeholders = "";

    foreach ($data as $field => $value) {
      $placeholders .= (next($data)) ? ":$field, " : ":$field";
    }
   
    $sql = "INSERT INTO `{$this->table}` ({$fields}) VALUES ($placeholders)";

    $result = $this->db->query($sql, $data);
    
    if (empty($result)) {
      return FALSE;
    }

    return $result;
  }

  public function selectById($key, $value) {

    $sql = "SELECT * FROM $this->table WHERE $key = $value";

    $result = $this->db->query($sql);
    $list = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $list[] = $row;
    }

    return $list;
  }

  public function update($data){}
}