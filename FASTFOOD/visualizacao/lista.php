<!DOCTYPE html>
<html>
<?php
    
    ?>

    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
         <link rel="stylesheet" type="text/css" href="stylesLista.css" />
         <link rel="stylesheet" type="text/css" href="styles.css">
        
        <title>Lista</title>
        <script type="text/javascript" src="listaJS.js" defer></script>
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
    
} catch (\Throwable $th) {
    echo $th;
    die(1);
}
// Faz a Busca de todos os Produtos e armazena em $produtos
$produtos=Produto::buscarProdutos();
//Cria a instancia do usuário que está logado no momento através do Post
$clienteAtual=null;

session_start();

if (!isset($_SESSION['usuario'])){
    
    header("Location: login.php");
    
  }else if(isset($_SESSION['usuario'])){
   
        $clienteAtual = Cliente::buscar($_SESSION['usuario']);
        
  }
?> 

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
                <li><a href="pedidos.php">Pedidos</a></li>
            <li><a href="login.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </header>
              <!--  <ul>
                    <li><a href="#suporte">Suporte</a></li>
                    <li><a href="#pedidos">Pedidos</a></li>
                    <li><a href="index.php">sair</a></li>
                  
                </ul></div>
            </nav>            
                  
            </header>-->

            <!-- Trecho de busca e ordenacao dos produtos-->
  <section class="busca">
      <div>
        <div class="lupa"><img src="imagens/lupa.png" alt="lupa"></div>
        <div class="inputTx"><input></input></div>
        <div class="pesquisarBt"><button>Pesquisar</button></div>
     </div>   
   </section>  
   <section class="filtro">
       <div class="itemsOrd">Ordenar:
           <div><button>Restaurante</button></div>
           <div><button>Comida</button></div>
            <div><button>Preço</button></div>
            <div><input type="checkbox" name="promocional" id="promocional" value="" /> 
                <label for="manterlogado">Promocional</label></div>
     </div>
   </section>
   <section>
      <!-- Lista dos Produtos é criado aqui dentro do loop -->
       <ul>
           
         <?php 
            $minhaAvaliacaoPorProduto=0;  // esse valor é colocado dentro da div de class=minhaAvaliacao para ser definido a sequencia do uso do javaScript para atualizar as estrelas
            
         //Loop que pega cada produto dentro da lista de produtos
         foreach($produtos as $produto){?>
           <li> <div id="<?php echo $produto->nome_produto?>" class="sessao">
                <div class="item">          
                 <div class="imagem"><img src="<?php echo $produto->imagem;?>" alt="promo1"></div> <!-- deve ser colocado o link resgatado do BD para a imagem do produto-->
                <div class="info">
                     <div class="titulo">  
                          <!--Resgata o nome do produto-->
                             <div class="nomeProduto"><?php echo $produto->nome_produto; ?></div>  
                             <!-- Cria uma insância da empresa dona desse produto pelo id da empresa registrado na tabela de produto e emite seu nome-->
                            <div class="nomeRestaurante"><?php $empresa=Empresa::buscarPorId($produto->empresa_idEmpresa);  echo $empresa->nome; ?></div> 
                            <!-- Apresente a descrição do produto-->   
                    <div id="descricaoTx" class="descricaoTx"><?php echo $produto->descricao ?>
                          <!--Botão para expandir a descricao do produto -->
                        <div class="btexp"><button  class="expandirBt" onclick="expandir(this.value)">Ler Mais</button></div>  
                     </div> 
                   
                    <div class="descricao">  
                        <!-- bloco da media de avalicao do produto -->
                        <div class="avaliacao">
                         <div class="estrelas">
                             <ul> 
                             <?php //Busca a media da avaliacao do produto e configura as estrelas
                                $pontuacao=Cliente_avaliacao_produto::buscarMediaProduto($produto->idProduto);
                                    for($j=0;$j<5;$j++){                            
                                        ?>       <?php
                                        $corEstrela="estrela";
                                        if($j>=floor($pontuacao)){ ?> 
                                            <li><img class ="estrela estrelaApagada" src="imagens/estrela.png" alt="*"> </li>
                                        <?php  }else {?> 
                                            <li><img class ="estrela" src="imagens/estrela.png" alt="*"> </li>
                                            <?php } 
                                                                        
                                    } ?>
                             
                             </ul>
                         </div>
                         <!--imprime o valor arredondado da media da avaliacao do produto-->
                         <div class="pontuacao"><?php echo number_format(floor($pontuacao),1,'.','')  ?></div>
                         <div class="avaliacaoBt"><button id="avaliacoesBt" class="avaliacoesBt" onclick="avaliacaoBt(this.value)">Avaliações</button></div>
                        </div>  
                    </div> 
               </div> 
                        
                        
                </div>
            
               <div class="compra">
                   <div class="carrinho"><button><img src="imagens/carrinho.png" alt="carrinho"></button></div> <!--deve implementar a funcao de add ao carrinho-->
                   <div class="promocao"><img src="imagens/promocao.png" alt="promoção"></div> <!--deve aparecer somente se tiver desconto-->
                   <div class="preco"><?php echo 'R$' .number_format($produto->valor-$produto->valorDesconto,2,',','')  ?></div> <!--Valor do produto com Desconto-->
                </div> 
                
           </div>
         
           <div id="avaliacaoTx" class="avaliacaoTx">
               <!--Avaliacao em comentário de clientes salvo no banco de dados -->
               <div class="outrosUsuarios">
                   <div class="minimizarAv"><button class=minimizarBt onclick="minimizarAvaliacao(this.value)">X</button></div>
                   <div class="listaAvaliacao">Comentários:
                       <ul> <!--lista de comentários-->
                       <?php 
                       // Carrega a lista de todos os comentarios para este produto
                       $comentarios=Comentario::buscarTodos($produto->idProduto);
                       //manipula cada comentário ate imprimir todos
                               foreach($comentarios as $comentario)   {               
                                   //carrega o nome do cliente que fez este comentário
                                $cliente= Cliente::buscarPorId($comentario->cliente_idCliente);?> 
                                 <!--imprime o nome do usuario e o comentário feito-->
                               <li><div class="nomeLista"><?php echo $cliente->nome; ?></div><div class="textoLista"><?php echo $comentario->texto; ?></div></li>
                         <?php }  ?>                                            
                   </ul>
                </div>
                <!--Campo para preenchimento de novo comentário-->
                <!--Deve ser implementado um salvamento para o banco de dados-->
                   <div class="novoComentario">
                       <div class="caixaInput"><div>Comente:</div><textarea class="comentario" rows="5" cols="10" maxlength="200" ></textarea> </div>
                       <div class="enviar"><button class="btEnviar">Enviar</button></div>
                   </div>
               </div>
               <!--Parte onde fica a avaliacao do usuario logado. O value dessa div recebe o valor que é incrementado para cada produto afim de ser manipulado no javaScript-->
               <div class="minhaAvaliacao" value=<?php  echo $minhaAvaliacaoPorProduto; ?>>
                        <?php 
                        //carrega a pontuacao do clienteAtual 
                         $pontuacao=Cliente_avaliacao_produto::buscar($clienteAtual->idCliente, $produto->idProduto);
                         //se nao hover avaliacao deste usuario, a pontuacao fica como zero mas sem registrar ainda no banco de dados. Se houver, utiliza a pontuacao para visualizacao
                        if(is_null($pontuacao)){
                            $pontuacao=0;
                        }else{
                            $pontuacao=$pontuacao->valorAvaliacao;
                        }
                        ?>
                        <!--div das estrelas dadas pelo cliente logado-->
                        <div class="estrelas">
                            <ul>
                            <!-- for utilizado para garregar as 5 estrelas confore a avaliacao do usuario-->
                                <?php for($j=0;$j<5;$j++){  ?> <?php
                                    $corEstrela="estrela";
                                    if($j>=floor($pontuacao)){ ?> 
                                    <li><button class="estrelaMinhaAvaliacao" value="<?php echo $j+1;?>" onclick="atualizarEstrela(this.value, <?php echo $produto->idProduto?>,<?php echo $minhaAvaliacaoPorProduto ?>)"><img class ="estrela estrelaApagada" src="imagens/estrela.png" alt="*"></button></li>
                                    <?php  }else {?> 
                                        <li><button class="estrelaMinhaAvaliacao" value="<?php echo $j+1;?>" onclick="atualizarEstrela(this.value, <?php echo $produto->idProduto?>, <?php echo $minhaAvaliacaoPorProduto ?>)"><img class ="estrela" src="imagens/estrela.png" alt="*"></button></li>
                                    
                                        <?php } 
                                                                    
                                } 
                                // valor é incrementado para dar a posicao de cada avaliacao em cada produto,  para ser utilizdo na chamada da funcao do javaScript 
                                $minhaAvaliacaoPorProduto=$minhaAvaliacaoPorProduto+1;?>                       
                          </ul>                          
            
                        </div>
                   <!--imprime o valor da pontuacao do cliente logado para este produto -->
                     <div class="valorPontuacao"><?php echo $pontuacao; ?></div>
               </div>
           </div>         
        </div>
          <?php }?>

         </li> 
    </ul>
        
       
   </section> 
           
            <section id="suporte" class="suporte">
              <div><h3>Suporte</h3></div>  

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