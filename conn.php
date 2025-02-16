<?php

$conn = new mysqli("127.0.0.1", "Jairo-Dev", "Jair!Dev22", "GiraMais");

if($conn->connect_error){
    die("Conexão falhou: " . $conexao->connect_error);
}