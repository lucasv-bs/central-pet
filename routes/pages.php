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
    function() {
        return new Response(200, About::getAbout());
    }
]);

$obRouter->get('/register', [
    function($request) {
        return new Response(200, Register::getRegister($request));
    }
]);

$obRouter->post('/register', [
    function($request) {
        return new Response(200, Register::setNewRegister($request));
    }
]);

$obRouter->get('/register/{id}/edit', [
    function($request, $id) {
        return new Response(200, Register::getRegisterEdit($request, $id));
    }
]);

$obRouter->post('/register/{id}/edit', [
    function($request, $id) {
        return new Response(200, Register::setRegisterEdit($request, $id));
    }
]);

$obRouter->get('/register/{id}/delete', [
    function($request, $id) {
        return new Response(200, Register::getRegisterDelete($request, $id));
    }
]);

$obRouter->get('/report', [
    function() {
        return new Response(200, Report::getReport());
    }
]);