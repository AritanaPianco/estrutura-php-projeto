<?php

use Doctrine\Inflector\InflectorFactory;


# QUERY BUILDER
$query = [];

function read(string $table, string $fields = '*'){

    global $query;

    $query = [];
    
    $query['read'] = true;
    $query['table'] = $table;
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

   $rowCount = execute(rowCount:true);   
   
   $page = filter_input(INPUT_GET,'page', FILTER_SANITIZE_STRING);
   
   $page ?? 1; //$page ? $page : 1

   $query['currentPage'] = (int)$page;
   // 7/3 com ceil == 3
   $query['pageCount'] = (int)ceil($rowCount/$perPage); // quantas paginas, divido o total de registros por total de paginas
   
   $offset = ($page - 1) * $perPage;
   // page=1 - 1 = 0*3 = offset=0;  page=2 - 1 = 1*3 = offset=3; page=3 - 1 = 2*3 =offset=6;  page=4 - 1 = 3*3 =ofset=9
   $query['paginate'] = true;
   
   $query['sql'] = "{$query['sql']} limit {$perPage} offset {$offset}";
  // dd($query);

}

function render(){
    global $query;
  
// <nav aria-label="...">
//   <ul class="pagination">
//     <li class="page-item disabled">
//       <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
//     </li>
//     <li class="page-item"><a class="page-link" href="#">1</a></li>
//     <li class="page-item active" aria-current="page">
//       <a class="page-link" href="#">2</a>
//     </li>
//     <li class="page-item"><a class="page-link" href="#">3</a></li>
//     <li class="page-item">
//       <a class="page-link" href="#">Next</a>
//     </li>
//   </ul>
// </nav>

    $pageCount = $query['pageCount']; 
    $currentPage = $query['currentPage'];

    $links = "<ul class='pagination'>";

        if($currentPage > 1){
            // mostro o previous
            $previous = $currentPage - 1; 
            // $links .=  "<li class='page-item'><a class='page-link' href='/?page=1''>Primeira</a></li>";       
            $links .=  "<li class='page-item'><a class='page-link' href='/?page={$previous}''>Previous</a></li>";       
        }    
        
        $class = '';
        for($i=1; $i <= $pageCount; $i++ ){
            $class = $i == $currentPage ? 'active' : ''; 
            $links .=  "<li class='page-item $class'><a class='page-link' href='/?page={$i}''>{$i}</a></li>";    
        }

        if($currentPage < $pageCount){
            // mostro o previous
            $next = $currentPage + 1; 
            // $links .=  "<li class='page-item'><a class='page-link' href='/?page=3''>ultimo</a></li>";       
            $links .=  "<li class='page-item'><a class='page-link' href='/?page={$next}''>Next</a></li>";       
        }
        
    $links .= "</ul>";

    return $links;

}


function where(){
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    // dd($args);
    if(!isset($query['read'])){
        throw new Exception("Antes de chamar o where chame o read");
    }

    if(isset($query['where'])){
        throw new Exception("O where não pode ser chamado se o whereIn já existe");
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
   $data = match($numArgs){
        2 => whereTwoParametes($args),
        3 => whereThreeParametes($args),
        4 => $args

    };

    [$field, $operator, $value, $typeWhere] = $data;

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

function whereIn(string $field, array $data){
    
    global $query;

    if(isset($query['where'])){
        throw new Exception("O whereIn não pode ser chamado se where já existe na query");
    }
    $query['where'] = true;
    $query['sql'] = "{$query['sql']} where {$field} in (".'\''.implode('\',\'', $data).'\''.')';

}


function fieldFK(string $table, string $field){

    $inflector = InflectorFactory::create()->build();
    $tableToSingular = $inflector->singularize($table); // colocou a tabela no singular    
    return $tableToSingular.ucfirst($field); // e depois concatenou com o field que é o id, colocando primeiro letra em maiúsculo, retornando userId

}

function tableJoin(string $table, string $fieldFK, string $typeJoin = 'inner'){
   global $query;

   if(isset($query['where'])){
       throw new Exception("Não posso colocar where antes do join");       
   }

//  dd($query);
   $fkToJoin = fieldFK($query['table'], $fieldFK); // users , id
  
  // dd($fkToJoin); // userId
   $query['sql'] = "{$query['sql']} {$typeJoin} join {$table} on {$table}.{$fkToJoin} = {$query['table']}.$fieldFK";

}

function tableJoinWithFk(string $table, string $fieldFK, string $typeJoin = 'inner'){
    global $query;

   if(isset($query['where'])){
       throw new Exception("Não posso colocar where antes do join");       
   }
   $fkToJoin = fieldFK($table, $fieldFK); // users , id
   
   $query['sql'] = "{$query['sql']} {$typeJoin} join {$table} on {$table}.{$fieldFK} = {$query['table']}.$fkToJoin";

}

// function whereFourParametes(array $args): array{

//     $field = $args[0];
//     $operator = $args[1]; 
//     $value = $args[2]; 
//     $typeWhere = $args[3]; 
         
   
//     return $args;

// }


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


function search(array $search){
     global $query;

     if(isset($query['where'])){
        throw new Exception("Não pode chamar o where na busca");
     }
    
     if(!arrayIsAssociative($search)){
         throw new Exception("Na busca o array tem que ser associativo");            
     }

     $sql = "{$query['sql']} where";

     $execute = [];
     foreach($search as $field => $searched){
          $sql .= " {$field} like :{$field} or";
          $execute[$field] = "%{$searched}%";      
     }
     
     $sql = rtrim($sql,' or');
    //  dd($sql, $execute);

     $query['sql'] = $sql;
     $query['execute'] = $execute;

}



function execute(bool $isFetchAll = true, bool $rowCount = false){
    global $query;
    
    // dd($query);
    
    try {

        $connect = connect(); 
  
        if(!isset($query['sql'])){
            throw new Exception("Precisa ter o sql para executar a query");
        }

        $prepare = $connect->prepare($query['sql']);
        $prepare->execute($query['execute'] ? $query['execute'] : []);
        
        if($rowCount){
            return $prepare->rowCount();
        }   
       
        return $isFetchAll ? $prepare->fetchAll() :  $prepare->fetch();
        
        
                
    }catch (Exception $e) {
        // $message = "Erro no arquivo {$e->getFile()} na linha {$e->getLine()} com a menssagem {$e->getMessage()}"; 
        // $message .= $query['sql'];
        $error = [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
            'sql' => $query['sql'],
            
        ]; 
        ddd($error);     
        
    }
    
    // dd($query);

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