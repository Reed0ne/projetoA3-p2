<?php

session_start();
include('conexao.php');
include('validaradmin.php');

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';

$select = "SELECT nome, descricao, nivel.id, login.cpf FROM usuario
            INNER JOIN login ON usuario.cpf = login.cpf
            INNER JOIN nivel ON nivel.id = nivel";
$queryselect = mysqli_query($conexao, $select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Acesso</title>
</head>
<body>
    <center>
        <form action="mudartipo.php" method="post">
            <table border= 1px>
                <tr>
                    <td>Nome</td>
                    <td>Tipo de Usuário</td>
                    <td>Novo tipo de Usuário</td>
                    <td>Alterar</td>
                </tr>

                <?php
                while ($linha = mysqli_fetch_row($queryselect)) { ?>
                    <tr>
                        <td><?php echo $linha[0] ?></td>
                        <td><?php echo $linha[1] ?></td>
                        <td>
                            <select name="nivel" id="nivel">
                                <option value="1">Administrador</option>
                                <option value="2">Gerente</option>
                                <option value="3">Usuário</option>
                            </select>
                        </td>

                        <td><input type="submit" value="Alterar" name="alterar"></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </center>
</body>
</html>