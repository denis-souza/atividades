<?php

class StatusActivitiesModel extends Model{
  public function getStatus(){
    $sql = "select * from $this->table";
    $status = $this->db->getAll($sql);
    
    return $status;
  }
}