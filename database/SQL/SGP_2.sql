/*
DATABASE: sgp
*/
CREATE DATABASE sgp;

USE sgp;

/**
 * TABLE: estabelecimento
 * DESC: configurações do estabelecimento
 *	- codigoEstabelecimento = identificador do estabelecimento, normalmente único
 *	- razaoSocial, nomeFantasia, cnpj = informações exibidas nas telas do sistema
 *	- inicioJornadaFuncionamento, fimJornadaFuncionamento = valor em minutos, horário de início e fim de funcionamento 
 *	- diasFuncionamento = valor inteiro cujos bits representam os dias da semana de funcionamento 
 *	 	1 = domingo
 *	 	2 = segunda
 *	 	4 = terça
 *	 	8 = quarta
 *	 	16 = quinta
 *	 	32 = sexta
 *	 	64 = sábado
 *	- identidadeVisual = letra que representa a cor que do sistema
 *		G = cinza (padrão)
 *		R = vermelho
 *		G = verde
 *		O = laranja
 *		Y = amarelo
 *		P = rosa
 *		B = Azul
 */
CREATE TABLE estabelecimento (
    codigoEstabelecimento INT NOT NULL PRIMARY KEY DEFAULT 1,
    razaoSocial VARCHAR(255),
    nomeFantasia VARCHAR(45) NOT NULL,
    cnpj BIGINT(14),
    inicioJornadaFuncionamento INT NOT NULL,
    fimJornadaFuncionamento INT NOT NULL,
    diasFuncionamento INT NOT NULL,
    identidadeVisual CHAR(1) NOT NULL
);

INSERT INTO estabelecimento VALUES (1, 'SGP', 'SGP', 12345678901234, 0, 1440, 127, 'G');

/**
 * TABLE: funcionario
 * DESC: cadastros dos funcionários
 */
CREATE TABLE funcionario (
    codigoFuncionario INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
	remember_token VARCHAR(100) NULL,
    administrador BOOLEAN NOT NULL,
	criacao TIMESTAMP NULL,
    atualizacao TIMESTAMP NULL,
    codigoEstabelecimento INT DEFAULT 1
);

INSERT INTO funcionario VALUES (1, 'admin', 'caiogabriel1000@gmail.com', '', NULL, 1, NOW(), NULL, 1);

/**
 * TABLE: entregador
 * DESC: cadastros dos entregadores
 */
CREATE TABLE entregador (
    codigoEntregador INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(255) NOT NULL,
    inicioJornadaTrabalho INT NOT NULL,
    fimJornadaTrabalho INT NOT NULL,
    codigoEstabelecimento INT DEFAULT 1
);

/**
 * TABLE: cliente
 * DESC: cadastros dos clientes
 */
CREATE TABLE cliente (
    codigoCliente INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    situacao CHAR(1) NOT NULL,
	telefone BIGINT(11) NOT NULL,
	remember_token VARCHAR(100) NULL,
	criacao TIMESTAMP NULL,
    atualizacao TIMESTAMP NULL
);

/**
 * TABLE: entrega
 * DESC: entregas que podem ser geradas pelos pedidos
 */
CREATE TABLE entrega (
    codigoEntrega INT NOT NULL PRIMARY KEY auto_increment,
    situacao CHAR(1) NOT NULL,
    codigoPedido INT NOT NULL,
    codigoEndereco INT NOT NULL,
    codigoEntregador INT NOT NULL
);

/**
 * TABLE: endereco
 * DESC: endereços das entregas
 */
CREATE TABLE endereco (
    codigoEndereco INT NOT NULL PRIMARY KEY auto_increment,
    logradouro VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(45) NULL,
    cep INT NULL,
    codigoBairro INT NOT NULL
);

/**
 * TABLE: bairro
 * DESC: bairros em que as entregas podem ser realizadas
 */
CREATE TABLE bairro (
    codigoBairro INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(45) NOT NULL,
    valorFrete FLOAT NULL,
    codigoCidade INT NOT NULL
);

/**
 * TABLE: cidade
 * DESC: cidades em que as entregas podem ser realizadas
 */
CREATE TABLE cidade (
    codigoCidade INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(45) NOT NULL,
    estado CHAR(2) NOT NULL,
    valorFrete FLOAT NULL
);

/**
 * TABLE: pedido
 * DESC: pedidos dos clientes
 */
CREATE TABLE pedido (
    codigoPedido INT NOT NULL PRIMARY KEY auto_increment,
    valorTotal FLOAT NOT NULL,
    formaPagamento CHAR(1) NOT NULL,
    observacoes VARCHAR(45) NULL,
    situacao CHAR(1) NOT NULL,
    criacao timestamp DEFAULT NOW(),
    atualizacao timestamp NULL,
    codigoCliente INT NOT NULL
);

/**
 * TABLE: produto
 * DESC: produtos do estabelecimento
 */
CREATE TABLE produto (
    codigoProduto INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(45) NOT NULL,
	descricao VARCHAR(255) NULL,
    sku VARCHAR(10) NULL,
    valorUnitario FLOAT NOT NULL,
    quantidadeEstoque INT NOT NULL DEFAULT 1,
    codigoCategoria INT NULL
);

/**
 * TABLE: categoria
 * DESC: categorias que os produtos podem ter
 */
CREATE TABLE categoria (
    codigoCategoria INT NOT NULL PRIMARY KEY auto_increment,
    nome VARCHAR(45) NOT NULL
);

/**
 * TABLE: pagamento
 * DESC: pagamentos dos pedidos realizados
 */
CREATE TABLE pagamento (
    codigoPagamento INT NOT NULL PRIMARY KEY auto_increment,
    valor FLOAT NOT NULL,
    situacao CHAR(1) NOT NULL,
    codigoPedido INT NOT NULL
);

/**
 * Tabelas acessórias de telefones
 */
CREATE TABLE telefone_estabelecimento (
    telefoneEstabelecimento BIGINT(11) NOT NULL,
    codigoEstabelecimento INT NOT NULL
);

CREATE TABLE telefone_funcionario (
    telefoneFuncionario BIGINT(11),
    codigoFuncionario INT NOT NULL
);

CREATE TABLE telefone_entregador (
    telefoneEntregador BIGINT(11) NOT NULL,
    codigoEntregador INT NOT NULL
);

CREATE TABLE telefone_cliente (
    telefoneCliente BIGINT(11) NOT NULL,
    codigoCliente INT NOT NULL
);

CREATE TABLE pedido_produto (
    codigoProduto INT NOT NULL,
    codigoPedido INT NOT NULL,
	quantidade INT NOT NULL
);

/**
 * Relacionamentos
 */ 
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
 
ALTER TABLE produto ADD CONSTRAINT FK_Produto_1
    FOREIGN KEY (codigoCategoria)
    REFERENCES categoria (codigoCategoria);
 
ALTER TABLE pagamento ADD CONSTRAINT FK_Pagamento_1
    FOREIGN KEY (codigoPedido)
    REFERENCES pedido (codigoPedido);
 
ALTER TABLE telefone_estabelecimento ADD CONSTRAINT FK_telefone_estabelecimento_1
    FOREIGN KEY (codigoEstabelecimento)
    REFERENCES estabelecimento (codigoEstabelecimento);
 
ALTER TABLE telefone_funcionario ADD CONSTRAINT FK_telefone_funcionario_1
    FOREIGN KEY (codigoFuncionario)
    REFERENCES funcionario (codigoFuncionario);
 
ALTER TABLE telefone_entregador ADD CONSTRAINT FK_telefone_entregador_1
    FOREIGN KEY (codigoEntregador)
    REFERENCES entregador (codigoEntregador);
 
ALTER TABLE telefone_cliente ADD CONSTRAINT FK_telefone_cliente_1
    FOREIGN KEY (codigoCliente)
    REFERENCES cliente (codigoCliente);
 
ALTER TABLE pedido_produto ADD CONSTRAINT FK_pedido_produto_1
    FOREIGN KEY (codigoProduto)
    REFERENCES produto (codigoProduto);
 
ALTER TABLE pedido_produto ADD CONSTRAINT FK_pedido_produto_2
    FOREIGN KEY (codigoPedido)
    REFERENCES pedido (codigoPedido);
