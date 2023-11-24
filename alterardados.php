<?php

session_start();

include('conexao.php');
include('funcoes.php');

$cpf = $_SESSION['cpf'];
$select = "SELECT nome, cpf, telefone FROM usuario WHERE cpf ='$cpf'";
$query = mysqli_query($conexao, $select);
$dados = mysqli_fetch_row($query);
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a ação é para atualizar o telefone
    if (isset($_POST['atualizarTelefone'])) {
        if ($telefone <> NULL) {
            $update = "UPDATE usuario SET telefone ='$telefone' WHERE cpf ='$cpf'";
            $queryupdate = mysqli_query($conexao, $update);
            header('Location: alterardados.php');
        }
    }

    // Verifica se a ação é para atualizar a senha
    if (isset($_POST['atualizarSenha'])) {
        $novaSenha = isset($_POST['novaSenha']) ? $_POST['novaSenha'] : '';
        $confirmacaoSenha = isset($_POST['confirmacaoSenha']) ? $_POST['confirmacaoSenha'] : '';

        // Verifica se as senhas coincidem
        if ($novaSenha == $confirmacaoSenha) {
            // Aplica a criptografia à nova senha
            $senhaCriptografada = criptografar($novaSenha);

            // Atualiza a senha criptografada na tabela 'login'
            $updateSenha = "UPDATE login SET senha ='$senhaCriptografada' WHERE cpf ='$cpf'";
            $queryupdateSenha = mysqli_query($conexao, $updateSenha);

            if ($queryupdateSenha) {
                echo '<script>alert("Senha atualizada com sucesso")</script>';
            } else {
                echo '<script>alert("Erro ao atualizar senha")</script>'; mysqli_error($conexao);
            }
        } else {
            echo '<script>alert("Senhas nao coincidem, tente novamente")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
</head>
<body>
    <center>
        <form id="form-altera" action="#" method="POST">
            <table border="1px">
                <tr>
                    <td>Nome </td>
                    <td>Cpf </td>
                    <td>Telefone </td>
                    <td>Atualizar</td>
                </tr>
                <tr>
                    <td><?php echo $dados[0] ?></td>
                    <td><?php echo $dados[1] ?></td>
                    <td><input type="text" name="telefone" value="<?php echo $dados[2] ?>"></td>
                    <td><input type="submit" name="atualizarTelefone" value="Atualizar"></td>
                </tr>
            </table>
        </form>

        <br>

        <form id="form-altera-senha" action="#" method="POST">
            <label for="novaSenha">Nova Senha:</label>
            <input type="password" name="novaSenha" required><br>

            <label for="confirmacaoSenha">Confirmar Senha:</label>
            <input type="password" name="confirmacaoSenha" required><br>

            <input type="submit" name="atualizarSenha" value="Atualizar Senha">
        </form>
    </center>
</body>
</html>