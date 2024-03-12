<?php
include_once "../vendor/autoload.php";

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Feedback extends Model
{
    protected $table = 'feedback';
    public $timestamps = false;
}


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
    $path = $_SERVER["REQUEST_URI"];
    $method = $_SERVER["REQUEST_METHOD"];


    if ($path == "/app") {
        echo "Hello World on php!";
    } else {
        if ($path == "/app/feedback") {
            $feedback= New Feedback;
            $erro="";
            if ($method == "POST") {
                $feedback->nome=$_POST['name'];
                $feedback->email=$_POST['email'];
                $feedback->feedback= htmlspecialchars($_POST['feedback']);
                if (strpos($feedback->email,"@")) {
                    $feedback->save();
                    include ('../views/view.php');
                } else {
                    $erro="Email deve conter @";
                    include ('../views/feedback.php');
                }
            }
            else {
                include ('../views/feedback.php');
            }
        }
    }

}

app();