<?php

class ListActivitiesModel extends Model {
  public function getListActivities() {
    $headers = array('Nome', 'Situação', 'Status', 'Operação');

    $sql = "
      select 
        ac.name, 
        ac.situation,
        st.description,
        ac.aid
      from 
        $this->table as ac
      inner join status as st on st.sid=ac.status_id";
      
    $list = $this->db->getAll($sql);
    
    foreach ($list as $key => &$item) {
      if ($item['situation'] == 1 ) {
        $item['situation'] = 'Ativo';
      }
      else {
        $item['situation'] = 'Inativo';
      }
    }

    return array('headers' => $headers, 'list' => $list);
  }
}