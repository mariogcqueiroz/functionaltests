<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Feedback</title>
    <!-- Adiciona o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        body {
            background-color: #f0f0f0; /* Cor de fundo da página */
        }
        .header {
            background-color: #4169E1; /* Cor de fundo do cabeçalho */
            color: white;
            padding: 20px;
            text-align: center;
        }
        .footer {
            background-color: #000; /* Cor de fundo do rodapé */
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="header">
    <h1 class="display-4">Editando um Feedback</h1>
</div>

<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <form action="/app/feedback/update?id=<?=$feedback['id']?>" method="post" class="w-50">
            <p class="text-danger"><?=$error['email']?></p>
            <div class="form-group">
                <label>
                    Nome
                    <input type="text" class="form-control" name="name" placeholder="Digite seu nome" value="<?=$feedback['name']?>">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Email
                    <input type="text" class="form-control" name="email" placeholder="Digite seu email" value="<?=$feedback['email']?>">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Feedback
                    <input type="text" class="form-control" name="feedback" placeholder="Digite seu feedback" value="<?=$feedback['feedback']?>">
                </label>
            </div>
            <input type="submit" value="Enviar" class="btn btn-primary">
            <a href="/app/feedback/index" class="btn btn-primary">Listar Feedbacks</a>
        </form>
    </div>
</div>

<div class="footer">
    <p>Feedback dos Dados</p>
</div>

</body>
</html>
