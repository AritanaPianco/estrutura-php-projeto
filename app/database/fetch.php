<?php

# QUERY BUILDER
$query = [];

function read(string $table, string $fields = '*'){

    global $query;
    $query['read'] = true;
    $query['execute'] = [];
    $query['sql'] = "select $fields from $table";

}

function limit(string|int $limit){
    global $query;

    $query['limit'] = true;

    if(isset($query['paginate'])){ 
        throw new Exception("O limite não pode ser chamado junto com paginate");
     }

    $query['sql'] = "{$query['sql']} limit $limit"; 

}


function order(string $by,string $order = 'ASC'){
    global $query;

    if(isset($query['limit'])){ // quando chamo essa função primeiro o limit não estará setado ainda(não estará true ainda)
        throw new Exception("O order não pode vir depois do limite");
    }

    if(isset($query['paginate'])){ 
        throw new Exception("O order não pode vir depois da paginação");
    }

    $query['sql'] = "{$query['sql']} order by $by $order"; 

}


function paginate(string|int $perPage = 10){

    global $query;

   if(isset($query['limit'])){ 
      throw new Exception("A paginação não pode ser chamada com o limit");
   }

   $query['paginate'] = true;

}

function where(){
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    // dd($args);

    if(!isset($query['read'])){
        throw new Exception("Antes de chamar o where chame o read");
    }

    if($numArgs < 2 || $numArgs > 3){
        throw new Exception("O where precisa de 2 ou 3 parametros");
    }

    if($numArgs == 2){
        $field = $args[0];
        $operator = '='; 
        $value = $args[1]; 
    };

    if($numArgs == 3){
        $field = $args[0];
        $operator = $args[1]; 
        $value = $args[2]; 
    };


    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] = "{$query['sql']} where $field $operator :{$field}";   

}


// function where(string $field,string $operator,string|int $value){
//     global $query;

//     if(!isset($query['read'])){
//         throw new Exception("Antes de chamar o where chame o read");
//     }

//     if(func_num_args() != 3){
//         throw new Exception("O where precisa de extamente 3 parametros");
//     } 
//     $query['where'] = true;
//     $query['execute'] = array_merge($query['execute'], [$field => $value]);
//     $query['sql'] = "{$query['sql']} where $field $operator :{$field}";   
// }


function orWhere(){

    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    if(!isset($query['read'])){
        throw new Exception("Antes de chamar o where chame o read");
    }

    if(!isset($query['where'])){
        throw new Exception("Antes de chamar o orWhere chame o where");
    }

    if($numArgs < 2 || $numArgs > 4){
        throw new Exception("O where precisa de 2 até 4 parametros");
    }

    // O código dentro de cada bloco é executado se a expressão $args 
    // corresponder à chave especificada (2, 3 ou 4, respectivamente).
   $data = match($args){
        2 => whereTwoParametes($args),
        3 => whereThreeParametes($args),
        4 => whereFourParametes($args),

    };

    list($field, $operator, $value, $typeWhere) = $data;

    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] = "{$query['sql']} $typeWhere $field $operator :{$field}";   

}

function whereTwoParametes(array $args): array{
    $field = $args[0];
    $operator = '='; 
    $value = $args[1]; 
    $typeWhere = 'or'; 

    return [$field, $operator, $value, $typeWhere];
    
}

function whereThreeParametes(array $args): array{
    
    $operators = ['=', '<','>', '!=', '<=', '>='];
    $field = $args[0];
    $operator = in_array($args[1], $operators) ? $args[1] : '=';
    $value = in_array($args[1], $operators) ? $args[2] :  $args[1];
    $typeWhere = $args[2] == 'and' ? 'and' : 'or'; // se não significa que n foi colocado nehum valor, por padrão or
    
    return [$field, $operator, $value, $typeWhere];
    
}

function whereFourParametes(array $args): array{

    $field = $args[0];
    $operator = $args[1]; 
    $value = $args[2]; 
    $typeWhere = $args[3]; 

    return [$field, $operator, $value, $typeWhere];

}


// function orWhere(string $field,string $operator,string|int $value, string $typeWhere = 'or'){

//     global $query;

//     if(!isset($query['read'])){
//         throw new Exception("Antes de chamar o where chame o read");
//     }

//     if(!isset($query['where'])){
//         throw new Exception("Antes de chamar o orWhere chame o where");
//     }

//     if(func_num_args() < 3 or func_num_args() > 4){
//         throw new Exception("O where precisa de 3 ou 4 parametros");
//     }


//     $query['where'] = true;
//     $query['execute'] = array_merge($query['execute'], [$field => $value]);
//     $query['sql'] = "{$query['sql']} $typeWhere $field $operator :{$field}";   

// }





// function search(){
    
// }

// function paginate(){
    
// }

// function limit(){
    
    
// }

// function order(){
    

// }


function execute(){
    global $query;

    $connect = connect(); 
    $prepare = $connect->prepare($query['sql']);
    $prepare->execute($query['execute'] ? $query['execute'] : []);

    dd($query);
    return $prepare->fetchAll();
    

}


# QUERY COMPLETA
function all($table, $fields = "*")
{
    try {
        //code...
       $connect = connect();
       $query = $connect->query("Select {$fields} from {$table};");
       return $query->fetchAll();

    } catch (PDOException $e) {
        //throw $th;
        var_dump($e->getMessage());
    }

}


function findBy($table, $field,$value, $fields = "*")
{
   try {
       $connect = connect();
       $prepare = $connect->prepare("select $fields from $table where {$field} = :{$field}");
       $prepare->execute([
           $field => $value   
       ]);
       return $prepare->fetch();
       //code...
   } catch(PDOException $e){
       //throw $th;
       var_dump($e->getMessage());
   }
  
}