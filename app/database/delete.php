<?php


function delete(string $table, array $where)
{

     if(!arrayIsAssociative($where)){
         throw new Exception("O array tem que ser associativo em delete");    
     }
 
     $connect = connect();

     $whereFields = array_keys($where);


     $sql = "delete from $table where";
     $sql .= " $whereFields[0] = :{$whereFields[0]}";

     $prepare = $connect->prepare($sql);
     $prepare->execute($where);
     return $prepare->rowCount(); 

}