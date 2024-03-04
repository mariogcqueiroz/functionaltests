<?php

function app() {
    $path = $_SERVER["REQUEST_URI"];
    $method = $_SERVER["REQUEST_METHOD"];
    $data = "";

    if ($path == "/app") {
        $data = "Hello World on php!";
    } elseif ($path == "/app/feedback" && $method == "POST") {
        $name = $_POST['name'];
        $email = $_POST['asdsdd'];
        $feedback = $_POST['feedback'];
        $data = "$name $email $feedback";
    }

    header("Content-Type: text/plain");
    header("Content-Length: " .strlen($data));

    echo $data;
}

app();