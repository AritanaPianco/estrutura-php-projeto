<?php


function controller($matchedUri, $params){
      $controller = array_values($matchedUri)[0];
      [$controller, $method] = explode('@',$controller);
      $controllerWithNameSpace = CONTROLLER_PATH.$controller; 

   
     if(!class_exists($controllerWithNameSpace)){
         throw new Exception("controller {$controller} não existe");
     }

     $controllerInstance = new $controllerWithNameSpace();
     

     if(!method_exists($controllerInstance,$method)){
         throw new Exception("O método {$method} não existe no Controller {$controller}"); 
     }

     $controller = $controllerInstance->$method($params);

     if($_SERVER['REQUEST_METHOD'] === 'POST'){
          die();            
     }

     return $controller;

}