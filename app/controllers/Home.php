<?php

namespace app\controllers;

class Home
{
 
   public function index($params){
    

      
      // dd(delete('users', ['id' => 7])); 
      // $updated = update('users',['nome' => 'marcelo', 'sobrenome' => 'lima', 'email' => 'marcelo@gmail.com'],['id' => 7]); 
      
      // $users = all('users');
      
      read();

      where();

      orWhere();

      execute();

      // return [
      //   'view' => 'home',
      //   'data' => ['users' => $users, 'title' => 'Home']
      // ];

   }

}