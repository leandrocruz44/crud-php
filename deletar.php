<?php

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Início</a>
    <a href="cadastrar.php">Cadastrar Filmes</a>
    <a href="consultar.php">Consultar Filmes</a><br><br>
    <?php

    if (!empty($_GET)) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $db = connect();

        $deletar_filme = $db->prepare("DELETE FROM avaliacao_de_filmes WHERE id = :id");
        $deletar_filme->execute(["id"=>$id]);

        $db = null;

        header('location:consultar.php');
    }
    ?>
</body>
</html>





