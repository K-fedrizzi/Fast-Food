
<?php

include_once("Banco.php");
class Empresa{
    
    private $nome; //varchar
    private $endereco;//varchar
    private $email;//varchar
    private $senha;//varchar
    

    function __construct(string $nome, string $endereco, string $email, string $senha){
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->email = $email;
        $this->senha = $senha;
       // $this->senha = hash('sha256', $senha);
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
    *   Método que verifica se o email e senha providos são iguais ao da instância.
    *   Sua importância é devido ao fato da senha ser codificada.
    *
    *   @return bool Retorna TRUE se igual, senão FALSE
    */
    public function igual(string $email, string $senha) {
        return $this->email === $email && $this->senha === $senha;
       // return $this->email === $email && $this->senha === hash('sha256', $senha);
    }
     /**
     *  Função que salva os dados de uma empresa no banco.
     *  Esta função não sobrescreve dados.
     */

    public function salvar() {
        
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Empresa (nome, endereco, email, senha) VALUES (:nome, :endereco, :email, :senha)');
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':endereco',$this->endereco);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar uma empresa no banco.
     * 
     * @return Empresa retorna ums instância de empresa
     */
    public static function buscar(string $email) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT (nome, endereco, email, senha) FROM Empresa WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {

            $empresa = new Empresa($resultado['nome'],$resultado['endereco'],$resultado['email'],$resultado['senha']);
            $empresa->senha = $resultado['senha'];
            return $empresa;

        } else {

            return NULL;
        }

    }
         /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar uma empresa no banco.
     * 
     * @return Empresa retorna ums instância de empresa
     */
    public static function buscarPorId(string $idEmpresa) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT nome, endereco, email, senha FROM Empresa WHERE idEmpresa = :idEmpresa');
        $stmt->bindValue(':idEmpresa', $idEmpresa);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $empresa = new Empresa($resultado['nome'],$resultado['endereco'],$resultado['email'],$resultado['senha']);
            $empresa->senha = $resultado['senha'];
            return $empresa;
        } else {
            return NULL;
        }

    }
} ?>                                                                                                                                        