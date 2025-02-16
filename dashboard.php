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
  <title>Autocarros</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    :root {
  --primary-color: #007bff;
  --background-color: #f0f0f0;
  --card-background: #ffffff;
  --text-color: #333;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background-color: var(--background-color);
  color: var(--text-color);
  line-height: 1.6;
}

.app-container {
  max-width: 480px;
  margin: 0 auto;
  background-color: white;
  min-height: 100vh;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

header {
  background-color: var(--primary-color);
  color: white;
  padding: 15px;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.back-btn, .placeholder {
  width: 100%;
  text-align:center ;
}

.back-btn {
  background: none;
  border: none;
  color: white;
  font-size: 24px;
  cursor: pointer;
}

h1 {
  text-align: center;
  font-size: 20px;
  font-weight: 600;
}

.search-section {
  padding: 15px;
  background-color: white;
}

.input-wrapper {
  display: flex;
  align-items: center;
  background-color: var(--background-color);
  border-radius: 8px;
  margin-bottom: 15px;
  padding: 10px;
}

.input-wrapper i {
  margin-right: 10px;
  color: var(--primary-color);
}

.input-wrapper input {
  flex-grow: 1;
  border: none;
  background: transparent;
  font-size: 16px;
}

.search-btn {
  width: 100%;
  background-color: var(--primary-color);
  color: white;
  border: none;
  padding: 12px;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.search-btn:hover {
  background-color: darken(#007bff, 10%);
}

.bus-list {
  padding: 15px;
}

.autocarro {
  background-color: var(--card-background);
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.autocarro h3 {
  color: var(--primary-color);
  margin-bottom: 10px;
  display: flex;
  align-items: center;
}

.autocarro h3::before {
  content: '🚌';
  margin-right: 10px;
}

.autocarro p {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
  color: #666;
}

.autocarro p strong {
  color: var(--primary-color);
  margin-right: 5px;
}

.app-footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: white;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
}

.footer-menu {
  display: flex;
  justify-content: space-around;
  padding: 10px 0;
}

.footer-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
  color: var(--text-color);
  opacity: 0.6;
}

.footer-item.active,
.footer-item:hover {
  color: var(--primary-color);
  opacity: 1;
}

.footer-item i {
  font-size: 24px;
}

.footer-item span {
  font-size: 12px;
  margin-top: 5px;
}
.resultados{
  overflow-y: scroll;
}
  </style>
</head>
<body>
  <div class="app-container">
    <header>

      <div class="header-content">
        <button class="back-btn"><i class="material-icons">arrow_back</i></button>
        <h1>Autocarros</h1>
        
      </div>
      <div class="placeholder">
          <p>email:<?echo $_SESSION['email']?></p>
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
      <a href="./perfil/perfil.php" class="footer-item active">
        <i class="material-icons">account_circle</i>
        <span>Perfil</span>
      </a>
    </div>
  </footer>

  <script>
    // Bus route and timing data
const rotaCapalanca = {
  nome: 'Capalanca - Largo das Escolas',
  paragens: [
    { nome: 'Capalanca', tempoAcumulado: 0 },
    { nome: 'Vila de Viana', tempoAcumulado: 10 },
    { nome: 'SGT', tempoAcumulado: 20 },
    { nome: 'Ponte Partida', tempoAcumulado: 30 },
    { nome: 'SonaGalp', tempoAcumulado: 40 },
    { nome: 'Estalagem', tempoAcumulado: 50 },
    { nome: 'Moagem', tempoAcumulado: 60 },
    { nome: 'Escongolenses', tempoAcumulado: 70 },
    { nome: 'Largo das Escolas', tempoAcumulado: 80 }
  ]
};

// Bus data with current location and route
const autocarros = [
  {
    numero: '0001',
    rota: rotaCapalanca,
    paragemActual: 'Estalagem',
    tempoParaProximaParagem: 10
  },
  {
    numero: '0002',
    rota: rotaCapalanca,
    paragemActual: 'Moagem',
    tempoParaProximaParagem: 10
  },
  {
    numero: '0003',
    rota: rotaCapalanca,
    paragemActual: 'SGT',
    tempoParaProximaParagem: 10
  }
];

function encontrarProximaParagem(autocarro) {
  const indiceActual = autocarro.rota.paragens.findIndex(
    p => p.nome === autocarro.paragemActual
  );
  
  return indiceActual < autocarro.rota.paragens.length - 1
    ? autocarro.rota.paragens[indiceActual + 1]
    : null;
}

function filtrarAutocarros(paragemActual, destino) {
  return autocarros.filter(autocarro => {
    const rotaParagens = autocarro.rota.paragens.map(p => p.nome);
    
    const indiceParagemActual = rotaParagens.findIndex(
      p => p.toLowerCase() === paragemActual.toLowerCase()
    );
    
    const indiceDestino = rotaParagens.findIndex(
      p => p.toLowerCase() === destino.toLowerCase()
    );
    
    return (
      (paragemActual === '' || indiceParagemActual !== -1) &&
      (destino === '' || indiceDestino !== -1) &&
      (indiceDestino === -1 || indiceDestino > indiceParagemActual)
    );
  });
}

document.getElementById('pesquisar').addEventListener('click', function () {
  const paragemActual = document.getElementById('paragem-actual').value.trim();
  const destino = document.getElementById('destino').value.trim();

  const autocarrosFiltrados = filtrarAutocarros(paragemActual, destino);

  const resultadosDiv = document.getElementById('resultados');
  resultadosDiv.innerHTML = ''; 

  if (autocarrosFiltrados.length === 0) {
    resultadosDiv.innerHTML = '<p>Nenhum autocarro encontrado.</p>';
    return;
  }

  autocarrosFiltrados.forEach(autocarro => {
    const proximaParagem = encontrarProximaParagem(autocarro);
    
    const autocarroDiv = document.createElement('div');
    autocarroDiv.classList.add('autocarro');

    autocarroDiv.innerHTML = `
      <h3>Autocarro ${autocarro.numero}</h3>
      <p><strong>Rota:</strong> ${autocarro.rota.nome}</p>
      <p><strong>Paragem Actual:</strong> ${autocarro.paragemActual}</p>
      <p><strong>Próxima Paragem:</strong> ${proximaParagem ? proximaParagem.nome : 'Fim da Rota'}</p>
      <p><strong>Tempo para próxima paragem:</strong> ${autocarro.tempoParaProximaParagem} minutos</p>
    `;

    resultadosDiv.appendChild(autocarroDiv);
  });
});
  </script>
</body>
</html>