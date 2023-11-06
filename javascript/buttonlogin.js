function isUserLogged() {
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie === "isLogged=true") {
      return true;
    }
  }
  return false;
}

// Função para atualizar os links de login com base no estado de login
function updateLoginLinks() {
  var loginLink = document.getElementById("loginLink");
  var logoutLink = document.getElementById("logoutLink");

  if (isUserLogged()) {
    // O usuário está logado, exibe o link de logout
    loginLink.style.display = "none";
    logoutLink.style.display = "block";
  } else {
    // O usuário não está logado, exibe o link de login
    loginLink.style.display = "block";
    logoutLink.style.display = "none";
  }
}

// Verifique o estado de login ao carregar a página
updateLoginLinks();
