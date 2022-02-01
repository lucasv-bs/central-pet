<?php

use App\Controller\Pages\About;
use App\Controller\Pages\Home;
use App\Controller\Pages\Register;
use App\Controller\Pages\Report;
use CentralPet\Http\Response;


$obRouter->get('/', [
    function() {
        return new Response(200, Home::getHome());
    }
]);

$obRouter->get('/about', [
    function($idPagina, $acao) {
        return new Response(200, About::getAbout());
    }
]);

$obRouter->get('/register', [
    function() {
        return new Response(200, Register::getRegister());
    }
]);

$obRouter->post('/register', [
    function($request) {
        return new Response(200, Register::setNewRegister($request));
    }
]);

$obRouter->get('/report', [
    function() {
        return new Response(200, Report::getReport());
    }
]);