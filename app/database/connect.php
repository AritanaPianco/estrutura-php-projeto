<?php

function connect(){
   return $PDO = new PDO('mysql:host=127.0.0.1;dbname=books', 'aritana', 'ari2002', [
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ

    ]);
}
