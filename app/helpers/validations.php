<?php

function required($field){
    
    if($_POST[$field] === ''){
        setFlash($field, 'O campo é obrigatório');
        return false;
    }
    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}



function email($field){
   
   $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

   if(!$emailIsValid){
       setFlash($field, 'O campo tem que ser um email valido');
       return false;
   }
   // se ja foi validado
   return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
  

}

function unique($field, $param){

    $data = filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);
    $user = findBy($param,$field,$data);

    if($user){
        setFlash($field, 'O email já esta cadastrado');
        return false;
    }

    return $data;

}

function maxlen($field, $param){
    
      $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
      
      if(strlen($data) > $param){
         setFlash($field, "O campo não pode ser maior que $param caracteres");
         return false;
      }

      return $data;

}
