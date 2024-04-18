<?php

namespace app\controllers;

class Users
{
   public function index()
   {

       $users = all('users', 'id,nome,sobrenome');
       
       echo json_encode($users);
    

   }

}
