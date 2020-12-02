<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
         <link rel="stylesheet" type="text/css" href="stylesLista.css" />
         <link rel="stylesheet" type="text/css" href="styles.css">
         <link rel="stylesheet" type="text/css" href="pedidos.css">
        <title>Lista</title>
        <script type="text/javascript" src="listaJS.js" defer></script>
    </head>

    <body>
  

<!--topo da página com menu -->
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
                <li><a href="lista.php">Produtos</a></li>
            <li><a href="login.php">Sair</a></li>
                </ul>
            </div>
        </nav>
   
</header>
        <?php

include_once '.\..\modelo\Banco.php';
include_once '.\..\modelo\Cliente.php';
include_once '.\..\modelo\Empresa.php';
include_once '.\..\modelo\Produto.php';
include_once '.\..\modelo\Cliente_avaliacao_produto.php';
include_once '.\..\modelo\Comentario.php';
include_once '.\..\modelo\Cliente_compra_items.php';
include_once '.\..\modelo\Compra_item_produto.php';

// Faz a Busca de todos os Produtos e armazena em $produtos

//Cria a instancia do usuário que está logado no momento através do Post
$clienteAtual=null;

session_start();

if (!isset($_SESSION['usuario'])){
    
    header("Location: login.php");
    
  }else if(isset($_SESSION['usuario'])){
   
        $clienteAtual = Cliente::buscar($_SESSION['usuario']);
        
        $produtoaComprar= Produto::buscar(1);
        $quantidade=2;
        $valorPago=($produtoaComprar->valor-$produtoaComprar->valorDesconto)*($quantidade);
        if(is_null(Cliente_compra_items::buscar(1)) ){
        $comprarProduto= new Cliente_compra_items(1,$clienteAtual->idCliente,"hoje");
       $comprarProduto->salvar();
        $compranova= new Compra_item_produto(0,$comprarProduto->idCompra,$produtoaComprar->idProduto,$quantidade,$valorPago);
        $compranova->salvar();
        $comprarProduto= new Cliente_compra_items(2,$clienteAtual->idCliente,"hoje");
        $comprarProduto->salvar();
        $valorPago=($produtoaComprar->valor-$produtoaComprar->valorDesconto)*($quantidade);
        $compranova= new Compra_item_produto(1,$comprarProduto->idCompra,$produtoaComprar->idProduto,$quantidade,$valorPago);
              $compranova->salvar();}
  }
  
 
 
  $itemsDoCliente= Cliente_compra_items::buscarTodos($clienteAtual->idCliente);
  
  foreach($itemsDoCliente as $itemCliente){
    
    
  $produtosPedidos= Compra_item_produto::buscar($itemCliente->idCompra);

 
  $nomeProduto= Produto::buscar($produtosPedidos->fk_idproduto);
  $nomeEmpresa= Empresa::buscarPorId($nomeProduto->empresa_idEmpresa);
  $quantidade=$produtosPedidos->quantidade;

  ?>
  <!-- Lista de produtos comprados pelo usuário -->
<form action="pedidos.php" method="post">
<!-- Nome do Produto -->
<div>
        <label for="nomeproduto">Produto</label>
        <input type="text" id="nomeproduto"name="nomeproduto" value="<?php echo $nomeProduto->nome_produto; ?>" />
   </div>

<!-- Nome da Empresa -->
    <div>
        <label for="empresa"> Empresa</label>
        <input type="text" id="empresa" name="empresa" value="<?php echo $nomeEmpresa->nome; ?>"/>
   </div>

  <!-- Quantidade do pedido -->  
    <div>
        <label for="quantidade">Quantidade</label>
        <input type="text" id="quantidade" name="quantidade" value="<?php echo $quantidade; ?>" />
     </div>


 <!-- Valor do produto 
    <div>
        <label for="valor"> Data </label>
        <input type="text" id="data" name="data" value="<?php ?>"/>
 </div>-->

 <!-- Valor de desconto 
    <div>
        <label for="desconto">Desconto </label>
        <input type="text" id="desconto" name="desconto" />
    </div>-->

 <!-- Valor total pago --> 
    <div>
        <label for="total"> Valor Total </label>
        <input type="text" id="valortotal"name="valortotal" value="<?php echo $produtosPedidos->preco; ?>"/>
    </div>
    <div> <input type="submit" value="PAGAR"></input></div>
   
</form>

</form>

<?php }
?> 
            

       

       


</body>



</html>