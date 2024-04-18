<?php

# QUERY BUILDER

$query = [];

function read(){
    global $query;
    $query['sql'] = 'select * from users';

}


function where(){
    global $query;
    
    $query['where'] = true;
    
    $query['sql'] = "{$query['sql']} where ";
    
}

function orWhere(){
     global $query;

    if(!isset($query['where'])){
        throw new Exception("Precisa executar o where antes do orWhere");
    }
    
    $query['sql'] = "{$query['sql']} or";
}

function search(){
    
}

function paginate(){
    
}

function limit(){
    
    
}

function order(){
    

}



function execute(){
    global $query;

    $connect = connect(); 
    $prepare = $connect->prepare($query['sql']);

    $prepare->execute();

    dd($query);

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