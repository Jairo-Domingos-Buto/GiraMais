<?php
session_start();
if (!isset($_SESSION['email'])) {
  // Redireciona para a página de login se o usuário não estiver logado
  header("Location: login.php");
  exit();
}

?>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil do Usuário - Autocarros de Capalanca</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  <div class="app-container">
    <header>
      <div class="header-content">
        <button class="back-btn" onclick="window.history.back()">
          <i class="material-icons">arrow_back</i>
        </button>
        <h1>Meu Perfil</h1>
        <div class="profile-actions">
          <button class="edit-profile-btn" id="editProfileBtn">
            <i class="material-icons">edit</i>
          </button>
        </div>
      </div>
    </header>

    <main class="profile-section">
      <div class="profile-header">
        <div class="profile-avatar">
          <i class="material-icons">account_circle</i>
        </div>
        <div class="profile-name">
          <h2 id="profileName">Nome do Usuário</h2>
          <p id="profileEmail"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="285d5b5d495a4147684b4958494449464b49064947"><?echo $_SESSION['email'];?></a></p>
        </div>
      </div>

      <div class="profile-details">
        <div class="profile-info-section">
          <h3>Informações Pessoais</h3>
          <div class="info-grid">
            <div class="info-item">
              <i class="material-icons">person</i>
              <div>
                <span class="info-label">Nome Completo</span>
                <p id="fullName">Usuário Padrão</p>
              </div>
            </div>
            <div class="info-item">
              <i class="material-icons">email</i>
              <div>
                <span class="info-label">Email</span>
                <p id="emailDetail"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fe8b8d8b9f8c9791be9d9f8e9f929f909d9fd09f91"><?echo $_SESSION['email'];?></a></p>
              </div>
            </div>
          </div>
        </div>

        <div class="profile-financial-section">
          <h3>Informações Financeiras</h3>
          <div class="info-grid">
            <div class="info-item">
              <i class="material-icons">account_balance_wallet</i>
              <div>
                <span class="info-label">Saldo Disponível</span>
                <p id="accountBalance" class="balance">5,000.00 KZ</p>
              </div>
            </div>
            <div class="info-item">
              <i class="material-icons">pin</i>
              <div>
                <span class="info-label">Código de Pagamento</span>
                <p id="paymentPin">• • • •</p>
                <button id="showPinBtn" class="show-pin-btn">
                  <i class="material-icons">visibility</i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <footer class="app-footer">
      <div class="footer-menu">
        <a href="C:\Users\NEMESIS\Downloads\GiraMais\autocarro\autocarro.html" class="footer-item">
          <i class="material-icons">directions_bus</i>
          <span>Autocarros</span>
        </a>
        <a href="/perfil/perfil.php" class="footer-item active">
          <i class="material-icons">account_circle</i>
          <span>Perfil</span>
        </a>
      </div>
    </footer>
  </div>

  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="perfil.js" type="module"></script>
</body>
</html>