<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autocarros</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  <div class="app-container">
    <header>
      <div class="header-content">
        <button class="back-btn"><i class="material-icons">arrow_back</i></button>
        <h1>Autocarros</h1>
        <div class="placeholder"></div>
      </div>
    </header>

    <main>
      <div class="search-section">
        <div class="input-wrapper">
          <i class="material-icons">location_on</i>
          <input type="text" id="paragem-actual" placeholder="Paragem Actual">
        </div>
        <div class="input-wrapper">
          <i class="material-icons">flag</i>
          <input type="text" id="destino" placeholder="Destino">
        </div>
        <button id="pesquisar" class="search-btn">Pesquisar</button>
      </div>

      <div id="resultados" class="bus-list">
        <!-- Bus results will be dynamically populated here -->
      </div>
    </main>
  </div>

  <footer class="app-footer">
    <div class="footer-menu">
      <a href="C:\Users\NEMESIS\Downloads\GiraMais\autocarro\autocarro.html" class="footer-item">
        <i class="material-icons">directions_bus</i>
        <span>Autocarros</span>
      </a>
      <a href="C:\Users\NEMESIS\Downloads\GiraMais\perfil\perfil.html" class="footer-item active">
        <i class="material-icons">account_circle</i>
        <span>Perfil</span>
      </a>
    </div>
  </footer>

  <script src="script.js" type="module"></script>
</body>
</html>