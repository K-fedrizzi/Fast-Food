<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>index</title>

    </head>

    <body>
    <?php

include_once '.\..\modelo\Banco.php';
include_once '.\..\modelo\Cliente.php';
include_once '.\..\modelo\Empresa.php';
include_once '.\..\modelo\Produto.php';
include_once '.\..\modelo\Cliente_avaliacao_produto.php';
include_once '.\..\modelo\Comentario.php';

/**
 * Cria um banco de dados para o projeto
 */
try{

    Banco::createSchema();
    // testando dados para cliente
    $teste=Produto::buscar(1);
    if(is_null($teste) ){
$cliente = new Cliente(0,"Carlos Augusto","Rua teste","teste@gmail.com","123456");
$cliente->salvar();

$cliente2 = new Cliente(0,"Joseph Pinto","Rua teste2","teste2@gmail.com","1234567");
$cliente2->salvar();

// testando dados para Empresa
$empresa = new Empresa("Pao Dhora","Rua teste","teste@gmail.com","123456");
$empresa->salvar();

$empresa2 = new Empresa("Sorvete CIA","Rua teste2","teste2@gmail.com","123456");
$empresa2->salvar();

//produto
$produto= new Produto(1,"Esfiha","imagens/Esfirra.jpg","Esfiha de carne e de frango;", (float)15,  (float)0,"1");
$produto->salvar();
$produto= new Produto(2,"Pão Francês","imagens/Pao_frances.jpg","Pão quentinho da hora;",  (float)11,  (float)0,"1");
$produto->salvar();
$produto= new Produto(3,"Moreninha","imagens/Moreninha_baunilha.jpg","Moreninha de baunilha.",  (float)15, (float) 0,"2");
$produto->salvar();
$produto= new Produto(4,"Picolé","imagens/Picole.jpg","Picolé de Frutas.", (float) 11,  (float)0,"2");
$produto->salvar();

//avaliacao de produto
$avaliacao= new Cliente_avaliacao_produto(1,1,4);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(1,2,3);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(1,3,2);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(1,4,5);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(2,1,3);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(2,2,2);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(2,3,1);
$avaliacao->salvar();
$avaliacao= new Cliente_avaliacao_produto(2,4,5);
$avaliacao->salvar();
//$avaliacao= new Cliente_avaliacao_produto(3,1,5);
//$avaliacao->salvar();
//comentários em produtos
$comentario= new Comentario(0,"Valeu a pena!",1,1);
$comentario->salvar();
$comentario= new Comentario(0,"Gostei demais!",1,1);
$comentario->salvar();
$comentario= new Comentario(0,"Também adorei!",1,2);
$comentario->salvar();

$comentario= new Comentario(0,"Mediano",2,2);
$comentario->salvar();
$comentario= new Comentario(0,"É, dá para melhorar!",2,1);
$comentario->salvar();
$comentario= new Comentario(0,"Concordo!",2,2);
$comentario->salvar();


$comentario= new Comentario(0,"Nao gostei muito!",3,1);
$comentario->salvar();
$comentario= new Comentario(0,"Pouco sabor",3,1);
$comentario->salvar();


$comentario= new Comentario(0,"Achei gostoso",4,1);
$comentario->salvar();
$comentario= new Comentario(0,"Sério?",4,2);
$comentario->salvar();
$comentario= new Comentario(0,"Aham",4,1);
$comentario->salvar();
$comentario= new Comentario(0,"Vou comprar!",4,2);
$comentario->salvar();}

    
} catch (\Throwable $th) {
    echo $th;
    die(1);
}


?>
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
                    <li><a href="#suporte">Suporte</a></li>
                    <li><a href="cadastro_empresa.php">Empresa</a></li>
                    <li><a href="cadastro.php">Cliente</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section>
        <div></div>
    </section>
    <section class="sect1">
        <!-- <div class="navegadorPromocao">
                <button class="navegarEsquerda" > <img src="setaE.jpg" alt="navegarEsquerda" class="seta"></button>
             <button class="navegarDireita" > <img src="setaD.png" alt="navegarDireita" class="seta"></button>
           </div> -->
        <div class="boxPromocao">
            <div class="titulo">
                <div>
                    <h2>Promoções do Dia!</h2>
                </div>
            </div>
            <div class="listaPromocao">
                <ul class="lista">
                    <li><img src="imagens/acai.jpg" alt="promo1"></li>
                    <li><img src="imagens/mac.png" alt="promo2"></li>
                </ul>
            </div>
        </div>
        <div class="itemCaixa1"><a href="login.php">Ver Todos</a></div>
    </section>
    <section class="sect2">
        <!-- <div class="navegadorPromocao">
                 <button class="navegarEsquerda" > <img src="setaE.jpg" alt="navegarEsquerda" class="seta"></button>
              <button class="navegarDireita" > <img src="setaD.png" alt="navegarDireita" class="seta"></button>
            </div> -->
        <div class="boxPromocao2">
            <div class="titulo">
                <div>
                    <h2>Oferta da Semana!</h2>
                </div>
            </div>
            <div class="listaPromocao2">
                <ul class="lista2">
                    <li><img src="imagens/salgado.png" alt="promo1"></li>
                    <li><img src="imagens/pizza.png" alt="promo2"></li>
                    <li><img src="imagens/refeicao.png" alt="promo3"></li>
                </ul>
            </div>
        </div>
        <div class="itemCaixa2"><a href="login.php">Ver Todos</a></div>
    </section>
    <section id="suporte" class="suporte">
        <div>
            <h3>Suporte</h3>
        </div>
        <div>
            <img src="imagens/tel.png" alt="telefone">
            <p> <a href="tel:67981302083">(67)98130-2083</a></p>
        </div>
        <div>
            <img src="imagens/mail.png" alt="email">
            <p><a href="mailto:tiagovarmassera@gmail.com">tiagovarmassera@gmail.com</a></p>
        </div>
    </section>
    <footer>
        <a href="#topo">VOTAR</a>
    </footer>
</body>
</html>