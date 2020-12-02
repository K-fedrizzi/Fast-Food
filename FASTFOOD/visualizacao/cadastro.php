<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Cadastro Cliente</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
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
                    <li><a href="cadastro_empresa.php">Empresa</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>




    <form action=".\cadastro.php" method="post">
        <div class="formulario">
            <br>
            <div class="flex-item">
                <label>Nome do Cliente</label><br>
                <input class="forms_inputs" id="nome_cliente" name="nome_cliente" required="required" type="text" />
            </div> <br>

            <div class="flex-item">
                <label>Endereco</label><br>
                <input class="forms_inputs" id="endereco_cliente" name="endereco_cliente" required="required" type="text" />
            </div> <br>

            <div class="flex-item">
                <label>Email</label><br>
                <input class="forms_inputs" id="email_cliente" name="email_cliente" required="required" type="text" />
            </div> <br>

            <div class="flex-item">
                <label>Senha</Label><br>
                <input class="forms_inputs" id="senha_cliente" name="senha_cliente" required="required" type="password" />
            </div><br>

            <div class="flex-item">
                <label>Confirmar Senha</label><br>
                <input class="forms_inputs" id="confirmar_senha_cliente" name="confirmar_senha_cliente" required="required"
                    type="password" />
            </div> <br>

            <div class="enviar">
                <button class="button_enviar" type="submit">Enviar</button>
            </div><br>
        </div>
    </form>



    <?php
        include_once '.\..\modelo\Cliente.php';

        if(isset($_POST["nome_cliente"]) && isset($_POST["endereco_cliente"]) && isset( $_POST["email_cliente"]) && isset($_POST["senha_cliente"])){
            $cliente = new Cliente(0,$_POST["nome_cliente"], $_POST["endereco_cliente"], $_POST["email_cliente"], $_POST["senha_cliente"]);
            $cliente->salvar();
            echo  "<script>alert('Cadastro Realizado Com Suscesso!');</script>";
        }
    ?>

</body>

</html>