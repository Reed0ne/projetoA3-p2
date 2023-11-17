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
            <table border= 1px>
                <tr>
                    <td>Nome</td>
                </tr>

                <?php
                while ($linha = mysqli_fetch_row($queryselect)) { ?>
                    <tr>
                        <td>
                            <a href="chamausuario.php?cod=<?php echo $linha[3] ?>">
                                <?php echo $linha[0] ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
    </center>
</body>
</html>