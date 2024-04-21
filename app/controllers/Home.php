<?php

namespace app\controllers;

class Home
{
 
   public function index($params){
      // dd(delete('users', ['id' => 7])); 
      // $updated = update('users',['nome' => 'marcelo', 'sobrenome' => 'lima', 'email' => 'marcelo@gmail.com'],['id' => 7]);       
      // $users = all('users');
      $search =  filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);     
   
      read('users', 'nome,sobrenome,email');
         
      if($search){
         search(['nome' => $search]);
      } 
      paginate(3);
   
      $users = execute();
      // tableJoinWithFk('users', 'id');
      
      // whereIn('nome', ['Aritana','alex', 'matheus']);
      
      
      // where('nome', 'maria');
      
      
      // if($search){
         //    search(['nome' => $search, 'sobrenome' => $search]);
         // }
         
         // where('id', '>', 5);
      
         // order('id', 'desc');
         
         // limit(3);
         
         

      // orWhere('sobrenome', '=', 'maia', 'and');
      
      // order();  
      // dd($users);

      return [
        'view' => 'home',
        'data' => ['users' => $users, 'title' => 'Home', 'links' => render()]
      ];


   }

}