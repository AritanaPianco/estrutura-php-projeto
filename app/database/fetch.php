<?php


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