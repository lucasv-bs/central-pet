<?php

date_default_timezone_set('America/Sao_Paulo');

if (version_compare(PHP_VERSION, '7.2.5') == -1) {
    die ('A versão mínima do PHP para executar a aplicação é 7.2.5');
}