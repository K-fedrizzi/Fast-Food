<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Login </title>
    <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="login.js" defer></script>
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
                    <li><a href="cadastro.php">Cliente</a></li>
                </ul>
            </div>
        </nav>
    </header>

         
    <div id="login">
            <span class="texto">Login</span><br>
                <form method="post" action=".\login.php">
                  
                    <p>

                        <input id="email_login" name="email_login" required="required" type="text"
                            placeholder="E-mail ou telefone" /> </center>
                    </p>

                    <p>
                        <input id="senha_login" name="senha_login" required="required" type="password"
                            placeholder="Senha" /> </center>
                    </p>

                    <p>
                        <input type="checkbox" name="manterlogado" id="manterlogado" value="" />
                        <label for="manterlogado">Manter-me logado</label>
                    </p>

                    <p>
                    <div class="Entrar">
                        <button class="button inputEntrar" type="submit" >Entrar</button>
                    </div>
                </form>

                </p>
                <div class="Link">
                    <p class="link">
                        Não possui conta?
                        <a href="cadastro.php">Cadastre-se já</a>
                    </p>
                </div>
            </div>

            <?php
                 include_once '.\..\modelo\Cliente.php';
                 if(isset( $_POST['email_login']) && isset($_POST['senha_login'])){

                    $r = Cliente::autenticarUsuario($_POST['email_login'],$_POST['senha_login']);
                 
                    if ( $r == true){
  
                     // Criar Sessão e salva o email e o nome do usuário

                        session_start();
                        $_SESSION['usuario'] = $_POST['email_login'];
                        $_SESSION['nome'] = Cliente::buscarNome($_POST['email_login']);
                        // Chama a proxima página
            
                       header('Location: lista.php');
                      //  require('.\lista.php');
                      
                    } else {
                        echo  "<script>alert('Usuario ou Senha Incorretos!');</script>";
                    }
                 }
                 
                  
            ?>

</body>



</html>