<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Cadastro Cliente</title>
    <link rel="stylesheet" href="./style.css">
    <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
</head>

<body>

    <div class="voltar">
        <a href="index.php"> Sair </a>
    </div>

    <div>
        <h1 class="titulo1">
            Fast Food </h1>

        <h1 class="titulo2">
            Delicious </h1>
    </div>

    <div class="titulo">
        Cadastrar-se
    </div> <br> <br>

    <div class="inputs">

        <form method="POST">

            <div class="NomeCompleto">
                <p> Nome Completo </p>
                <input id="nome_cliente" name="nome_cliente" required="required" type="text" />
            </div> <br>

            <div class="Email">
                <p> Endereco </p>
                <input id="endereco_cliente" name="endereco_cliente" required="required" type="text" />
            </div> <br>

            <div class="Email">
                <p> Email </p>
                <input id="email_cliente" name="email_cliente" required="required" type="text" />
            </div> <br>

            <div class="Senha">
                <p> Senha </p>
                <input id="senha_cliente" name="senha_cliente" required="required" type="password" />
            </div><br>

            <div class="ConfirmaSenha">
                <p> Confirmar Senha </p>
                <input id="confirmar_senha_cliente" name="confirmar_senha_cliente" required="required"
                    type="password" />
            </div> <br>

            <div class="Enviar">
                <button class="button" type="submit">Enviar</button>
            </div>

        </form>

    </div>

    <?php
    
        // Testando o cadastro do cliente ao banco de dados
    
    ?>

</body>

</html>