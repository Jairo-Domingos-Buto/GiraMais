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