<?php

include_once("Banco.php");
class Compra_item_produto{
    private $id;
    private $fk_idCompra; //int
    private $fk_idproduto; //int
    private $quantidade; //int
   private $preco;

    function __construct(int $id,int $fk_idCompra, int $fk_idproduto, int $quantidade, float $preco) {
        $this->id=$id;
        $this->fk_idCompra=$fk_idCompra;
        $this->fk_idproduto = $fk_idproduto;
        $this->quantidade = $quantidade;
        $this->preco = $preco;
    }
/**
    *  Método mágico para acessar todos os campos
    */
    public function __get($campo) {
        return $this->$campo;
    }

    /**
    *  Método mágico para modificar todos os campos
    */
    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }
    /**
     *  Função que salva os dados de cada item de uma venda no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO compra_item_produto (fk_idCompra,fk_idproduto,quantidade, preco) VALUES (:fk_idCompra, :fk_idproduto,:quantidade, :preco)');
        $stmt->bindValue(':fk_idCompra', $this->fk_idCompra);
        $stmt->bindValue(':fk_idproduto', $this->fk_idproduto);
        $stmt->bindValue(':quantidade', $this->quantidade);
        $stmt->bindValue(':preco', $this->preco);
       
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar um item de venda realizada.
     * 
     * @return Compra_item_produto retorna ums instância um item
     */
    public static function buscar(int $fk_idCompra/*, int $fk_idproduto*/) {
        $db = Banco::getInstance();
// AND fk_idproduto == :fk_idproduto
        $stmt = $db->prepare('SELECT * FROM compra_item_produto WHERE fk_idCompra = :fk_idCompra');
        $stmt->bindValue(':fk_idCompra', $fk_idCompra);
       // $stmt->bindValue(':fk_idproduto', $fk_idproduto);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $item = new Compra_item_produto($resultado['id'],$resultado['fk_idCompra'], $resultado['fk_idproduto'],$resultado['quantidade'],$resultado['preco']);

            return $item;
        } else {
            return NULL;
        }

    }
   
    public static function buscarTodos(int $fk_idCompra) {
        $db = Banco::getInstance();
        $text="SELECT * FROM compra_item_produto WHERE fk_idCompra = ".$fk_idCompra;
    $stmt= $db->query($text)->fetchAll();
    
    $produtos=array();
          foreach($stmt as $resultado){
    $produto = new compra_item_produto($resultado['id'],$resultado['fk_idCompra'], $resultado['fk_idproduto'],$resultado['quantidade'],$resultado['preco']);
            array_push($produtos,$produto);
          }
    return $produtos;
      }
    

}



?>