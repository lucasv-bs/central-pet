<?php

use CentralPet\Http\Response;


$obRouter->get('/', [
    function() {
        return new Response(200, Home::getHome());
    }
]);

$obRouter->get('/register', [
    function() {
        return new Response(200, Register::getRegister());
    }
]);


$obRouter->get('/about', [
    function($idPagina, $acao) {
        return new Response(200, About::getAbout());
    }
]);