<?php
include_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
  $saldo = $_POST['saldo'];


  $sql = "INSERT INTO Passageiro (nome, email, senha, saldo) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssd", $name, $email, $senha, $saldo);

  if ($stmt->execute()) {
    echo "<div id='message'>Cadastro realizado com sucesso!</div>";
  } else {
    echo "<div id='message'>Erro ao cadastrar: " . $stmt->error . "</div>";
  }

  $stmt->close();
  $conn->close();
}
?>



<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Passageiro</title>
  <link rel="stylesheet" href="Assets/CSS/passageiro_cadastro.css">
</head>
<body>

  <div class="container">
    <h1>Cadastro de Passageiro</h1>

    <form id="passenger-form" method="post" action="<?$_SERVER["PHP_SELF"]?>">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="senha" required>
      </div>

      <div class="form-group">
        <label for="saldo">Saldo Inicial:</label>
        <input type="number" id="saldo" name="saldo" min="0" step="0.01" required>
      </div>

      <button type="submit">Cadastrar</button>
    </form>

    <div id="message" class="hidden"></div>
    <p>Ja sou passageiro <a href="login_passageiro.php">Logar</a></p>
  </div>

  <script src="script.js"></script>
</body>
</html>