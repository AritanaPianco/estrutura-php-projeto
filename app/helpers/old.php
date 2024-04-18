<?php

function setOld(){
  
     $_SESSION['old'] = $_POST ?? [];

}


function getOld($index){

    if(isset($_SESSION['old'][$index])){
         $flash = $_SESSION['old'][$index]; // guardando a mensagem basicamente relacionado a esse campo
         unset($_SESSION['old'][$index]);
        
         return $old ?? '';
     }

}

