<?php

require "src/conexao-db.php";
require "src/Modelos/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtosRepositorios = new ProdutoRepositorio($pdo);
$dadosCafe = $produtosRepositorios->opcoesCafe();
$dadosAlmoco = $produtosRepositorios->opcoesAlmoco();

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Serenatto Café e Bristrô">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet preload prefetch" as="style" type="text/css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet preload prefetch" as="style" type="text/css" crossorigin="anonymous">
    <title>Serenatto - Cardápio</title>
</head>

<body>
    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-serenatto.png" class="logo" width="3061" height="3061" alt="logo-serenatto">
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php foreach ($dadosCafe as $cafe) : ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="<?= $cafe->getImagemDiretorio() ?>" alt="#">
                        </div>
                        <p><?= $cafe->getNome() ?></p>
                        <p><?= $cafe->getDescricao() ?></p>
                        <p><?= $cafe->getPrecoFormatado() ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php foreach ($dadosAlmoco as $almoco) : ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src="<?= $almoco->getImagemDiretorio() ?>" alt="#">
                        </div>
                        <p><?= $almoco->getNome() ?></p>
                        <p><?= $almoco->getDescricao() ?></p>
                        <p><?= $almoco->getPrecoFormatado() ?></p>
                    </div>
                <?php endforeach ?>
            </div>

        </section>
    </main>
</body>

</html>