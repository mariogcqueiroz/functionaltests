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
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Feedback</th>
      </tr>
    </thead>
    <tbody>
      <!-- Aqui você pode adicionar linhas com dados -->
      <?=$feedback['all']?>
    </tbody>
  </table>
  <a href="/app/feedback/create" class="btn btn-primary">Criar Novo Feedback</a>
</div>

<!-- Bootstrap JS (opcional, para funcionalidades como dropdowns, etc) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
