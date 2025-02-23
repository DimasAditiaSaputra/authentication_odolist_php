<?php
namespace Dimas\TodolistPhp\controllers\middleware;

class Middleware{

    // Cek session
    public function status(){
        session_start();
        echo session_status();
    }

}

$tes = new Middleware();
$tes->status();
?>