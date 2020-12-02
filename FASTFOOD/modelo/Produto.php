<?php 
include_once("Banco.php");
class Produto{
    private $idProduto; //int
    private $nome_produto;//varchar
    private $imagem;//varchar
    private $descricao;//longtext
    private $valor; //decimal
    private $valorDesconto;//decimal
    private $empresa_idEmpresa;//char(14)
    

    function __construct(int $idProduto, string $nome_produto, string $imagem, string $descricao, float $valor, float $valorDesconto, string $empresa_idEmpresa) {
        $this->idProduto=$idProduto;
        $this->nome_produto = $nome_produto;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->valor =$valor;
        $this->valorDesconto=$valorDesconto;
        $this->empresa_idEmpresa=$empresa_idEmpresa;
    }
       /**
    *  Método mágico para acessar todos os campos
    */
    public function __get($campo) {
        return $this->$campo;
    }
public function nome(){
    return $this->nome_produto;
}

    /**
     *  Função que salva os dados de um produto no banco, tendo como parametro o id da empresa a qual pertence.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Produto (idProduto, nome_produto, imagem, descricao, valor, valorDesconto,empresa_idEmpresa) VALUES (:idProduto, :nome_produto,:imagem, :descricao, :valor, :valorDesconto, :empresa_idEmpresa)');
        $stmt->bindValue(':idProduto', $this->idProduto);
        $stmt->bindValue(':nome_produto', $this->nome_produto);
        $stmt->bindValue(':imagem', $this->imagem);
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
    public static function buscar(int $idProduto) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Produto WHERE idProduto = :idProduto');
        $stmt->bindValue(':idProduto', $idProduto);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $produto = new Produto($resultado['idProduto'], $resultado['nome_produto'],$resultado['imagem'],$resultado['descricao'],$resultado['valor'],$resultado['valorDesconto'],$resultado['empresa_idEmpresa']);
           
            return $produto;
        } else {
            return NULL;
        }

    }
     public static function buscarProdutos() {
        $db = Banco::getInstance();
 $stmt= $db->query('SELECT * FROM Produto ORDER BY nome_produto')->fetchAll();

$produtos=array();
          foreach($stmt as $resultado){
    $produto = new Produto($resultado['idProduto'], $resultado['nome_produto'],$resultado['imagem'],$resultado['descricao'],$resultado['valor'],$resultado['valorDesconto'],$resultado['empresa_idEmpresa']);
            array_push($produtos,$produto);
          }
 return $produtos;
      }

    
}?>