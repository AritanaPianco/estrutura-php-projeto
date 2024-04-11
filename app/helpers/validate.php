<?php



function validate(array $validations){

    $result = [];
    $param = '';
    
    foreach($validations as $field => $validate){
        // verificar se não contem barras vai para validação simples,e se contem vai para validação
        $result[$field] = (!strpos($validate, '|'))  ? singleValidation($validate,$field, $param) : mutipleValidations($validate, $field,$param); 
     
    }

    if(in_array(false, $result)){
        return false;            
    }
    return $result;

}

function required($field){
    
    if($_POST[$field] === ''){
        setFlash($field, 'O campo é obrigatório');
        return false;
    }
    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}


function singleValidation($validate,$field, $param){   

     if(strpos($validate,':')){
        [$validate, $param] = explode(':', $validate); // destructuring uma array
     }
     return $validate($field, $param); // o nome das funções tem q ser igual ao nome das validações

}

function mutipleValidations($validate, $field,$param){
    

    $explodePipeValidate = explode('|', $validate);       
         foreach($explodePipeValidate as $validate){
             if(strpos($validate,':')){
             [$validate, $param] = explode(':', $validate); // destructuring uma array     
         }
         $result = $validate($field, $param); // o nome das funções tem q ser igual ao nome das validações                 
        }
    
    return $result;


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