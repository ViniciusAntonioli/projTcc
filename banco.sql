use master
create DATABASE  CatalogoDeBrindes;
GO

-- Uso do banco de dados
USE CatalogoDeBrindes;
GO

-- Tabela de Clientes
CREATE TABLE tblcliente (
    id_cliente INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    nome_empresa VARCHAR(50) NOT NULL,
    razao_social VARCHAR(100) NOT NULL,
    contato VARCHAR(50) NOT NULL,
    email VARCHAR(40) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cnpj CHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(15) NULL,
    data_criacao DATE DEFAULT GETDATE(),
    data_atualizacao DATE NULL,
    ativo BIT DEFAULT 1
);
GO
-- Tabela de Endere�os
CREATE TABLE tblendereco (
    id_endereco INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    id_cliente INT NOT NULL,
    tipo_endereco VARCHAR(20) CHECK (tipo_endereco IN ('cobranca', 'entrega')), -- Define o tipo
    logradouro VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(50) NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep CHAR(8) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES tblcliente(id_cliente) ON DELETE CASCADE
);
GO
-- Restri��o para garantir que um cliente tenha apenas um endere�o de cobran�a
CREATE UNIQUE INDEX idx_cliente_cobranca ON tblendereco(id_cliente, tipo_endereco) WHERE tipo_endereco = 'cobranca';
GO
CREATE TABLE tblcategoria (
    id_categoria INT IDENTITY(1,1) NOT NULL PRIMARY KEY, -- Auto incremento
    nome_categoria VARCHAR(50),
    categoria_pai_id INT NULL, -- Permite valores nulos
    CONSTRAINT chk_tblcategoria_id_categoria CHECK (id_categoria BETWEEN 1 AND 999999) -- Restri��o para 6 d�gitos
);
GO
CREATE TABLE tbltipo_material (
    id_tipo_material INT IDENTITY(1,1) NOT NULL PRIMARY KEY, -- Auto incremento
    nome_material VARCHAR(30),
    CONSTRAINT chk_tbltipo_material_id CHECK (id_tipo_material BETWEEN 1 AND 999999) -- Restri��o para 6 d�gitos
);
GO
CREATE TABLE tblperfil(
	id_perfil INT IDENTITY(1,1) NOT NULL PRIMARY KEY, -- Auto incremento
	nome_perfil varchar (15),
	descricao_perfil varchar (200),
    CONSTRAINT chk_tblpefil_id_pefil CHECK (id_perfil BETWEEN 1 AND 999999) -- Restri��o para 6 d�gitos
);
GO
CREATE TABLE tblfuncionario (
    id_funcionario INT IDENTITY(1,1) NOT NULL PRIMARY KEY, -- Auto incremento
    nome VARCHAR(50) NOT NULL, -- Nome obrigat�rio
    email VARCHAR(50) NOT NULL UNIQUE, -- E-mail usado como login, �nico
    senha VARCHAR(255) NOT NULL, -- Armazena hash da senha
    telefone VARCHAR(15) NULL, -- Telefone opcional
    id_perfil INT NOT NULL, -- Chave estrangeira para o perfil
    CONSTRAINT fk_tblfuncionario_perfil FOREIGN KEY (id_perfil) REFERENCES tblperfil(id_perfil),
    CONSTRAINT chk_tblfuncionario_id_funcionario CHECK (id_funcionario BETWEEN 1 AND 999999) -- Restri��o para 6 d�gitos
);
GO
create table tbltipo_pedido(
		id_tipo_pedido int identity(1,1) not null primary key,
		nome_tipo char(1),
		CONSTRAINT chk_tbltipo_pedido_id_tipo_pedido CHECK (id_tipo_pedido BETWEEN 1 AND 999999) -- Restri��o para 6 d�gitos
	)
	GO
-- Tabela tblpedido
CREATE TABLE tblpedido (
    id_pedido INT IDENTITY(1,1) NOT NULL PRIMARY KEY, -- Auto incremento
    data_pedido DATE DEFAULT GETDATE(), -- Define automaticamente a data do pedido
    id_funcionario INT NULL, -- Pode ser NULL caso o funcion�rio seja deletado
    id_cliente INT NULL, -- Pode ser NULL caso o cliente seja deletado
    id_tipo_pedido INT NULL, -- Tipo do pedido (opcional)
    
    -- Chaves estrangeiras com ON DELETE SET NULL para evitar perda de dados
    FOREIGN KEY (id_cliente) REFERENCES tblCliente(id_cliente) ON DELETE SET NULL,
    FOREIGN KEY (id_funcionario) REFERENCES tblfuncionario(id_funcionario) ON DELETE SET NULL,
    FOREIGN KEY (id_tipo_pedido) REFERENCES tbltipo_pedido (id_tipo_pedido),

    -- Restri��o para ID do pedido dentro do intervalo desejado
    CONSTRAINT chk_tblpedido_id_pedido CHECK (id_pedido BETWEEN 1 AND 999999)
);
GO
-- Tabela tblproduto
CREATE TABLE tblproduto (
    id_produto INT IDENTITY(1,1) NOT NULL PRIMARY KEY,    -- Auto incremento
    id_familia INT NOT NULL,                               -- Fam�lia do produto
    descricao_resumida VARCHAR(50),                        -- Descri��o resumida do produto
    descricao VARCHAR(500),                                -- Descri��o detalhada do produto
    peso VARCHAR(50),                                   -- Peso do produto
    medida VARCHAR(30),                                    -- Unidade de medida (ex: kg, unidade)
    data_cadastro DATE DEFAULT GETDATE(),                  -- Data de cadastro
    data_atualizacao DATE,                                 -- Data de atualiza��o
    preco DECIMAL(7, 2),                                   -- Pre�o do produto
    cor VARCHAR(15),                                       -- Cor do produto
    imagem_1 VARBINARY(MAX) NULL,                          -- Imagem 1
    imagem_2 VARBINARY(MAX) NULL,                          -- Imagem 2
    imagem_3 VARBINARY(MAX) NULL,                          -- Imagem 3
    imagem_4 VARBINARY(MAX) NULL,                          -- Imagem 4
    imagem_5 VARBINARY(MAX) NULL,                          -- Imagem 5
    quantidade_estoque INT,                                -- Quantidade dispon�vel no estoque
    id_tipo_material INT NOT NULL,                         -- Tipo de material (FK)
    id_categoria INT NOT NULL,                             -- Categoria do produto (FK)
    ativo BIT DEFAULT 1,                                   -- Indica se o produto est� ativo ou n�o
    video_url VARCHAR(500) NULL,                                -- Caminho ou URL do v�deo
    CONSTRAINT fk_tblproduto_id_tipo_material FOREIGN KEY (id_tipo_material) REFERENCES tbltipo_material(id_tipo_material),
    CONSTRAINT fk_tblproduto_id_categoria FOREIGN KEY (id_categoria) REFERENCES tblcategoria(id_categoria),
    CONSTRAINT chk_tblproduto_id_produto CHECK (id_produto BETWEEN 1 AND 999999) -- Restri��o para 6 d�gitos

);
GO
-- Tabela tblproduto_pedido
CREATE TABLE tblproduto_pedido (
    id_produto INT NOT NULL,
    id_pedido INT NOT NULL,
    quantidade INT NOT NULL,
	valor_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES tblproduto(id_produto),
    FOREIGN KEY (id_pedido) REFERENCES tblpedido(id_pedido)

);
GO

INSERT INTO tblcliente (nome_empresa, razao_social, contato, email, senha, cnpj, telefone, data_criacao, ativo)  
VALUES  
('Tech Solu��es', 'Tech Solu��es LTDA', 'Jo�o Silva', 'contato@techsolucoes.com', 'hash_senha1', '12345678000195', '(11) 91234-5678', GETDATE(), 1),  
('SoftWay', 'SoftWay Tecnologia LTDA', 'Maria Oliveira', 'maria@softway.com', 'hash_senha2', '98765432000188', '(21) 99876-5432', GETDATE(), 1),  
('InovaTech', 'InovaTech Sistemas SA', 'Carlos Mendes', 'carlos@inovatech.com', 'hash_senha3', '10293847000177', '(31) 93456-7890', GETDATE(), 1),  
('MegaCom', 'MegaCom Telecomunica��es LTDA', 'Ana Souza', 'ana@megacom.com', 'hash_senha4', '56473829000166', '(11) 92345-6789', GETDATE(), 1),  
('Lima Consultoria', 'Lima Consultoria Empresarial ME', 'Bruno Lima', 'bruno@limaconsultoria.com', 'hash_senha5', '74859613000144', '(41) 98888-7777', GETDATE(), 1),  
('Costa & Associados', 'Costa & Associados LTDA', 'Fernanda Costa', 'fernanda@costaassociados.com', 'hash_senha6', '11122233000122', '(31) 97777-6666', GETDATE(), 1),  
('Martins Log�stica', 'Martins Transporte e Log�stica LTDA', 'Pedro Martins', 'pedro@martinslog.com', 'hash_senha7', '55566677000111', '(51) 96666-5555', GETDATE(), 1),  
('Florian�polis Tech', 'Florian�polis Tecnologia e Inova��o LTDA', 'Juliana Pereira', 'juliana@florianopolistech.com', 'hash_senha8', '77788899000133', '(48) 95555-4444', GETDATE(), 1),  
('Alves Seguran�a', 'Alves Seguran�a Patrimonial LTDA', 'Ricardo Alves', 'ricardo@alvessegs.com', 'hash_senha9', '99900011000155', '(11) 94444-3333', GETDATE(), 1),  
('Recife Solutions', 'Recife Solutions LTDA', 'Larissa Fernandes', 'larissa@recifesolutions.com', 'hash_senha10', '33344455000199', '(81) 93333-2222', GETDATE(), 1);  

INSERT INTO tblendereco (id_cliente, tipo_endereco, logradouro, numero, complemento, bairro, cidade, estado, cep)  
VALUES  
(1, 'cobranca', 'Rua das Flores', '123', 'Apto 101', 'Centro', 'S�o Paulo', 'SP', '01001000'),  
(2, 'cobranca', 'Av. Brasil', '456', NULL, 'Copacabana', 'Rio de Janeiro', 'RJ', '22041001'),  
(3, 'cobranca', 'Rua das Palmeiras', '789', NULL, 'Centro', 'Belo Horizonte', 'MG', '30130001'),  
(4, 'cobranca', 'Av. Paulista', '1500', 'Sala 12', 'Bela Vista', 'S�o Paulo', 'SP', '01310000'),  
(5, 'cobranca', 'Rua XV de Novembro', '50', NULL, 'Centro', 'Curitiba', 'PR', '80020010'),  
(6, 'cobranca', 'Rua Bahia', '200', 'Bloco B', 'Funcion�rios', 'Belo Horizonte', 'MG', '30160001'),  
(7, 'cobranca', 'Av. Get�lio Vargas', '300', NULL, 'Centro', 'Porto Alegre', 'RS', '90010001'),  
(8, 'cobranca', 'Rua Amazonas', '400', 'Casa 2', 'Vila Nova', 'Florian�polis', 'SC', '88010000'),  
(9, 'cobranca', 'Av. Ipiranga', '789', NULL, 'Rep�blica', 'S�o Paulo', 'SP', '01046000'),  
(10, 'cobranca', 'Rua do Com�rcio', '150', 'Sala 5', 'Centro', 'Recife', 'PE', '50010010');  

INSERT INTO tblendereco (id_cliente, tipo_endereco, logradouro, numero, complemento, bairro, cidade, estado, cep)  
VALUES  
-- Cliente 1 (Tech Solu��es) tem dois endere�os de entrega  
(1, 'entrega', 'Rua das Rosas', '200', NULL, 'Jardins', 'S�o Paulo', 'SP', '01410001'),  
(1, 'entrega', 'Av. Industrial', '500', NULL, 'Vila Leopoldina', 'S�o Paulo', 'SP', '05315000'),  

-- Cliente 2 (SoftWay) tem um endere�o de entrega  
(2, 'entrega', 'Rua Copacabana', '789', NULL, 'Centro', 'Rio de Janeiro', 'RJ', '20211000'),  

-- Cliente 3 (InovaTech) tem dois endere�os de entrega  
(3, 'entrega', 'Av. Afonso Pena', '1000', NULL, 'Centro', 'Belo Horizonte', 'MG', '30120001'),  
(3, 'entrega', 'Rua Sapuca�', '333', NULL, 'Floresta', 'Belo Horizonte', 'MG', '30130000'),  

-- Cliente 5 (Lima Consultoria) tem um endere�o de entrega  
(5, 'entrega', 'Rua Marechal Deodoro', '120', NULL, 'Batel', 'Curitiba', 'PR', '80240001');  


INSERT INTO tblperfil (nome_perfil, descricao_perfil)
VALUES
('Administrador', 'Respons�vel por gerenciar o sistema, cadastrar usu�rios e administrar permiss�es'),
('Atendente', 'Respons�vel por atender clientes e processar pedidos no sistema'),
('Gerente', 'Gerencia equipes e opera��es relacionadas ao sistema de brindes promocionais');
SELECT * FROM tblperfil

-- Inser��o de funcion�rios
INSERT INTO tblfuncionario (nome, email, senha, id_perfil) VALUES
('Carlos Silva', 'carlos.silva@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 1),  -- Administrador
('Fernanda Souza', 'fernanda.souza@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2), -- Atendente
('Jo�o Pereira', 'joao.pereira@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2), -- Atendente
('Mariana Oliveira', 'mariana.oliveira@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2), -- Atendente
('Roberto Lima', 'roberto.lima@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 1), -- Administrador
('Aline Costa', 'aline.costa@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2), -- Atendente
('Ricardo Mendes', 'ricardo.mendes@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2), -- Atendente
('Juliana Alves', 'juliana.alves@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 1), -- Administrador
('Paulo Fernandes', 'paulo.fernandes@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2), -- Atendente
('Vanessa Martins', 'vanessa.martins@empresa.com', HASHBYTES('SHA2_256', 'Senha123'), 2); -- Atendente


SELECT * FROM tblfuncionario


INSERT INTO tbltipo_material (nome_material)
VALUES
('Pl�stico'), ('Metal'), ('Vidro'), ('Madeira'), ('Papel'),
('Borracha'), ('Acr�lico'), ('Cer�mica'), ('Tecido'), ('Couro'),
('Silicone'), ('Porcelana'), ('Policarbonato'), ('Fibra'), ('Resina'),
('Nylon'), ('Poli�ster'), ('L�'), ('Bambu'), ('Algod�o');



INSERT INTO tblcategoria (nome_categoria, categoria_pai_id)
VALUES
-- Categorias principais
('Escrit�rio', NULL),
('Ecol�gicos', NULL),
('Moda', NULL),
('Utilidades Dom�sticas', NULL),
('Brindes Premium', NULL),
('Tecnologia', NULL),

-- Subcategorias
('Canetas', 1),            -- Categoria Pai: Escrit�rio
('Mochilas', 3),           -- Categoria Pai: Moda
('Sacolas', 2),            -- Categoria Pai: Ecol�gicos
('Porta-J�ias', 5),        -- Categoria Pai: Brindes Premium
('Bolinha Anti-Stress', 5),-- Categoria Pai: Brindes Premium
('Copo Pl�stico', 4),      -- Categoria Pai: Utilidades Dom�sticas
('Copo T�rmico', 4),       -- Categoria Pai: Utilidades Dom�sticas
('Garrafa T�rmica', 4);    -- Categoria Pai: Utilidades Dom�sticas

SELECT * FROM tblcategoria;
INSERT INTO tblproduto (
    id_familia, descricao_resumida, descricao, peso, medida, 
    preco, cor, imagem_1, imagem_2, imagem_3, imagem_4, imagem_5, quantidade_estoque, id_tipo_material, 
    id_categoria, ativo, video_url
)
VALUES
-- Garrafas
(511, 'Garrafa T�rmica', 'Garrafa t�rmica de a�o inoxid�vel, 500ml.', '600g', '25x7cm', 
    35.90, 'Prata', NULL, NULL, NULL, NULL, NULL, 100, 1, 8, 1, NULL),
(18518, 'Garrafa Esportiva', 'Garrafa esportiva de pl�stico, 700ml.', '500g', '23x6cm', 
    25.50, 'Preto', NULL, NULL, NULL, NULL, NULL, 150, 1, 8, 1, NULL),

-- Canetas
(2079, 'Caneta Personalizada Azul', 'Caneta esferogr�fica personalizada com tinta azul.', '20g', '14x1cm', 
    2.50, 'Azul', NULL, NULL, NULL, NULL, NULL, 500, 2, 7, 1, NULL),
(3011, 'Caneta Luxo', 'Caneta de luxo em metal, ideal para brindes corporativos.', '30g', '15x1cm', 
    12.99, 'Dourado', NULL, NULL, NULL, NULL, NULL, 200, 2, 7, 1, NULL),

-- Mochilas
(9139, 'Mochila Esportiva', 'Mochila resistente para esportes.', '1200g', '45x30x15cm', 
    120.00, 'Preto', NULL, NULL, NULL, NULL, NULL, 50, 3, 9, 1, NULL),
(12487, 'Mochila para Notebook', 'Mochila com compartimento para notebook de at� 15".', '1500g', '48x32x18cm', 
    180.00, 'Cinza', NULL, NULL, NULL, NULL, NULL, 30, 3, 9, 1, NULL),

-- Sacolas
(17011, 'Sacola Ecol�gica', 'Sacola ecol�gica reutiliz�vel.', '200g', '35x40cm', 
    15.00, 'Verde', NULL, NULL, NULL, NULL, NULL, 1000, 4, 10, 1, NULL),
(693, 'Sacola Dobr�vel', 'Sacola dobr�vel compacta para facilitar o transporte.', '150g', '30x35cm', 
    10.00, 'Azul', NULL, NULL, NULL, NULL, NULL, 800, 4, 10, 1, NULL),

-- Porta-J�ias
(1618, 'Porta-J�ias Compacto', 'Porta-j�ias compacto com divis�rias.', '300g', '10x10x5cm', 
    50.00, 'Branco', NULL, NULL, NULL, NULL, NULL, 150, 5, 11, 1, NULL),
(1622, 'Porta-J�ias Luxo', 'Porta-j�ias em couro sint�tico com acabamento premium.', '500g', '15x15x7cm', 
    120.00, 'Marrom', NULL, NULL, NULL, NULL, NULL, 80, 5, 11, 1, NULL),

-- Bolinhas Anti-Stress
(18639, 'Bolinha Anti-Stress', 'Bolinha anti-stress colorida e macia.', '50g', '6x6x6cm', 
    8.50, 'Multicolorida', NULL, NULL, NULL, NULL, NULL, 1000, 6, 12, 1, NULL),

-- Copos
(3889, 'Copo Pl�stico', 'Copo pl�stico personalizado, 300ml.', '100g', '12x7cm', 
    4.50, 'Branco', NULL, NULL, NULL, NULL, NULL, 1000, 1, 13, 1, NULL),
(8578, 'Copo T�rmico', 'Copo t�rmico em a�o inoxid�vel, 450ml.', '400g', '20x8cm', 
    35.00, 'Preto', NULL, NULL, NULL, NULL, NULL, 200, 1, 14, 1, NULL);

-- Inser��o dos tipos de pedidos (Site e Mobile)
INSERT INTO tbltipo_pedido (nome_tipo)  
VALUES ('S'),  -- S para Site
       ('M');  -- M para Mobile


-- Inser��o de pedidos
INSERT INTO tblpedido (id_cliente, id_funcionario, id_tipo_pedido, data_pedido)
VALUES  
(1, NULL, 1, GETDATE()),  -- Tech Solu��es, Pedido via Site
(2, NULL, 1, GETDATE()),  -- SoftWay, Pedido via Site
(3, NULL, 1, GETDATE()),  -- InovaTech, Pedido via Site
(4, NULL, 1, GETDATE()),  -- MegaCom, Pedido via Site
(5, NULL, 1, GETDATE()),  -- Lima Consultoria, Pedido via Site
(6, NULL, 1, GETDATE()),  -- Costa & Associados, Pedido via Site
(7, NULL, 1, GETDATE()),  -- Martins Log�stica, Pedido via Site
(8, NULL, 2, GETDATE()),  -- Florian�polis Tech, Pedido via Mobile
(9, NULL, 2, GETDATE()),  -- Alves Seguran�a, Pedido via Mobile
(10, NULL, 2, GETDATE()); -- Recife Solutions, Pedido via Mobile

-- Inser��o de produtos para pedidos
-- Inser��o de produtos para pedidos
INSERT INTO tblproduto_pedido (id_produto, id_pedido, quantidade, valor_unitario)  
VALUES  
(1, 1, 2, 35.90),  -- Pedido 1 (Tech Solu��es): Garrafa T�rmica (2 unidades)
(2, 1, 3, 25.50),  -- Pedido 1 (Tech Solu��es): Garrafa Esportiva (3 unidades)
(3, 2, 5, 2.50),   -- Pedido 2 (SoftWay): Caneta Personalizada Azul (5 unidades)
(4, 2, 2, 12.99),  -- Pedido 2 (SoftWay): Caneta Luxo (2 unidades)
(5, 3, 1, 120.00), -- Pedido 3 (InovaTech): Mochila Esportiva (1 unidade)
(6, 3, 1, 180.00), -- Pedido 3 (InovaTech): Mochila para Notebook (1 unidade)
(7, 4, 10, 15.00), -- Pedido 4 (MegaCom): Sacola Ecol�gica (10 unidades)
(8, 4, 8, 10.00),  -- Pedido 4 (MegaCom): Sacola Dobr�vel (8 unidades)
(9, 5, 3, 50.00),  -- Pedido 5 (Lima Consultoria): Porta-J�ias Compacto (3 unidades)
(10, 5, 1, 120.00),-- Pedido 5 (Lima Consultoria): Porta-J�ias Luxo (1 unidade)
(11, 6, 5, 8.50),  -- Pedido 6 (Costa & Associados): Bolinha Anti-Stress (5 unidades)
(12, 6, 2, 4.50),  -- Pedido 6 (Costa & Associados): Copo Pl�stico (2 unidades)
(13, 7, 4, 35.00); -- Pedido 7 (Martins Log�stica): Copo T�rmico (4 unidades)


select*from tblproduto


----------------------------------------- Para teste de recupera��o de senha
use CatalogoDeBrindes

select * from tblcliente

insert into tblcliente values ('admin2', 'admin2', 'admin2', 'visto.agora0@gmail.com', '$2y$10$kv/oIXI80lPUwmRfgCmA7eTTs3PF8lKC7J1c.Q7x3xBmkR3HiGjt6', 11111, 11112, getdate(), null,1)

-- Login admin2
-- Senha 123

select * from tblcliente

CREATE TABLE password_resets (
    id INT identity PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires_at DATETIME NOT NULL
);

