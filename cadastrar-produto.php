<?php

require "src/conexao-db.php";
require "src/Modelos/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

if (isset($_POST['cadastro'])) {
    $produto = new Produto(
        null,
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco']
    );

    if ($_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], 
        $produto->getImagemDiretorio());
    }

    $produtoRepositorio = new ProdutoRepositorio($pdo);
    $produtoRepositorio->salvar($produto);

    header("Location: admin.php");
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Página de cadastro de novos produtos">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet preload prefetch" as="style" type="text/css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet preload prefetch" as="style" type="text/css" crossorigin="anonymous">
    <title>Serenatto - Cadastrar Produto</title>
</head>

<body>
    <main>
        <section class="container-admin-banner">
            <img src="img/logo-serenatto-horizontal.png" class="logo-admin" width="1035" height="281" alt="logo-serenatto">
            <h1>Cadastro de Produtos</h1>
            <img class="ornaments" src="img/ornaments-coffee.png" width="3061" height="392" alt="ornaments">
        </section>
        <section class="container-form">
            <form method="post" enctype="multipart/form-data">

                <label for="nome">Nome</label>
                <input name="nome" type="text" id="nome" placeholder="Digite o nome do produto" required>
                <div class="container-radio">
                    <div>
                        <label for="cafe">Café</label>
                        <input type="radio" id="cafe" name="tipo" value="Café" checked>
                    </div>
                    <div>
                        <label for="almoco">Almoço</label>
                        <input type="radio" id="almoco" name="tipo" value="Almoço">
                    </div>
                </div>
                <label for="descricao">Descrição</label>
                <input name="descricao" type="text" id="descricao" placeholder="Digite uma descrição" required>

                <label for="preco">Preço</label>
                <input name="preco" type="text" id="preco" placeholder="Digite uma preço" required>

                <label for="imagem">Envie uma imagem do produto</label>
                <input type="file" name="imagem" accept="image/*" id="imagem" class="form__cadastrar" placeholder="Envie uma imagem">

                <input name="cadastro" type="submit" class="botao-cadastrar" value="Cadastrar produto" />
            </form>

        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/index.js"></script>
</body>

</html>