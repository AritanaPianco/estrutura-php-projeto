<?php

function update(string $table, array $fields, array $where)
{

   if(!arrayIsAssociative($fields) && !arrayIsAssociative($where)){
        throw new Exception("O array tem que ser associativo no update");
   }
   
   $connect = connect();

   $sql = "update $table set ";
   foreach(array_keys($fields) as $field){
       $sql .= "$field = :{$field}, ";   
    }
    $sql = trim($sql, ', ');

    $whereFields = array_keys($where);
    $sql .= " where {$whereFields[0]} = :{$whereFields[0]}";

    $data = array_merge($fields,$where);

    // dd($data);
    // die();
    
    $prepare = $connect->prepare($sql);
    $prepare->execute($data);
    return $prepare->rowCount();

    

}