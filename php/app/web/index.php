<?php
include_once "../vendor/autoload.php";

use App\Models\Feedback;
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
    $method = $_SERVER["REQUEST_METHOD"];
    if ($path == "/app") {
        echo "Hello World on php!";
    }
    if ($path == "/app/feedback/view") {
        $feedback = Feedback::find($_GET['id']);
        if ($feedback) {
            include('../views/feedback/view.php');
        }
        else {
            $error="Feedback não encontrado";
            http_response_code(404);
            include('../views/404.php');
        }
    }
    if ($path == "/app/feedback/create") {
        $feedback= New Feedback;
        $erro="";
        if ($method == "POST") {
            $feedback->nome=$_POST['name'];
            $feedback->email=$_POST['email'];
            $feedback->feedback= htmlspecialchars($_POST['feedback']);
            if ($feedback->save()) {
                http_response_code(302);
                $redirect_url = '/app/feedback/view?id='.$feedback->id;
                header("Location: " . $redirect_url);
                return;
            } else  $erro="Email deve conter @";
        }
        include('../views/feedback/create.php');
    }
}

app();