<?php

spl_autoload_register(function ($class) {
    require_once 'lib/' . $class . '.php';
});

$config = parse_ini_file("config.ini");
$connector = new Connector($config);
$core = new Core($connector);
$core->run(2);