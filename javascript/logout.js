function logoutUser() {
  document.cookie = "isLogged=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  // Atualize os botões após o logout
  updateLoginLinks();
  window.location.href = "index.html";
}
