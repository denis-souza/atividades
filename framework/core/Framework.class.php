<?php 

class Framework {
  public static function run() {

    self::init();

    self::autoload();

    self::dispatch();
  }

  private static function init() {
 	  
 	  // Define path constants
    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT", getcwd() . DS);
    define("APP_PATH", ROOT . 'application' . DS);
    define("FRAMEWORK_PATH", ROOT . "framework" . DS);
    define("PUBLIC_PATH", DS . "public" . DS);

    define("CONFIG_PATH", APP_PATH . "config" . DS);
    define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
    define("MODEL_PATH", APP_PATH . "models" . DS);
    define("VIEW_PATH", APP_PATH . "views" . DS);
    define("VENDOR", DS . 'vendor' . DS);

    define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);
    define('DB_PATH', FRAMEWORK_PATH . "database" . DS);
    define("LIB_PATH", FRAMEWORK_PATH . "libraries" . DS);
    define("HELPER_PATH", FRAMEWORK_PATH . "helpers" . DS);
    define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);


    // Define platform, controller, action, for example:
    require CORE_PATH . "Router.class.php";

    if (isset($_REQUEST['path'])) {
      $router = new Router($_REQUEST['path']);
      
      $platform = $router->__get('Platform');
      $controller = $router->__get('Controller');
      $action = $router->__get('Action');      
    }

    define("PLATFORM", isset($platform) ? $platform : 'home');
    define("CONTROLLER", isset($controller) ? $controller : 'activities');
    define("ACTION", isset($action) ? $action : 'list');

    define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
    define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);


    // Load core classes
    require CONFIG_PATH . "config.php";
    require CORE_PATH . "Controller.class.php";
    require CORE_PATH . "Loader.class.php";
    require DB_PATH . "Mysql.class.php";
    require CORE_PATH . "Model.class.php";

    // Start session
    session_start();
  }


  private static function autoload() {
  	spl_autoload_register(array(__CLASS__,'load'));
  }

  // Define a custom load method

	private static function load($classname){
	  // Here simply autoload app’s controller and model classes

    if (substr($classname, -10) == "Controller"){
      // Controller
      require_once CURR_CONTROLLER_PATH . "$classname.class.php";
    } 
    elseif (substr($classname, -5) == "Model"){
      // Model
      require_once  MODEL_PATH . "$classname.class.php";
    }
	}


  private static function dispatch() {
  	// Instantiate the controller class and call its action method

    $controller_name = CONTROLLER . "Controller";

    $action_name = ACTION . "Action";

    $controller = new $controller_name;

    $controller->$action_name();

  }
}