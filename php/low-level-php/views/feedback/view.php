<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Adiciona o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Fedback </h1>
        <div class="form-group">
            <label>
                Nome:
                <?=$feedback->nome?>
            </label>
        </div>
        <div class="form-group">
            <label>
                Email:
                <?=$feedback->email?>
            </label>
        </div>
        <div class="form-group">
            <label>
                Feddback:
                <?=$feedback->feedback?>
            </label>
        </div>
</div>

<!-- Adiciona o JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

