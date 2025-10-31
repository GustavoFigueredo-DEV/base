<?php
session_start();

$USUARIO = [
    'nome' => 'Gustavo',
    'email' => 'aluno@senai.com',
    'senha' => '@123456',
];

function estaLogado(): bool {
    return isset ($_SESSION['usuario']);
}

function login(array $usuario, string $nome, string $email, string $senha):bool{
    if($nome === ($usuario['nome']) && $email === ($usuario['email']) && $senha === ($usuario['senha'])) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'nome' => $usuario['nome'], 
            'email' => $usuario['email'], 
            'senha' => $usuario['senha'], 
        ];
        return true;
    }
    return false;
}

function logout(): void{
    $_SESSION=[];
    session_destroy();
}