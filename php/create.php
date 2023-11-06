<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Conectar ao banco de dados SQLite
    $db = new SQLite3('hamburgueria.db');

    if ($db) {
        // Consulta para verificar se o email já está cadastrado
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result->fetchArray(SQLITE3_ASSOC)) {
            $aviso ="Este email já está cadastrado. Tente outro email.";
            header('Location: ../cadastrar.html?aviso=' . urlencode($aviso));
            exit();
        } else {
            // Se o email não estiver cadastrado, insira o novo usuário
            $query = "INSERT INTO usuarios (nome, email, passsword) VALUES (:nome, :email, :passsword)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':passsword', $password, SQLITE3_TEXT);

            // Executar a consulta de inserção
            if ($stmt->execute()) {
                header('Location: ../index.html');
            } else {
             
                $aviso ="Erro ao cadastrar. Tente novamente.";
                header('Location: ../cadastrar.html?aviso=' . urlencode($aviso));
                exit();
                
            }
        }
    } else {
        echo 
        $aviso =  "Desculpe, não foi possível conectar ao banco de dados SQLite 'hamburgueria.db'.";
        header('Location: ../cadastrar.html?aviso=' . urlencode($aviso));
        exit();
    }
}
?>
