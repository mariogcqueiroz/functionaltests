<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles */
    body {
      background-color: #f0f0f0; /* Cor de fundo da página */
    }
    .header {
      background-color: #4169E1; /* Cor de fundo do cabeçalho */
      color: white;
      padding: 20px;
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
  <h1 class="display-4">Feedback</h1>
</div>

<div class="container mt-5">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Feedback</th>
      </tr>
    </thead>
    <tbody>
      <!-- Aqui você pode adicionar linhas com dados -->
      <tr>
        <td><?=$feedback['name']?></td>
        <td><?=$feedback['email']?></td>
        <td><?=$feedback['feedback']?></td>
      </tr>
    </tbody>
  </table>
  <a href="/app/feedback/create" class="btn btn-primary">Criar Novo Feedback</a>
  <a href="/app/feedback/index" class="btn btn-primary">Listar Feedbacks</a>
</div>

<div class="footer">
  <p>Feedback dos Dados</p>
</div>

<!-- Bootstrap JS (opcional, para funcionalidades como dropdowns, etc) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
