<?php 

use SenhaEletronica\Controller\ApiController;

$app->get('/api/get/all', function(){
    $api = new ApiController();
    echo $api->getAllSenhas();
});

$app->post('/api/get', function(){
    $api = new ApiController();
    echo $api->chamarNovamente($_POST["senha"]);
});

$app->post('/api/proximo', function(){
    $api = new ApiController();
    echo $api->proximo($_POST["senha"]);
});


