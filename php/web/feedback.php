<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Feedback</title>
    <!-- Adiciona o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Formulário Feedback</h1>
    <form action="/app/feedback" method="post" >
        <p class="text-danger"><?=$erro?></p>
        <div class="form-group">
            <label>
                Nome
                <input type="text" class="form-control" name="name"  placeholder="Digite seu nome" value="<?=$name?>" >
            </label>
        </div>
        <div class="form-group">
            <label>
                Email
                <input type="text" class="form-control" name="email" placeholder="Digite seu email"  value="<?=$email?>">
            </label>
        </div>
        <div class="form-group">
            <label>
                Feedback
                <input type="text"  class="form-control" name="feedback"  placeholder="Digite seu feedback" value="<?=$feedback?>">
            </label>
        </div>
        <input type="submit" value="Enviar" class="btn btn-primary" >
    </form>
</div>

</body>
</html>
