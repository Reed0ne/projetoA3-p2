<?php
session_start();

include('conexao.php');
include('funcoes.php');

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$login = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$selectCpf = "SELECT cpf FROM usuario WHERE cpf = '$cpf'";
$queryCpf = mysqli_query($conexao, $selectCpf);
$dadocpf = mysqli_fetch_row($queryCpf);

$selectlogin = "SELECT login From login WHERE login = '$login'";
$querylogin = mysqli_query($conexao, $selectlogin);
$dadologin = mysqli_fetch_row($querylogin);

if ($nome != NULL) {
    if(($dadocpf == NULL) && ($dadologin == NULL)){
        $insertusuario = "INSERT INTO usuario (nome, cpf, telefone) VALUES ('$nome', '$cpf', '$telefone')";
        $queryusuario = mysqli_query($conexao, $insertusuario);
        $senhacriptografada = criptografar($senha);
        $insertlogin = "INSERT INTO login (cpf, login, senha) VALUES ('$cpf', '$login', '$senhacriptografada')";
        $querylogin = mysqli_query($conexao, $insertlogin);

        echo "<script>
            alert('Usuário cadastrado com sucesso!');
            window.location='add.usuario.php'
        </script>";

    } else {
        echo "<script>
            alert('CPF e/ou Login ja cadastrados!')
            window.location='addusuario.php'
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Users</title>
</head>
<body>
    <center>
        <h1>Adicionar Usuário</h1>

        <form action="#" id="form-addusuario" method="POST">
            <label for="nome">Nome: </label>
            <input type="text" id="nome" name="nome" required> <br>
            <label for="cpf">CPF: </label>
            <input type="text" id="cpf" name="cpf" required> <br>
            <label for="">Telefone: </label>
            <input type="text" id="telefone" name="telefone" required> <br>
            <label for="">Login: </label>
            <input type="text" id="login" name="login" required> <br>
            <label for="">Senha: </label>
            <input type="password" id="senha" name="senha" required> <br> <br>

            <input type="submit" value="Enviar">
        </form>
    </center>
</body>
</html>