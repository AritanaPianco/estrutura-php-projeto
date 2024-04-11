<?php


function create($table, $data){
   try {
    //insert into users(nome,sobrenome,email,password) values(:nome,:sobrenome,:email,:password);
     $connect = connect();

     $sql = "insert into $table(";
     $sql .= implode(',', array_keys($data)).") values(";
     $sql .= ":" .implode(',:', array_keys($data)).")" ;

     $prepare = $connect->prepare($sql);
     return $prepare->execute($data);

   }catch (PDOException $e) {
       var_dump($e->getMessage());
   }
     
}

