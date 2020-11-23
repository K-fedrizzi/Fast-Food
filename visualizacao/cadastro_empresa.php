<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
    <title>Cadastrar Empresa</title>
</head>

<body>
    <form method="POST">

        <div class="NomeCompleto">
            <p> Nome Da Empresa </p>
            <input id="nome_empresa" name="nome_empresa" required="required" type="text" />
        </div> <br>

        <div class="Telefone">
            <p> Endereco Da Empresa </p>
            <input id="telefone_empresa" name="telefone_empresa" required="required" type="text" />
        </div> <br>

        <div class="Email">
            <p> Email Da Empresa </p>
            <input id="email_empresa" name="email_empresa" required="required" type="tel" />
        </div> <br>


        <div class="Senha">
            <p> Senha </p>
            <input id="senha_empresa" name="senha_empresa" required="required" type="password" />
        </div><br>

        <div class="ConfirmaSenha">
            <p> Confirmar Senha </p>
            <input id="confirmar_senha_empresa" name="confirmar_senha_empresa" required="required" type="password" />
        </div> <br>

        <div class="Enviar">
            <button class="button" type="submit">Enviar</button>
        </div>

    </form>

</body>

</html>