<?php

class EditActivitiesModel extends Model {
  public function getActivity($aid) {
    $result = $this->selectById('aid', $aid);
  
    return array_pop($result);
  }
}