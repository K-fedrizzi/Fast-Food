<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
    <title>Cadastrar Empresa</title>
</head>

<body>

    <header id="topo">
        <nav>
            <div class="logo"> <a href="#"><img src="imagens/pratoheader.png" /></a></div>

            <div>
                <h1 class="titulo1">
                    Fast Food </h1>
                <h1 class="titulo2">
                    Delicious</h1>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cadastro.php">Cliente</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <form method="POST">
        <div class="formulario">
            <br>
            <div class="flex-item">
                <label> Nome Da Empresa </label><br>
                <input class="forms_inputs" id="nome_empresa" name="nome_empresa" required="required" type="text" />
            </div> <br>

            <div class="flex-item">
                <label> Endereco </label><br>
                <input class="forms_inputs" id="endereco_empresa" name="endereco_empresa" required="required" type="text" />
            </div> <br>

            <div class="flex-item">
                <label> Email </label><br>
                <input class="forms_inputs" id="email_empresa" name="email_empresa" required="required" type="tel" />
            </div> <br>


            <div class="flex-item">
                <label> Senha </label><br>
                <input class="forms_inputs" id="senha_empresa" name="senha_empresa" required="required" type="password" />
            </div><br>

            <div class="flex-item">
                <label> Confirmar Senha </label><br>
                <input class="forms_inputs" id="confirmar_senha_empresa" name="confirmar_senha_empresa" required="required"
                    type="password" />
            </div> <br>

            <div class="Enviar">
            <button class="button inputEntrar" type="submit">Enviar</button>
            </div><br>
        </div>
    </form>

    <?php
        include_once '.\..\modelo\Empresa.php';

        if(isset($_POST["nome_empresa"]) && isset($_POST["endereco_empresa"]) && isset( $_POST["email_empresa"]) && isset($_POST["senha_empresa"])){
            $empresa = new Empresa($_POST["nome_empresa"], $_POST["endereco_empresa"], $_POST["email_empresa"], $_POST["senha_empresa"]);
            $empresa->salvar();
            echo  "<script>alert('Empresa Cadastrada Com Suscesso!');</script>";
        }
    ?>

</body>

</html>