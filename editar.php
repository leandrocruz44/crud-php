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
    <?php echo '<link rel="stylesheet" type="text/css" href="style.css" media="screen" />';?>
</head>
<body>
    <a href="index.php">Início</a>
    <a href="cadastrar.php">Cadastrar Filmes</a>
    <a href="consultar.php">Consultar Filmes</a><br><br>
    <h1>Editar Cadastro</h1>
    <?php
        if (!empty($_POST)) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome_filme = trim(strip_tags($_POST['nome_filme']));
            $nota = '';
            $resenha = trim(strip_tags($_POST['resenha']));
            $favorito = '';

            $db = connect();

            if (isset($_POST['nota'])) {
                $nota = $_POST['nota'];
            } else {
                $nota = '';
            }

            if (isset($_POST['favorito'])) {
                $favorito = "sim";
            } else {
                $favorito = "nao";
            }

            if ($nome_filme === '' || $nota === '') {
                echo "Você deve preencher os campos obrigatórios para cadastrar o filme<br><br><br>";
            } else {
                $edit_dados = $db->prepare("UPDATE avaliacao_de_filmes SET nome_filme = :nome_filme, nota = :nota, resenha = :resenha, favorito = :favorito WHERE id = :id");

                $edit_dados->execute(["nome_filme"=>$nome_filme, "nota"=>$nota, "resenha"=>$resenha, "favorito"=>$favorito, "id"=>$id]);

                if ($edit_dados->rowCount()) {
                    echo "Cadastro editado com sucesso! <br><br><br>";
                } else {
                    echo "ERRO - Cadastro não editado. <br><br><br>";
                }
            }

            $db = null;
        }

        if (!empty($_GET)) {
            $filme_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $db = connect();

            $dados_existentes = $db->prepare("SELECT * FROM avaliacao_de_filmes WHERE id = :id");
            $dados_existentes->execute(["id"=>$filme_id]);
            $dados = $dados_existentes->fetch(PDO::FETCH_ASSOC);

            $db = null;
        }

    ?>

    <form name="cadastrar_filme" action="" method="post">
        <input type="hidden" name="id" value="<?=$dados['id']?>">
        
        <label for="nome_filme">Nome do Filme</label><br>
        <input type="text" name="nome_filme" id="nome_filme" value="<?=$dados['nome_filme']?>"><br><br>

        <label for="nota">Nota</label><br>
        <div class="rate">
            <input type="radio" id="star5" name="nota" value="5" <?php if ($dados['nota'] === '5') {echo 'checked';}?> />
            <label for="star5" title="Excelente">5 stars</label>
            <input type="radio" id="star4" name="nota" value="4" <?php if ($dados['nota'] === '4') {echo 'checked';}?> />
            <label for="star4" title="Ótimo">4 stars</label>
            <input type="radio" id="star3" name="nota" value="3" <?php if ($dados['nota'] === '3') {echo 'checked';}?> />
            <label for="star3" title="Bom">3 stars</label>
            <input type="radio" id="star2" name="nota" value="2" <?php if ($dados['nota'] === '2') {echo 'checked';}?> />
            <label for="star2" title="Ruim">2 stars</label>
            <input type="radio" id="star1" name="nota" value="1" <?php if ($dados['nota'] === '1') {echo 'checked';}?> />
            <label for="star1" title="Péssimo">1 star</label>
        </div><br><br><br><br>

        <label for="resenha">Resenha</label><br>
        <textarea name="resenha" id="resenha" cols="30" rows="10"><?=$dados['resenha']?></textarea><br><br>

        <label for="favorito">Favorito?</label>
        <input type="checkbox" name="favorito" id="favorito" <?php if ($dados['favorito'] === 'sim') {echo 'checked';}?>><br><br>

        <input type="submit" name="cadastrar" value="Finalizar">
    </form>
</body>
</html>