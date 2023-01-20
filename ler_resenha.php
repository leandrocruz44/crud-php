<?php

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resenha</title>
</head>
<body>
    <?php
    

    if (!empty($_GET)) {
        $id = $_GET['id'];

        $db = connect();

        $resenha_filme = $db->prepare("SELECT nome_filme, resenha FROM avaliacao_de_filmes WHERE id = :id");
        $resenha_filme->execute(["id"=>$id]);
        $resenha = $resenha_filme->fetch(PDO::FETCH_ASSOC);

        $db = null;
    }

    ?>

    <h1>Resenha de <?php print_r($resenha['nome_filme'])?></h1>
    <p style="width: 500px"><?php print_r($resenha['resenha'])?></p>
</body>
</html>