<?php 

$app->get("/", function(){
    require_once __DIR__."/../views/index.html";
});

$app->get("/controlador", function(){
    require_once __DIR__."/../views/controlador.html";
});