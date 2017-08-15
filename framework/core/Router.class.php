<?php

class Router
{
  const default_action = 'index';
  const default_controller = 'Index';

  protected $request = array();

  public function __construct( $url )
  {
    $this->SetRoute( $url ? $url : self::default_controller );
  }

  /*
  *  The magic gets transforms $router->action into $router->GetAction();
  */
  public function __get( $name )
  {
    if( method_exists( $this, 'Get' . $name ))
      return $this->{'Get' . $name}();
    else
      return null;
  }

  public function SetRoute( $route )
  {
    $route = rtrim( $route, '/' );
    $this->request = explode( '/', $route );
  }

  private function GetAction()
  {
    if( isset( $this->request[2] ))
      return $this->request[2];
    else
      return self::default_action;
  }

  private function GetParams()
  {
    if( count( $this->request ) > 3 )
      return array_slice ( $this->request, 3 );
    else
      return array();
  }

  private function GetPost()
  {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  private function GetPlatform()
  {
    if( isset( $this->request[0] ))
      return $this->request[0];
    else
      return self::default_controller;
  }

  private function GetController()
  {
    if( isset( $this->request[1] ))
      return $this->request[1];
    else
      return self::default_controller;
  }  

  private function GetRequest()
  {
    return $this->request;
  }
}