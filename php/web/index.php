<?php

function app() {
    $path = $_SERVER["REQUEST_URI"];
    $method = $_SERVER["REQUEST_METHOD"];
    $data = "";

    if ($path == "/app") {
        $data = "Hello World on php!";
    } else {
        if ($path == "/app/feedback") {
            $name = "";
            $email = "";
            $feedback = "";
            $erro="";
            if ($method == "POST") {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $feedback = $_POST['feedback'];
                if (strpos($email,"@")) {
                    $dsn= "pgsql:host=db;dbname=site;port=5432";
                    $username = 'app';
                    $password = 'app2024';
                    $conexao = new \PDO($dsn, $username, $password);
                    $sql = "INSERT INTO feedback(nome,email,feedback)
                                 VALUES ('$name','$email','feedback')";
                    $conexao->exec($sql);
                    $data = "Dados salvos com sucesso";
                } else {
                    $erro="Email deve conter @";
                    include ('feedback.php');
                }
            }
            else {
                include ('feedback.php');
            }
        }
    }
    echo $data;
}

app();