<?php



function validate(array $validations, bool $persistInputs = false, bool $checkCsrf = false){

    
        if($checkCsrf){
            try {
                checkCsrf();
                //code...
            } catch (Exception $e) {
                dd($e->getMessage());
                die(); 
            }
        }

        
    $result = [];   
    $param = '';
    
    foreach($validations as $field => $validate){
        // verificar se não contem barras vai para validação simples,e se contem vai para validação
        $result[$field] = (!strpos($validate, '|'))  ? singleValidation($validate,$field, $param) : mutipleValidations($validate, $field,$param); 
    }

    if($persistInputs){
        setOld();   
    }


    if(in_array(false, $result)){
        return false;            
    }
    return $result;

}

function singleValidation($validate,$field, $param){   

     if(strpos($validate,':')){
        [$validate, $param] = explode(':', $validate); // destructuring uma array
     }
     return $validate($field, $param); // o nome das funções tem q ser igual ao nome das validações

}

function mutipleValidations($validate, $field,$param){
    

    $explodePipeValidate = explode('|', $validate);
    $result = [];
         foreach($explodePipeValidate as $validate){
             if(strpos($validate,':')){
             [$validate, $param] = explode(':', $validate); // destructuring uma array     
         }

         $result[$field] = $validate($field, $param); // o nome das funções tem q ser igual ao nome das validações                 
         
         if(isset($result[$field]) and $result[$field] === false){
              break;      

         }

        }
    
    return $result[$field];


}


