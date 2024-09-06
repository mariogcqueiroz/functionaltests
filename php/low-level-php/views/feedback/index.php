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
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $registro): ?>
        <tr>
            <td><?= $registro->id?></td>
            <td><?= $registro->nome?></td>
            <td><?= $registro->email?></td>
            <td><?= htmlspecialchars($registro->feedback)?></td>
            <td>
                <!-- Botão de edição -->
                <a href="/app/feedback/update?id=<?= $registro->id ?>" class="btn btn-primary">Editar</a>
                <!-- Botão de exclusão (com confirmação) -->
                <a href="/app/feddback/delete?id=<?= $registro->id ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>

</html>

