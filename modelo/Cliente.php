<?php 
include_once("Banco.php");
class Cliente{
    private $idCliente;//char(11)
    private $nome; //varchar
    private $email;//varchar
    private $senha;//varchar
    private $endereco;//varchar

   
    function __construct(string $idCliente, string $nome, string $email, string $senha, string $endereco) {
        $this->idCliente=$idCliente;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = hash('sha256', $senha);
        $this->endereco=$endereco;
    }
    
    public function igualEmail(string $email, string $senha) {
        return $this->email === $email && $this->senha === hash('sha256', $senha);
    }
    public function igualId(string $idCliente, string $senha) {
        return $this->idCliente === $idCliente && $this->senha === hash('sha256', $senha);
    }

    /**
     *  Função que salva os dados de um cliente no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Cliente  VALUES (:idCliente, :nome,:email, :senha, :endereco)');
        $stmt->bindValue(':idCliente', $this->idCliente);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':endereco', $this->endereco);
       
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar um cliente no banco.
     * 
     * @return Cliente retorna ums instância de cliente
     */
    public static function buscar(string $idCliente) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Cliente WHERE idCliente = :idCliente');
        $stmt->bindValue(':idCliente', $idCliente);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $usuario = new Cliente($resultado['idCliente'], $resultado['nome'],$resultado['email'],$resultado['senha'],$resultado['endereco']);
            $usuario->senha = $resultado['senha'];
            return $usuario;
        } else {
            return NULL;
        }

    }
}?>