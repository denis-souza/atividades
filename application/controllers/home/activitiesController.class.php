<?php 

class activitiesController extends Controller{
  
  public function listAction() {
    $title = 'Lista de Atividades';

    $listModel = new ListActivitiesModel("activity");
    $data_list = $listModel->getListActivities();
    
    $assets = array(
      'css' => array(
        VENDOR . 'bootstrap/css/bootstrap.min.css',
        VENDOR . 'bootstrap/css/bootstrap-datepicker.min.css',
        PUBLIC_PATH . 'css/style.css',
      ),
      'js' => array(
        VENDOR . 'tether/tether.min.js',
        VENDOR . 'jquery/jquery-3.2.1.js',
        VENDOR . 'jquery/jquery.validate.min.js',
        VENDOR . 'jquery/messages_pt_BR.js',
        VENDOR . 'bootstrap/js/bootstrap.min.js',
        VENDOR . 'bootstrap/js/bootstrap-datepicker.min.js',
        VENDOR . 'bootstrap/js/locale/bootstrap-datepicker.pt-BR.min.js',
        PUBLIC_PATH . 'js/script.js',
      )
    );

    // Load View template
    include  CURR_VIEW_PATH . "list.html";
  }

  public function formAction() {

    $statusModel = new StatusActivitiesModel("status");
    $data_status = $statusModel->getStatus();
    
    if (isset($_POST['aid']) && !empty($_POST['aid'])) {

      $editModel = new EditActivitiesModel("activity");
      $data_edit = $editModel->getActivity($_POST['aid']);

      foreach ($data_status as $key => $value) {
        if ($key == $data_edit['status_id']) {
          $data_status[$key]['selected'] = TRUE;
        }
      }
    }

    // Load View template
    include  CURR_VIEW_PATH . "form-activity.html";
  }

  public function saveAction() {
    $values = $_POST;
    $saveModel = new SaveActivitiesModel("activity");
    $result = $saveModel->saveActivity($_POST);

    echo json_encode($result);
  }
}