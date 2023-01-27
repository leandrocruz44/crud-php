<?php 

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<?php 
    $db = connect();

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $filme = $db->prepare('SELECT * FROM avaliacao_de_filmes WHERE id = :id');
    $filme->execute(['id'=>$id]);
    $filme_selecionado = $filme->fetch(PDO::FETCH_ASSOC);

    $db = null;

?>
<body class="consultar">
    <div class="container">
        <div class="row">
            <div class="col">
            <div id="cards-container" class="row my-5 justify-content-center">
                    <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                        <div class="card bg-dark text-white border-danger">
                            <div class="card-body">
                                <h5 class="card-title">Tem certeza que deseja deletar <?=$filme_selecionado['nome_filme'];?>?</h5>
                                <div class="row justify-content-around">
                                    <a href="consultar.php" class="btn btn-primary">Cancelar</a>
                                    <a href="deletar.php?id=<?=$filme_selecionado['id'];?>" class="btn btn-danger">Deletar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>