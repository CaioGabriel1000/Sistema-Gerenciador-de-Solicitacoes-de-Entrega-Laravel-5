CREATE DATABASE SGSE;

USE SGSE;

CREATE TABLE password_resets (
  email VARCHAR(255),
  token VARCHAR(255),
  created_at TIMESTAMP,
  KEY password_resets_email_index (email)
);

CREATE TABLE estabelecimento (
    codigoEstabelecimento INT PRIMARY KEY AUTO_INCREMENT,
    razaoSocial VARCHAR(100),
    nomeFantasia VARCHAR(45),
    cnpj BIGINT(14),
    inicioJornadaFuncionamento INT,
    fimJornadaFuncionamento INT,
    diasFuncionamento INT,
    identidadeVisual CHAR(1)
);

INSERT INTO `estabelecimento` VALUES
(1, 'SGSE', 'SGSE', 12345678901234, 0, 1440, 127, 'G');

CREATE TABLE funcionario (
    codigoFuncionario INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    administrador BOOLEAN,
    situacao CHAR(1),
    remember_token VARCHAR(100) NULL,
	codigoEstabelecimento INT,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP NULL
);

CREATE TABLE entregador (
    codigoEntregador INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    inicioJornadaTrabalho INT,
    fimJornadaTrabalho INT,
    codigoEstabelecimento INT
);

INSERT INTO `entregador` VALUES
(1, 'Entregador 1', '0', 1440, 1);


CREATE TABLE entrega (
    codigoEntrega INT PRIMARY KEY AUTO_INCREMENT,
    situacao CHAR(1),
    codigoPedido INT,
    codigoEndereco INT,
    codigoEntregador INT
);

CREATE TABLE endereco (
    codigoEndereco INT PRIMARY KEY AUTO_INCREMENT,
    logradouro VARCHAR(100),
    numero VARCHAR(10),
    complemento VARCHAR(50) NULL,
    cep INT NULL,
    codigoBairro INT
);

CREATE TABLE bairro (
    codigoBairro INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    valorFrete FLOAT,
    codigoCidade INT
);

INSERT INTO `bairro` VALUES
(1, 'Centro', 1.5, 1),
(2, 'Lagoinha', 1.5, 1);

CREATE TABLE cidade (
    codigoCidade INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    estado CHAR(2),
    valorFrete FLOAT
);

INSERT INTO `cidade` VALUES
(1, 'Belo Horizonte', 'MG', 0);

CREATE TABLE pedido (
    codigoPedido INT PRIMARY KEY AUTO_INCREMENT,
    valorTotal FLOAT,
    formaPagamento CHAR(1),
    observacoes VARCHAR(50) NULL,
    situacao CHAR(1),
    codigoCliente INT,
    codigoFuncionario INT NULL,
	created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP NULL
);

CREATE TABLE cliente (
    codigoCliente INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    situacao CHAR(1),
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP NULL
);

CREATE TABLE produto (
    codigoProduto INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45),
    sku VARCHAR(10),
    valorUnitario FLOAT,
    quantidadeEstoque INT,
	descricao VARCHAR(100),
    codigoCategoria INT
);

CREATE TABLE categoria (
    codigoCategoria INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45)
);

INSERT INTO `categoria` VALUES
(1, 'Categoria 1');

CREATE TABLE pagamento (
    codigoPagamento INT PRIMARY KEY AUTO_INCREMENT,
    valor FLOAT,
    situacao CHAR(1),
    codigoPedido INT
);

CREATE TABLE telefoneEstabelecimento (
    telefoneEstabelecimento BIGINT(11) NOT NULL,
    codigoEstabelecimento INT
);

CREATE TABLE telefoneCliente (
    telefoneCliente BIGINT(11) NOT NULL,
    codigoCliente INT
);

CREATE TABLE pedidoProduto (
    codigoProduto INT,
    codigoPedido INT,
    quantidade INT
);
 
ALTER TABLE funcionario ADD CONSTRAINT FK_Funcionario_1
    FOREIGN KEY (codigoEstabelecimento)
    REFERENCES estabelecimento (codigoEstabelecimento);
 
ALTER TABLE entregador ADD CONSTRAINT FK_Entregador_1
    FOREIGN KEY (codigoEstabelecimento)
    REFERENCES estabelecimento (codigoEstabelecimento);
 
ALTER TABLE entrega ADD CONSTRAINT FK_Entrega_1
    FOREIGN KEY (codigoPedido)
    REFERENCES pedido (codigoPedido);
 
ALTER TABLE entrega ADD CONSTRAINT FK_Entrega_2
    FOREIGN KEY (codigoEndereco)
    REFERENCES endereco (codigoEndereco);
 
ALTER TABLE entrega ADD CONSTRAINT FK_Entrega_3
    FOREIGN KEY (codigoEntregador)
    REFERENCES entregador (codigoEntregador);
 
ALTER TABLE endereco ADD CONSTRAINT FK_Endereco_1
    FOREIGN KEY (codigoBairro)
    REFERENCES bairro (codigoBairro);
 
ALTER TABLE bairro ADD CONSTRAINT FK_Bairro_1
    FOREIGN KEY (codigoCidade)
    REFERENCES cidade (codigoCidade);
 
ALTER TABLE pedido ADD CONSTRAINT FK_Pedido_1
    FOREIGN KEY (codigoCliente)
    REFERENCES cliente (codigoCliente);
 
ALTER TABLE pedido ADD CONSTRAINT FK_Pedido_2
    FOREIGN KEY (codigoFuncionario)
    REFERENCES funcionario (codigoFuncionario);
 
ALTER TABLE produto ADD CONSTRAINT FK_Produto_1
    FOREIGN KEY (codigoCategoria)
    REFERENCES categoria (codigoCategoria);
 
ALTER TABLE pagamento ADD CONSTRAINT FK_Pagamento_1
    FOREIGN KEY (codigoPedido)
    REFERENCES pedido (codigoPedido);
 
ALTER TABLE telefoneEstabelecimento ADD CONSTRAINT FK_telefoneEstabelecimento_1
    FOREIGN KEY (codigoEstabelecimento)
    REFERENCES estabelecimento (codigoEstabelecimento);
 
ALTER TABLE telefoneCliente ADD CONSTRAINT FK_telefoneCliente_1
    FOREIGN KEY (codigoCliente)
    REFERENCES cliente (codigoCliente);
 
ALTER TABLE pedidoProduto ADD CONSTRAINT FK_PedidoProduto_1
    FOREIGN KEY (codigoProduto)
    REFERENCES produto (codigoProduto);
 
ALTER TABLE pedidoProduto ADD CONSTRAINT FK_PedidoProduto_2
    FOREIGN KEY (codigoPedido)
    REFERENCES pedido (codigoPedido);