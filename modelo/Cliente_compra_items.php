<?php

include_once("Banco.php");
class Cliente_compra_items{
    private $idCompra; //int
    private $fk_idCliente; //char(11)
    private $data; //DATE
   
    function __construct(int $idCompra, string $fk_idCliente, string $data) {
        $this->idCompra=$idCompra;
        $this->fk_idCliente = $fk_idCliente;
        $this->data = $data;
       
    }

    /**
     *  Função que salva os dados de uma venda no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO cliente_compra_items  VALUES (:idCompra, :fk_idCliente,now())');
        $stmt->bindValue(':idCompra', $this->idCompra);
        $stmt->bindValue(':fk_idCliente', $this->fk_idCliente);
       
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar uma venda no banco.
     * 
     * @return Cliente_compra_items retorna ums instância de venda
     */
    public static function buscar(int $idCompra) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM cliente_compra_items WHERE idCompra = :idCompra');
        $stmt->bindValue(':idCompra', $idCompra);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $compra = new Cliente_compra_items($resultado['idCompra'], $resultado['fk_idCliente'],$resultado['data']);

            return $compra;
        } else {
            return NULL;
        }

    }
   /* public static function buscarTodos(string $fk_idCliente) {
        $db = Banco::getInstance();
 $stmt= $db->prepare('SELECT * FROM cliente_compra_items WHERE fk_idCliente == :fk_idCliente');
 $stmt->bindValue(':fk_idCliente', $fk_idCliente);
 $stmt->fetchAll();
$compras=array();
          foreach($stmt as $resultado){
    $compra= new  Cliente_compra_items($resultado['idCompra'], $resultado['fk_idCliente'],$resultado['data']);
    array_push($compras,$compra);
          }
 return $compras;
      

    }*/
    

}
?>