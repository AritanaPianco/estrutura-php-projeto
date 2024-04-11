<?php

require "bootstrap.php";


try {
   $data = router();


   if(!isset($data['data'])){
       throw new Exception("O indice data esta faltando");
   }

   if(!isset($data['data']['title'])){
       throw new Exception("O indice title esta faltando");
   }

   
   if(!isset($data['view'])){ // aqui ja esta verificando se existe esse indice view
      throw new Exception("O indice view esta faltando");
   }
  

   if(!file_exists(VIEWS.$data['view'])){ // aqui ja esta verificando se existe essa view no indice
    throw new Exception("Essa view {$data['view']} não existe");
    
   }

   extract($data['data']);
   $view =  $data['view'];
   require  VIEWS.'master.php';
    
   
} catch (Exception $e) {
    var_dump($e->getMessage());

}
