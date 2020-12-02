<?php 

/**
* Classe responsável por gerir a conexão com a base de dados.
* Aplica o design pattern Singleton para não sobrecarregar de conexões.
*/
final class Banco {

    /**
    * @var PDO armazena a conexão e retorna quando solicitado
    */
    private static $conexao;

    /**
    *  Construtor privado, pois não desejamos que usuários instanciem esta classe
    */
    private function __construct() {}

    /**
    *  Função (estática) na qual usuários podem obter a conxão. 
    *  Somente uma será criada.
    *
    *  @return PDO conexão com o banco
    */
    public static function getInstance() : PDO {
        if (is_null(self::$conexao)) {
            self::$conexao = new PDO('sqlite:restaurante_database.sqlite3');
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        return self::$conexao;
    }

    /**
    *  Função para criação do modelo do banco (tabela Usuários neste caso). 
    */
    public static function createSchema() {
        $db = self::getInstance();
        $db->exec(  "  CREATE TABLE IF NOT EXISTS Cliente (
                       idCliente INTEGER PRIMARY KEY AUTOINCREMENT,
                       nome VARCHAR(45) NOT NULL,
                       endereco VARCHAR(45) NOT NULL,
                       email VARCHAR(45) NULL,
                       senha VARCHAR(45) NOT NULL
                   );
                   CREATE TABLE IF NOT EXISTS Empresa (
                       idEmpresa INTEGER PRIMARY KEY AUTOINCREMENT,
                       nome VARCHAR(45) NOT NULL,
                       endereco VARCHAR(45) NOT NULL,
                       email VARCHAR(45) NULL,
                       senha VARCHAR(45) NULL
                   );
                   CREATE TABLE IF NOT EXISTS Produto (
                       idProduto INT NOT NULL,
                       imagem VARCHAR(45) NOT NULL,
                       nome_produto VARCHAR(45) NOT NULL,
                       descricao TEXT NULL,
                       valor DECIMAL NOT NULL,
                       valorDesconto DECIMAL NULL,
                       empresa_idEmpresa INTEGER NOT NULL,
                       PRIMARY KEY (idProduto),
                       CONSTRAINT fk_produto_empresa
                       FOREIGN KEY (empresa_idEmpresa)
                       REFERENCES Empresa (idEmpresa)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION
                   );
                   CREATE TABLE IF NOT EXISTS cliente_compra_items (
                       idCompra INTEGER NULL PRIMARY KEY AUTOINCREMENT,
                       fk_idCliente INTEGER NOT NULL,
                       dataCompra TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                      
                       CONSTRAINT fk_Cliente_idCliente
                       FOREIGN KEY (fk_idCliente)
                       REFERENCES Cliente (idCliente)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION
                   );
                   CREATE TABLE IF NOT EXISTS compra_item_produto (
                       id INTEGER NULL PRIMARY KEY AUTOINCREMENT,
                       fk_idCompra INT NOT NULL,
                       fk_idproduto INT NOT NULL,
                       quantidade INT NOT NULL,
                       preco DECIMAL NOT NULL,
                     
                       CONSTRAINT fk_compra_idCompra
                       FOREIGN KEY (fk_idCompra)
                       REFERENCES cliente_compra_items (idCompra)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION,
                       CONSTRAINT fk_Produto_idProduto
                       FOREIGN KEY (fk_idproduto)
                       REFERENCES Produto (idProduto)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION
                   );
                   CREATE TABLE IF NOT EXISTS cliente_avaliacao_produto (
                       cliente_idCliente INT NOT NULL,
                       produto_idProduto INT NOT NULL,
                       valorAvaliacao INT NOT NULL,
                       PRIMARY KEY (cliente_idCliente, produto_idProduto),
                       CONSTRAINT fk_cliente_has_produto_cliente
                       FOREIGN KEY (cliente_idCliente)
                       REFERENCES Cliente (idCliente)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION,
                       CONSTRAINT fk_cliente_has_produto_produto
                       FOREIGN KEY (produto_idProduto)
                       REFERENCES Produto (idProduto)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION
                   );
                   CREATE TABLE IF NOT EXISTS Comentario (
                       idComentario  INTEGER PRIMARY KEY AUTOINCREMENT,
                       texto TEXT NULL,
                       produto_idProduto INT NOT NULL,
                       cliente_idCliente INT NOT NULL,
                       CONSTRAINT fk_comentario_produto
                       FOREIGN KEY (produto_idProduto)
                       REFERENCES Produto (idProduto)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION,
                       CONSTRAINT fk_comentario_cliente
                       FOREIGN KEY (cliente_idCliente)
                       REFERENCES Cliente (idCliente)
                       ON DELETE NO ACTION
                       ON UPDATE NO ACTION ) "
        );
    }
}

?>