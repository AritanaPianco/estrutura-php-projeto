<?php

namespace app\controllers;

class Login
{

  // protected $user;

  public function index(){
    return [
        'view' => 'login.php',
        'data' => ['title' => 'Login']
      ];
  }


  public function store(){

     $email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
     $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);

    $user = findBy('users','email',$email);
    

    $_SESSION[LOGGED] = $user; 
    return redirect('/');

  }


  public function destroy(){
      unset($_SESSION[LOGGED]);
      return redirect('/');
  }
    

}