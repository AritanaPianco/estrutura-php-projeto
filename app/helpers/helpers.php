<?php


function arrayIsAssociative(array $arr)
{
    return array_keys($arr) != range(0, count($arr) - 1);
}


function isAjax()
{
   return (isset($_SERVER['HTTP_HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
}

  
function ddd($data){

    if($_ENV['PRODUCTION'] === 'true'){
          dd('something went wrong');               
  
    }

    dd($data);
}
