<?php

spl_autoload_register(function ($class) {
    require_once 'lib/' . $class . '.php';
});

$config = parse_ini_file("config.ini");
$connector = new Connector($config);
$columns = $connector->getColumns('string_types');
$info = $connector->parse($columns);
//var_dump($info);
//foreach($info as $obj){
//    var_dump($obj->type, $obj->length);
//}
//var_dump(ctype_digit('1'));
//var_dump($connector->getColumns('data'));
//$found = preg_split('/([a-z])/', 'int(10)', 1);

//var_dump($found);