<?php

include_once("Banco.php");
class Comentario{
    private  $idComentario;// int
    private $texto;//longtext
    private $produto_idProduto;//int
    private $cliente_idCliente;//char(11)

    function __construct(int $idComentario, string $texto, int $produto_idProduto, int $cliente_idCliente) {
        $this->idComentario=$idComentario;
        $this->texto = $texto;
        $this->produto_idProduto = $produto_idProduto;
        $this->cliente_idCliente = $cliente_idCliente;
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
     *  Função que salva os dados de um comentario no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Comentario (texto, produto_idProduto, cliente_idCliente)  VALUES (:texto,:produto_idProduto, :cliente_idCliente)');
    
        $stmt->bindValue(':texto', $this->texto);
        $stmt->bindValue(':produto_idProduto', $this->produto_idProduto);
        $stmt->bindValue(':cliente_idCliente', $this->cliente_idCliente);
       
        $stmt->execute();
       
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar um cliente no banco.
     * 
     * @return Comentario retorna ums instância de comentario
     */
    public static function buscar(string $idComentario) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Comentario WHERE idComentario == :idComentario');
        $stmt->bindValue(':idComentario', $idComentario);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $comentario = new Comentario($resultado['idComentario'], $resultado['texto'],$resultado['produto_idProduto'],$resultado['cliente_idCliente']);

            return $comentario;
        } else {
            return NULL;
        }

    }
   public static function buscarTodos(int $idProduto) {
        $db = Banco::getInstance();
        $text='SELECT * FROM Comentario WHERE produto_idProduto == ' .$idProduto;
 $stmt= $db->query($text)->fetchAll();
 
$comentarios=array();
          foreach($stmt as $resultado){
    $comentario= new  Comentario($resultado['idComentario'], $resultado['texto'],$resultado['produto_idProduto'],$resultado['cliente_idCliente']);
    array_push($comentarios,$comentario);
          }
          
 return $comentarios;
      

    }
}
?>