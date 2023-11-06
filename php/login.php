<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Conectar ao banco de dados SQLite
    $db = new SQLite3('hamburgueria.db');

    if ($db) {
        // Consulta para verificar se o email e senha correspondem
        $query = "SELECT * FROM usuarios WHERE email = :email AND passsword = :password";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute();

        // Verificar se as credenciais são válidas
        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
             // Se o login for bem-sucedido, defina um cookie com o status de login
            setcookie('isLogged', 'true', time() + 3600, '/'); // O cookie expirará em 1 hora

            echo "Login bem-sucedido! Bem-vindo, " . $row['nome'];
            header('Location: ../index.html'); // Redirecionar o usuário para a página 'index.html'
        
        } else {
            $aviso = "Credenciais inválidas. Tente novamente.";
            header('Location: ../login.html?aviso=' . urlencode($aviso));
            exit();
        }
    } else {
            $aviso =  "Desculpe, não foi possível conectar ao banco de dados SQLite 'agenda'.";
            header('Location: ../login.html?aviso=' . urlencode($aviso));
            exit();
    }
}
?>
