// Função para obter parâmetros da URL
function obterParametroDaURL(nome) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(nome);
}

// Obtenha o aviso da URL
const aviso = obterParametroDaURL("aviso");

// Obtenha o elemento de aviso
const avisoElement = document.getElementById("aviso");

// Verifique se há um aviso e defina o conteúdo do elemento
if (aviso) {
  avisoElement.textContent = aviso;
}
