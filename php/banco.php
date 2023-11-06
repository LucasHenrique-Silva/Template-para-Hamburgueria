<?php
 $db = new SQLite3('hamburgueria.db');
 if($db){
 
 $query = "CREATE TABLE IF NOT EXISTS usuarios (email TEXT PRIMARY
KEY, nome TEXT, passsword TEXT)";

 $db->exec($query); 
 
 } else {
 echo "Desculpe, não foi possível conectar ao banco de dados SQLite 'agenda'.";
 }
?>
