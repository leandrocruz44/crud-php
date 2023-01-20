<?php

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
</head>
<body>
    <a href="index.php">Início</a>
    <a href="cadastrar.php">Cadastrar Filmes</a>
    <h1>Filmes Assistidos</h1>
    <?php
        $db = connect();

        $filmesAssistidos = $db->query("SELECT * FROM avaliacao_de_filmes");
        $filmes = $filmesAssistidos->fetchAll(PDO::FETCH_ASSOC);
        function estrelas($nota) {
            switch ($nota) {
                case '5':
                    return '⋆⋆⋆⋆⋆';
                    break;
                case '4':
                    return '⋆⋆⋆⋆';
                    break;
                case '3':
                    return '⋆⋆⋆';
                    break;
                case '2':
                    return '⋆⋆';
                    break;
                case '1':
                    return '⋆';
                    break;
            }
    
        } 

        function checkFavorito($favorito) {
            if ($favorito === 'sim') {
                return '✔';
            }
        }

        $db = null;

    ?>
    <table>
        <thead>
            <th>Filme</th>
            <th>Nota</th>
            <th>Resenha</th>
            <th>Favorito</th>
        </thead>
        <tbody>
            <?php foreach ($filmes as $filme): ?>
                <tr>
                    <td><?=$filme['nome_filme']?></td>
                    <td><?=estrelas($filme['nota'])?></td>
                    <td><a href="ler_resenha.php?id=<?=$filme['id']?>">Ler resenha</td>
                    <td><?=checkFavorito($filme['favorito'])?></td>
                    <td><a href="deletar.php?id=<?=$filme['id']?>">Deletar</td>
                    <td><a href="editar.php?id=<?=$filme['id']?>">Editar</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>