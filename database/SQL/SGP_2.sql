CREATE TABLE `cidade` (
  `codigoCidade` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `estado` char(2) NOT NULL,
  `valorFrete` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cidade` (`codigoCidade`, `nome`, `estado`, `valorFrete`) VALUES
(1, 'Belo Horizonte', 'MG', 0);

CREATE TABLE `bairro` (
  `codigoBairro` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `valorFrete` double DEFAULT NULL,
  `codigoCidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bairro` (`codigoBairro`, `nome`, `valorFrete`, `codigoCidade`) VALUES
(1, 'Centro', 1.5, 1),
(2, 'Lagoinha', 1.5, 1);

CREATE TABLE `categoria` (
  `codigoCategoria` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categoria` (`codigoCategoria`, `nome`) VALUES
(1, 'categoria 1');

CREATE TABLE `cliente` (
  `codigoCliente` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `situacao` char(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `endereco` (
  `codigoEndereco` int(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `codigoBairro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `entrega` (
  `codigoEntrega` int(11) NOT NULL,
  `situacao` char(1) NOT NULL,
  `codigoPedido` int(11) NOT NULL,
  `codigoEndereco` int(11) NOT NULL,
  `codigoEntregador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `entregador` (
  `codigoEntregador` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `inicioJornadaTrabalho` int(11) NOT NULL,
  `fimJornadaTrabalho` int(11) NOT NULL,
  `codigoEstabelecimento` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `entregador` (`codigoEntregador`, `nome`, `inicioJornadaTrabalho`, `fimJornadaTrabalho`, `codigoEstabelecimento`) VALUES
(1, 'Entregador 1', 0, 1440, 1);

CREATE TABLE `estabelecimento` (
  `codigoEstabelecimento` int(11) NOT NULL DEFAULT '1',
  `razaoSocial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomeFantasia` varchar(45) NOT NULL,
  `cnpj` bigint(20) DEFAULT NULL,
  `inicioJornadaFuncionamento` int(11) NOT NULL,
  `fimJornadaFuncionamento` int(11) NOT NULL,
  `diasFuncionamento` int(11) NOT NULL,
  `identidadeVisual` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `estabelecimento` (`codigoEstabelecimento`, `razaoSocial`, `nomeFantasia`, `cnpj`, `inicioJornadaFuncionamento`, `fimJornadaFuncionamento`, `diasFuncionamento`, `identidadeVisual`) VALUES
(1, 'SGP', 'SGP', 12345678901234, 0, 1440, 127, 'G');

CREATE TABLE `funcionario` (
  `codigoFuncionario` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pagamento` (
  `codigoPagamento` int(11) NOT NULL,
  `valor` double NOT NULL,
  `situacao` char(1) NOT NULL,
  `codigoPedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pedido` (
  `codigoPedido` int(11) NOT NULL,
  `valorTotal` double NOT NULL,
  `formaPagamento` char(1) NOT NULL,
  `observacoes` varchar(45) DEFAULT NULL,
  `situacao` char(1) NOT NULL,
  `criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizacao` datetime DEFAULT NULL,
  `codigoCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pedido_produto` (
  `codigoProduto` int(11) NOT NULL,
  `codigoPedido` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `produto` (
  `codigoProduto` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `sku` varchar(10) DEFAULT NULL,
  `valorUnitario` double NOT NULL,
  `quantidadeEstoque` int(11) NOT NULL DEFAULT '1',
  `codigoCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `telefone_cliente` (
  `telefoneCliente` bigint(20) NOT NULL,
  `codigoCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `telefone_entregador` (
  `telefoneEntregador` bigint(20) NOT NULL,
  `codigoEntregador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `telefone_estabelecimento` (
  `telefoneEstabelecimento` bigint(20) NOT NULL,
  `codigoEstabelecimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `telefone_funcionario` (
  `telefoneFuncionario` bigint(20) DEFAULT NULL,
  `codigoFuncionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `bairro`
  ADD PRIMARY KEY (`codigoBairro`),
  ADD KEY `FK_Bairro_1` (`codigoCidade`);

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigoCategoria`);

ALTER TABLE `cidade`
  ADD PRIMARY KEY (`codigoCidade`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigoCliente`),
  ADD UNIQUE KEY `cliente_email_unique` (`email`);

ALTER TABLE `endereco`
  ADD PRIMARY KEY (`codigoEndereco`),
  ADD KEY `FK_Endereco_1` (`codigoBairro`);

ALTER TABLE `entrega`
  ADD PRIMARY KEY (`codigoEntrega`),
  ADD KEY `FK_Entrega_1` (`codigoPedido`),
  ADD KEY `FK_Entrega_2` (`codigoEndereco`),
  ADD KEY `FK_Entrega_3` (`codigoEntregador`);

ALTER TABLE `entregador`
  ADD PRIMARY KEY (`codigoEntregador`),
  ADD KEY `FK_Entregador_1` (`codigoEstabelecimento`);

ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`codigoEstabelecimento`);

ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`codigoFuncionario`),
  ADD UNIQUE KEY `funcionario_email_unique` (`email`);

ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`codigoPagamento`),
  ADD KEY `FK_Pagamento_1` (`codigoPedido`);

ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codigoPedido`),
  ADD KEY `FK_Pedido_1` (`codigoCliente`);

ALTER TABLE `pedido_produto`
  ADD KEY `FK_pedido_produto_1` (`codigoProduto`),
  ADD KEY `FK_pedido_produto_2` (`codigoPedido`);

ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigoProduto`),
  ADD KEY `FK_Produto_1` (`codigoCategoria`);

ALTER TABLE `telefone_cliente`
  ADD KEY `FK_telefone_cliente_1` (`codigoCliente`);

ALTER TABLE `telefone_entregador`
  ADD KEY `FK_telefone_entregador_1` (`codigoEntregador`);

ALTER TABLE `telefone_estabelecimento`
  ADD KEY `FK_telefone_estabelecimento_1` (`codigoEstabelecimento`);

ALTER TABLE `telefone_funcionario`
  ADD KEY `FK_telefone_funcionario_1` (`codigoFuncionario`);


ALTER TABLE `bairro`
  MODIFY `codigoBairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `categoria`
  MODIFY `codigoCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `cidade`
  MODIFY `codigoCidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `cliente`
  MODIFY `codigoCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `endereco`
  MODIFY `codigoEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `entrega`
  MODIFY `codigoEntrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `entregador`
  MODIFY `codigoEntregador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `funcionario`
  MODIFY `codigoFuncionario` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `pagamento`
  MODIFY `codigoPagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `pedido`
  MODIFY `codigoPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `produto`
  MODIFY `codigoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;


ALTER TABLE `bairro`
  ADD CONSTRAINT `FK_Bairro_1` FOREIGN KEY (`codigoCidade`) REFERENCES `cidade` (`codigoCidade`);

ALTER TABLE `endereco`
  ADD CONSTRAINT `FK_Endereco_1` FOREIGN KEY (`codigoBairro`) REFERENCES `bairro` (`codigoBairro`);

ALTER TABLE `entrega`
  ADD CONSTRAINT `FK_Entrega_1` FOREIGN KEY (`codigoPedido`) REFERENCES `pedido` (`codigoPedido`),
  ADD CONSTRAINT `FK_Entrega_2` FOREIGN KEY (`codigoEndereco`) REFERENCES `endereco` (`codigoEndereco`),
  ADD CONSTRAINT `FK_Entrega_3` FOREIGN KEY (`codigoEntregador`) REFERENCES `entregador` (`codigoEntregador`);

ALTER TABLE `entregador`
  ADD CONSTRAINT `FK_Entregador_1` FOREIGN KEY (`codigoEstabelecimento`) REFERENCES `estabelecimento` (`codigoEstabelecimento`);

ALTER TABLE `pagamento`
  ADD CONSTRAINT `FK_Pagamento_1` FOREIGN KEY (`codigoPedido`) REFERENCES `pedido` (`codigoPedido`);

ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_Pedido_1` FOREIGN KEY (`codigoCliente`) REFERENCES `cliente` (`codigoCliente`);

ALTER TABLE `pedido_produto`
  ADD CONSTRAINT `FK_pedido_produto_1` FOREIGN KEY (`codigoProduto`) REFERENCES `produto` (`codigoProduto`),
  ADD CONSTRAINT `FK_pedido_produto_2` FOREIGN KEY (`codigoPedido`) REFERENCES `pedido` (`codigoPedido`);

ALTER TABLE `produto`
  ADD CONSTRAINT `FK_Produto_1` FOREIGN KEY (`codigoCategoria`) REFERENCES `categoria` (`codigoCategoria`);

ALTER TABLE `telefone_cliente`
  ADD CONSTRAINT `FK_telefone_cliente_1` FOREIGN KEY (`codigoCliente`) REFERENCES `cliente` (`codigoCliente`);

ALTER TABLE `telefone_entregador`
  ADD CONSTRAINT `FK_telefone_entregador_1` FOREIGN KEY (`codigoEntregador`) REFERENCES `entregador` (`codigoEntregador`);

ALTER TABLE `telefone_estabelecimento`
  ADD CONSTRAINT `FK_telefone_estabelecimento_1` FOREIGN KEY (`codigoEstabelecimento`) REFERENCES `estabelecimento` (`codigoEstabelecimento`);

ALTER TABLE `telefone_funcionario`
  ADD CONSTRAINT `FK_telefone_funcionario_1` FOREIGN KEY (`codigoFuncionario`) REFERENCES `funcionario` (`codigoFuncionario`);
