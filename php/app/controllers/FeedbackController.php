<?php

namespace App\controllers;
use App\Models\Feedback;

class FeedbackController
{
    public function create()
    {
        $feedback= New Feedback;
        $erro="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    public function view($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            include('../views/feedback/view.php');
        }
        else {
            $error="Feedback não encontrado";
            http_response_code(404);
            include('../views/404.php');
        }
    }
    public function index()
    {
        $results=Feedback::all();
        include('../views/feedback/index.php');
    }
    public function delete($id)
    {
        $feedback = Feedback::find($id);
        if($feedback){
            $feedback->delete();
            http_response_code(302);
            $redirect_url = '/app/feedback/index';
            header("Location: " . $redirect_url);
            return;
        }
        $error="Feedback não encontrado";
        http_response_code(404);
        include('../views/404.php');
    }

}