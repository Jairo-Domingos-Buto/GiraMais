<?php
include_once("conn.php");
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  if(empty($email) || empty($senha)){
    $error_message = "Por favor, preencha todos os campos.";
    return;
  }

  $sql = "SELECT email, senha FROM Passageiro WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($valid_email, $valid_password);
  $stmt->fetch();

  if ($stmt->num_rows == 1 && password_verify($senha, $valid_password)) {
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header("Location: dashboard.php");
    exit();
  } else {
    $error_message = "Email ou senha inválidos.";
  }

  $stmt->close();
  $conn->close();
}

?>

<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="Assets/CSS/login_passageiro.css">
</head>
<body>

  <div class="container">
    <h1>Login</h1>

    <form id="login-form"  method="post" action="<?$_SERVER["PHP_SELF"]?>">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="senha" required>
      </div>

      <button type="submit">Entrar</button>
    </form>

    <div id="message" class="hidden"></div>
    <p>Novo passageiro? <a href="cadastro_Passageiro.php">Cadastre-se</a></p>
  </div>

  <script src="login.js"></script>
</body>
</html>