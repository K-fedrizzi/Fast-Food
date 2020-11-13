<?php 
include_once("Banco.php");
class Produto{
    private $idProduto; //int
    private $nome_produto;//varchar
    private $descricao;//longtext
    private $valor; //decimal
    private $valorDesconto;//decimal
    private $empresa_idEmpresa;//char(14)
    

    function __construct(string $idProduto, string $nome_produto, string $descricao, float $valor, float $valorDesconto, string $empresa_idEmpresa) {
        $this->idProduto=$idProduto;
        $this->nome_produto = $nome_produto;
        $this->descricao = $descricao;
        $this->valor =$valor;
        $this->valorDesconto=$valorDesconto;
        $this->empresa_idEmpresa=$empresa_idEmpresa;
    }
    


    /**
     *  Função que salva os dados de um produto no banco, tendo como parametro o id da empresa a qual pertence.
     *  Esta função não sobrescreve dados.
     */
    public function salvar(string $empresa_idEmpresa) {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Produto (idProduto, nome_produto, descricao, valor, valorDesconto,empresa_idEmpresa) VALUES (:idProduto, :nome_produto, :descricao, :valor, :valorDesconto, :empresa_idEmpresa)');
        $stmt->bindValue(':idProduto', $this->idProduto);
        $stmt->bindValue(':nome_produto', $this->nome_produto);
        $stmt->bindValue(':descricao', $this->descricao);
        $stmt->bindValue(':valor', $this->valor);
        $stmt->bindValue(':valorDesconto', $this->valorDesconto);
        $stmt->bindValue(':empresa_idEmpresa', $this->empresa_idEmpresa);
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar um usuário no banco.
     * 
     * @return Produto retorna ums instância de cliente
     */
    public static function buscar(string $idProduto) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Produto WHERE idProduto = :idProduto');
        $stmt->bindValue(':idProduto', $idProduto);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $produto = new Produto($resultado['idProduto'], $resultado['nome_produto'],$resultado['descricao'],$resultado['valor'],$resultado['valorDesconto'],$resultado['empresa_idEmpresa']);
           
            return $produto;
        } else {
            return NULL;
        }

    }
}?>