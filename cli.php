<?php

spl_autoload_register(function ($class) {
    require_once 'lib/' . $class . '.php';
});

$config = parse_ini_file("config.ini");
$connector = new Connector($config);
$columns = $connector->getColumns('data');
$info = $connector->parse($columns);
//var_dump($info);
//var_dump($connector->getColumns('data'));
$found = preg_split('/([a-z])/', 'int(10)', 1);

var_dump($found);