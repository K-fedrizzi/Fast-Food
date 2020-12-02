<?php

include_once("Banco.php");
class Cliente_avaliacao_produto{

    private $cliente_idCliente;//char(11)
    private $produto_idProduto; //int
    private $valorAvaliacao; //int


function __construct(int $cliente_idCliente, int $produto_idProduto, int $valorAvaliacao) {
        $this->cliente_idCliente=$cliente_idCliente;
        $this->produto_idProduto = $produto_idProduto;
        $this->valorAvaliacao = $valorAvaliacao;
       
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
     *  Função que salva os dados de uma avaliacao de um produto por um cliente no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO cliente_avaliacao_produto  VALUES (:cliente_idCliente, :produto_idProduto,:valorAvaliacao)');
        $stmt->bindValue(':cliente_idCliente', $this->cliente_idCliente);
        $stmt->bindValue(':produto_idProduto', $this->produto_idProduto);
        $stmt->bindValue(':valorAvaliacao', $this->valorAvaliacao);
       
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar uma avaliacao de um cliente em determinado produto no banco.
     * 
     * @return Cliente_avaliacao_produto retorna ums instância de avaliacao de um cliente em determinado produto
     */
    public static function buscar(int $cliente_idCliente,int $produto_idProduto) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM cliente_avaliacao_produto WHERE cliente_idCliente == :cliente_idCliente AND produto_idProduto == :produto_idProduto' );
        $stmt->bindValue(':cliente_idCliente', $cliente_idCliente);
        $stmt->bindValue(':produto_idProduto', $produto_idProduto);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $avaliacao = new Cliente_avaliacao_produto($resultado['cliente_idCliente'], $resultado['produto_idProduto'],$resultado['valorAvaliacao']);

            return $avaliacao;
        } else {
            return null;
        }

    }
       public static function buscarMediaProduto(int $produto_idProduto) {
        $db = Banco::getInstance();
        $stmt= $db->prepare('SELECT AVG(valorAvaliacao) FROM cliente_avaliacao_produto WHERE produto_idProduto == :produto_idProduto');
        $stmt->bindValue(':produto_idProduto', $produto_idProduto);
        $stmt->execute();
        $resultado = $stmt->fetch();
        if ($resultado) {
           $valor=$resultado[0];
            return $valor;
        } else {
            return NULL;
        }
    }

   /* public static function buscarTodos(int $produto_idProduto) {
        $db = Banco::getInstance();
 $stmt= $db->prepare('SELECT * FROM cliente_avaliacao_produto WHERE produto_idProduto == :produto_idProduto');
 $stmt->bindValue(':produto_idProduto', $produto_idProduto);
 $stmt->fetchAll();
$avaliacoes=array();
          foreach($stmt as $resultado){
    $avaliacao= new  Cliente_avaliacao_produto($resultado['cliente_idCliente'], $resultado['produto_idProduto'],$resultado['valorAvaliacao']);
    array_push($avalacoes,$avaliacao);
          }
 return $compras;
      

    }*/

    }
?>