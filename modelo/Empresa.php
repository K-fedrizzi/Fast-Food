<?php

include_once("Banco.php");
class Empresa{
    private $idEmpresa; //char(14)
    private $nome_empresa;//varchar
    private $endereco_empresa;//varchar
    

    function __construct(string $idEmpresa, string $nome_empresa, string $endereco_empresa){
          $this->idEmpresa=$idEmpresa;
        $this->nome_empresa = $nome_empresa;
        $this->endereco_empresa = $endereco_empresa;
       
    }
     /**
     *  Função que salva os dados de uma empresa no banco.
     *  Esta função não sobrescreve dados.
     */
    public function salvar() {
        $db = Banco::getInstance();
        $stmt = $db->prepare('INSERT INTO Empresa (idEmpresa, nome_empresa, endereço_empresa) VALUES (:idEmpresa, :nome_empresa,:endereco_empresa)');
        $stmt->bindValue(':idEmpresa', $this->idEmpresa);
        $stmt->bindValue(':nome_empresa', $this->nome_empresa);
        $stmt->bindValue(':endereco_empresa', $this->endereco_empresa);
        $stmt->execute();
    }

     /**
     * Função estática, pois não depende do estado de uma instância,
     * para buscar uma empresa no banco.
     * 
     * @return Empresa retorna ums instância de empresa
     */
    public static function buscar(string $idEmpresa) {
        $db = Banco::getInstance();

        $stmt = $db->prepare('SELECT * FROM Empresa WHERE idEmpresa = :idEmpresa');
        $stmt->bindValue(':idEmpresa', $idEmpresa);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado) {
            $empresa = new Empresa($resultado['idEmpresa'], $resultado['nome_empresa'],$resultado['endereco_empresa']);
        
            return $empresa;
        } else {
            return NULL;
        }

    }
} ?>