<?php

date_default_timezone_set('America/Sao_Paulo');

if (version_compare(PHP_VERSION, '7.2.5') == -1) {
    die ('A versão mínima do PHP para executar a aplicação é 7.2.5');
}

// Library and App loader
require_once 'Lib/CentralPet/Core/ClassLoader.php';
$loader = new CentralPet\Core\ClassLoader;
$loader->addNamespace('CentralPet', 'Lib/CentralPet');
$loader->addNamespace('App', 'App');
$loader->register();

use App\View\View;
use CentralPet\Environment\EnvironmentVariableLoader;
use CentralPet\Http\Router;

EnvironmentVariableLoader::load(__DIR__);

define('URL', getenv('URL'));

View::init([
    'URL' => URL
]);

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();