<?php

class SaveActivitiesModel extends Model {
  public function saveActivity($values) {
    
    $data = array(
    	'name' => $values['name'],
    	'description' => $values['description'],
    	'begin_date' => implode('-',array_reverse(explode('/',$values['begin_date']))),
    	'status_id' => $values['status'],
      'situation' => $values['situation'],
    );

    if (!empty($values['end_date'])) {
    	$data['end_date'] = implode('-',array_reverse(explode('/',$values['begin-date'])));
    }
    
    $result = $this->insert($data);
    
    if (empty($result)) {
      return array(
        'status' => 'error',
        'msg' => 'Ocorreu um erro ao tentar salvar a atividade. Contato o suporte!'
      );      
    }

    return array(
      'status' => 'success',
      'msg' => 'Atividade salva com sucesso!'
    );
  }
}