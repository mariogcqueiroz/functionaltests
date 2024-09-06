<?php
include_once "../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule= New Capsule;
$capsule->addConnection([
    "driver"=>"pgsql",
    "host"=>"db",
    "database"=>"site",
    "username"=>"app",
    "password"=>"app2024"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

function app() {
    $path = parse_url($_SERVER["REQUEST_URI"])["path"];
    $path_array= explode('/',$path);
    $classname= '\\App\\controllers\\'.ucfirst($path_array[2]).'Controller';
    $instance = new $classname();
    parse_str($_SERVER['QUERY_STRING'], $param);
    $instance->{$path_array[3]??'index'}(...array_values($param));
}

app();