<?php

namespace app\controllers;

class Home
{
 
   public function index($params){
    
      // dd(delete('users', ['id' => 7])); 
      // $updated = update('users',['nome' => 'marcelo', 'sobrenome' => 'lima', 'email' => 'marcelo@gmail.com'],['id' => 7]);       
      // $users = all('users');
      
      read('users', 'id,nome,sobrenome');
      
      where('id', '>',5);

      orWhere('email', '>' ,'aritanapianco10@gmail.com', 'and');
      
      order('id', 'desc');
      
      limit(5);

      // paginate(5);
      

      // where('id', '>', 5);
      
      // orWhere('sobrenome', '=', 'maia', 'and');
      
      // order();

      
      $users = execute();

      dd($users);

      // return [
      //   'view' => 'home',
      //   'data' => ['users' => $users, 'title' => 'Home']
      // ];

   }

}