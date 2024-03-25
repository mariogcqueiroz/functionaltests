<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Registros</title>
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

<h1>Feedbacks</h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Feedback</th>
    </tr>
    </thead>
    <tbody>
    <?php /** @var array $results */
    foreach ($results as $registro): ?>
        <tr>
            <td><?= $registro->id?></td>
            <td><?= $registro->nome?></td>
            <td><?= $registro->email?></td>
            <td><?= $registro->feedback?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>

</html>

