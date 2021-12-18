<?php

date_default_timezone_set('America/Sao_Paulo');

if (version_compare(PHP_VERSION, '7.2.5') == -1) {
    die ('A versão mínima do PHP para executar a aplicação é 7.2.5');
}

// Library loader
require_once 'Lib/CentralPet/Core/ClassLoader.php';
$library_loader = new CentralPet\Core\ClassLoader;
$library_loader->addNamespace('CentralPet', 'Lib/CentralPet');
$library_loader->register();

// Application loader
require_once 'Lib/CentralPet/Core/AppLoader.php';
$app_loader = new CentralPet\Core\AppLoader;
$app_loader->addDirectory('App/Controller');
$app_loader->addDirectory('App/Model');
$app_loader->addDirectory('App/View');
$app_loader->register();