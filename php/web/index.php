<?php
$data ="";
$forms_data = [];
if ($_SERVER['REQUEST_URI'] === '/')
	$data="Hello World";
if ($_SERVER['REQUEST_URI'] === '/feedback') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $feedback = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];
        array_push($forms_data, $feedback);
        $data = b"Your feedback submitted successfully.";
    }
}
echo $data;
