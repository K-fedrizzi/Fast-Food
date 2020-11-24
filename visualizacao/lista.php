<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Russo One' rel='stylesheet'>
         <link rel="stylesheet" type="text/css" href="stylesLista.css" />
        
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
/**
 * Cria um banco de dados para o projeto
 */
try{

    Banco::createSchema();
    
} catch (\Throwable $th) {
    echo $th;
    die(1);
}

$produtos=Produto::buscarProdutos();


?> 
            <header id="topo">
                <nav>
                    <div class="logo"> <a href="#"><img src="imagens/pratoheader.png"/></a></div> 
              
              <div> <h1 class="titulo1">
                Fast Food  </h1>
        <h1 class="titulo2">
               Delicious      </h1>    </div> 
                
               <div class="menu"> 
                <ul>
                    <li><a href="#suporte">Suporte</a></li>
                    <li><a href="#pedidos">Pedidos</a></li>
                    <li><a href="inicial.php">sair</a></li>
                  
                </ul></div>
            </nav>
               
                  
            </header>
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
      
       <ul>
           <li>
         <?php 
     
        $nomeRestaurante="Pizzaria do Vizinho";
        $descricao="Pizza saborosa e cremosa<br/>queijo, tomate, frango";
        $pontuacao=4;
        $valor=12;
        $clienteComent=array(array("JOAO","Muito bom!"),array("vitor"," Vale a pena"));
        
        $minhaAvaliacao=3;

         foreach($produtos as $produto){?>
            <div class="sect1">
           <div class="item">          
               <div class="imagem"><img src="imagens/pizza.png" alt="promo1"></div> 
                <div class="info">
                     <div class="titulo">  
                             <div class="nomeProduto"><?php echo $produto->nome_produto; ?></div>   
                            <div class="nomeRestaurante"><?php $empresa=Empresa::buscarPorId($produto->empresa_idEmpresa);  echo $empresa->nome; ?></div>    
                    <div id="descricaoTx" class="descricaoTx"><?php echo $produto->descricao ?>
                          
                        <div class="btexp"><button  class="expandirBt" onclick="expandir(this.value)">Ler Mais</button></div>  
                     </div> 
                   
                    <div class="descricao">  
                        <div class="avaliacao">
                         <div class="estrelas">
                             <ul>
                           
                             
                             <?php 
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
                         <div class="pontuacao"><?php echo number_format(floor($pontuacao),1,'.','')  ?></div>
                         <div class="avaliacaoBt"><button id="avaliacoesBt" class="avaliacoesBt" onclick="avaliacaoBt(this.value)">Avaliações</button></div>
                        </div>  
                       </div> 
               </div> 
                        
                        
                </div>
            
               <div class="compra">
                   <div class="carrinho"><button><img src="imagens/carrinho.png" alt="carrinho"></button></div>
                   <div class="promocao"><img src="imagens/promocao.png" alt="promoção"></div>
                   <div class="preco"><?php echo 'R$' .number_format($produto->valor,2,',','')  ?></div>
                </div> 
                
           </div>
         
           <div id="avaliacaoTx" class="avaliacaoTx">
               <div class="outrosUsuarios">
                   <div class="minimizarAv"><button class=minimizarBt onclick="minimizarAvaliacao(this.value)">X</button></div>
                   <div class="listaAvaliacao">Comentários:
                       <ul>
                       <?php 
                         
                               for($j=0; $j<count($clienteComent); $j++)   {               
                           
                             ?> 
                               <li><div class="nomeLista"><?php echo $clienteComent[$j][0]; ?></div><div class="textoLista"><?php echo $clienteComent[$j][1]; ?></div></li>
                                 <?php
                               }                                
                          ?>
                      
                      
                   </ul>
                </div>
                   <div class="novoComentario">
                       <div class="caixaInput"><div>Comente:</div><textarea class="comentario" rows="5" cols="10" maxlength="200" ></textarea> </div>
                       <div class="enviar"><button class="btEnviar">Enviar</button></div>
                   </div>
               </div>
               <div class="minhaAvaliacao">
                   <div class="estrelas"><form><label class="myAvaliacao"><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)"><img class ="estrela" src="imagens/estrela.png" alt="*"></button>
                               </label>
                               <label class="myAvaliacao"><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)"><img class ="estrela" src="imagens/estrela.png" alt="*"></button>
                               </label>
                               <label class="myAvaliacao"><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)"><img class ="estrela" src="imagens/estrela.png" alt="*"></button>
                               </label>

                               <label class="myAvaliacao"><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)"><img class ="estrela" src="imagens/estrela.png" alt="*"></button>
                               </label>
                               <label class="myAvaliacao"><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)"><img class ="estrela" src="imagens/estrela.png" alt="*"></button>
                               </label></form>
                 <!--   <ul class="myAvaliacao" value="--><?php /*echo $minhaAvaliacao ?>">
                    <?php 
                        
                         for($j=0;$j<5;$j++){                            
                             ?>       <?php
                             $corEstrela="estrela";
                              if($j>=floor($minhaAvaliacao)){ ?> 
                               <li><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)" value="<?php echo $val=$j+1;?>" ><img class ="estrela estrelaApagada" src="imagens/estrela.png" alt="*"></button></li>
                               
                              <?php  }else {?> 
                                <li><button class="estrelaMinhaAvaliacao" onclick="atualizarEstrela(this.value)" value="<?php echo $val=$j+1;?>"><img class ="estrela" src="imagens/estrela.png" alt="*"></button></li>
                               
                                 <?php } 
                                                               
                          } ?>
                       
                    </ul>*/?><!--apagar -->
                   </div>
                   <div class="valorPontuacao"><?php echo number_format(floor($minhaAvaliacao),1,'.','') ?></div>
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