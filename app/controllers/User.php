<?php

namespace app\controllers;

class User
{
    
    public function show($params){

      if(!isset($params['user'])){
          return redirect('/');
       }

       $user = findBy("users", 'id',$params['user']);
      
    }

    public function create(){

        return [
            'view' => 'create.php',
            'data' => ['title' => 'Registrar']
          ];
    }

    public function store(){
       
      $validate = validate([
          'nome' => "required",
          'sobrenome' => "required",
          'email' => "email|unique:users",
          'password' => "required|maxlen:5"
       ]);

        if(!$validate){
           return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);
        
        // var_dump($validate['password']);
        $created = create('users', $validate);
        
        if(!$created){
            setFlash('message', 'Ocorreu erro ao cadastrar usuário, tente novamento');
            return redirect('/user/create'); 
        }

        return \redirect('/');

    }



}