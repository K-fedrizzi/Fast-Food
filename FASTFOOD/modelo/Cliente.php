<?php 

include_once("Banco.php");

class Cliente{
    private $idCliente;
    private $nome; //varchar
    private $endereco;//varchar
    private $email;//varchar
    private $senha;//varchar
   
    function __construct(int $idCliente, string $nome, string $endereco, string $email, string $senha) {
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->email=$email;
        $this->senha = $senha;
        $this->idCliente = $idCliente;
       // $this->senha = hash('sha256', $senha);
    }
    
    public function __get($campo) {
        return $this->$campo;
    }
    // verifica se o email e a senha é igual ao que foi digitado
    public function igualEmail(string $email, string $senha) {
        return $this->email === $email && $this->senha === $senha;
        //return $this->email === $email && $this->senha === hash('sha256', $senha);
    }

    // verifica se o id e senha são iguais aos que foram informados
    public function igualId(string $idCliente, string $senha) {
        return $this->idCliente === $idCliente && $this->senha === $senha;
      //  return $this->idCliente === $idCliente && $this->senha === hash('sha256', $senha);
    }

    /**
     *  Função que salva os dados de um cliente no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {

        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Cliente (nome,endereco,email,senha)  VALUES (:nome, :endereco, :email, :senha)');
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':endereco', $this->endereco);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
       
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar um cliente no banco.
     * 
     * @return Cliente retorna ums instância de cliente
     */
    public static function buscar(string $email) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Cliente WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $usuario = new Cliente($resultado ['idCliente'],$resultado['nome'],$resultado['endereco'],$resultado['email'],$resultado['senha']);
            $usuario->senha = $resultado['senha'];
            return $usuario;
        } else {
            return NULL;
        }
    }
    /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar um cliente no banco.
     * 
     * @return Cliente retorna ums instância de cliente buscando pelo id
     */
    public static function buscarPorId(int $idCliente) {
        $db = Banco::getInstance();
$texto=$idCliente;
        $stmt = $db->prepare('SELECT idCliente, nome, endereco, email, senha FROM Cliente WHERE idCliente = :idCliente');
        $stmt->bindValue(':idCliente', $idCliente);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $usuario = new Cliente($resultado ['idCliente'], $resultado['nome'],$resultado['endereco'],$resultado['email'],$resultado['senha']);
            $usuario->senha = $resultado['senha'];
            return $usuario;
        } else {
            return NULL;
        }

        
    }
     /**
     * Metodo para autenticar usuário e senha 
     * @return
     */
    public static function autenticarUsuario(string $email, string $senha) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Cliente WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado['email'] === $email && $resultado['senha'] === $senha) {

            return true;

        } else {

            return false;
        }
    }
     /**
    * Metodo para autenticar usuário e senha 
    * @return
    */
    public static function buscarNome(string $email) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Cliente WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch();

        return $resultado['nome'];
    }
}?>