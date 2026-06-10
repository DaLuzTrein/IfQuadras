DROP DATABASE IF EXISTS IfQuadras;
CREATE DATABASE IfQuadras;
USE IfQuadras;

CREATE TABLE quadra (
    idQuadra INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomeQuadra VARCHAR(255),
    tipoMaterial VARCHAR(255),
    esporte VARCHAR(255),
    precoQuadra DECIMAL(10, 2)
);

CREATE TABLE funcionario (
    idFuncionario INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomeFuncionario VARCHAR(255) NOT NULL,
    telefone VARCHAR(15),
    turno VARCHAR(10)
);

CREATE TABLE cliente (
    idCliente INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomeCliente VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) UNIQUE,
    telefone VARCHAR(15)
);

CREATE TABLE login(
	idLogin INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nomeLogin VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	senha VARCHAR(255) NOT NULL,
	adm BOOLEAN DEFAULT 0,
	idCliente INT NOT NULL,
	FOREIGN KEY (idCliente) REFERENCES cliente (idCliente)
);

CREATE TABLE equipamento (
    idEquipamento INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipo VARCHAR(255),
    quantidade INT,
    precoEquipamento DECIMAL(10,2)
);

CREATE TABLE reservaQuadra (
    idReservaQuadra INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
    dataReserva DATE,
    horarioInicio TIME,
    horarioFim TIME,
    idCliente INT,
    idQuadra INT,
    FOREIGN KEY (idCliente) REFERENCES cliente(idCliente) ON DELETE SET NULL,
    FOREIGN KEY (idQuadra) REFERENCES quadra(idQuadra) ON DELETE SET NULL
);

CREATE TABLE reservaEquipamento (
 idReservaEquipamento INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
 quantidadeAlugada INT,
 precoTotal DECIMAL(10,2),
 idEquipamento INT,
 idCliente INT,
 idReservaQuadra INT,
 FOREIGN KEY (idReservaQuadra) REFERENCES reservaQuadra(idReservaQuadra) ON DELETE SET NULL,
 FOREIGN KEY (idCliente) REFERENCES cliente(idCliente) ON DELETE SET NULL,
 FOREIGN KEY (idEquipamento) REFERENCES equipamento(idEquipamento) ON DELETE SET NULL
);

INSERT INTO cliente(nomeCliente, cpf, telefone) VALUES 
('ADM', '0', '0'),
('Arthur', '05601766002', '51985327349'),
('Bitello', '10987654321', '51732180937'),
('Richard', '12345678910', '51804638652');

INSERT INTO login(nomeLogin, email, senha, idCliente) VALUES 
('Arthur', 'arthur@gmail.com', '$2y$10$mdm.uftvyvJRF1HkBmwn6eN.hc5E27unFsQNZx5lq3eTCymgUUY0q', 2),
('Bitello', 'bitello@hotmail.com', '$10$MqGF9OPawjAVIFfPHPizguCggMcr8GZp/L1Rkr81T039yE53iD.0a', 3),
('Richard', 'richard@gmail.com', '$2y$10$6DxfOqD7PPm9fQ46Gb7peO3EeHZgEg373Kfl7QKio.YRYXYU4oYRC', 4);

INSERT INTO quadra(nomeQuadra, tipoMaterial, esporte, precoQuadra) VALUES 
('Quadra Futsal 1', 'Concreto', 'Futsal', 29.90),
('Quadra Futebol 1', 'Grama', 'Futebol', 49.90),
('Quadra Volei 1', 'Areia', 'Volei', 60.00);

INSERT INTO funcionario(nomeFuncionario, telefone, turno) VALUES 
('Gustavo', '51997887211', 'Manhã'),
('Augusto', '51999201532', 'Tarde'),
('Guilherme', '35997539635', 'Noite');

INSERT INTO equipamento(tipo, quantidade, precoEquipamento) VALUES 
('Bola de futsal', '4', 4.90),
('Bola de volei', '7', 5.00),
('Colete', '30', 0.10);

INSERT INTO reservaQuadra(dataReserva, horarioInicio, horarioFim, idCliente, idQuadra) VALUES 
('2025-11-19', '12:30', '14:00', '2', '1'),
('2025-11-19', '16:30', '18:00', '3', '3'),
('2025-11-19', '7:30', '11:30', '4', '3');

-- Senha: admin
INSERT INTO login(nomeLogin, email, senha, adm, idCliente) VALUES
("admin", "admin@ifquadras.com", "$2y$10$1JstDhELJp5z5LcUzSLLU.bos5Kvje07.5ymmJ6OOOenbHnqVdPlu", 1, 1);

CREATE VIEW mostrarReservasQuadras AS
SELECT r.idReservaQuadra, c.idCliente, c.nomeCliente, q.nomeQuadra, r.dataReserva, r.horarioInicio, r.horarioFim 
FROM reservaQuadra r
JOIN cliente c ON r.idCliente = c.idCliente
JOIN quadra q ON r.idQuadra = q.idQuadra
ORDER BY r.dataReserva, r.horarioInicio;

CREATE VIEW mostrarReservasEquipamentos AS
SELECT re.idReservaEquipamento, rq.idReservaQuadra, c.idCliente, c.nomeCliente, e.tipo, re.precoTotal
FROM reservaEquipamento re
JOIN cliente c ON re.idCliente = c.idCliente
JOIN reservaQuadra rq ON re.idReservaQuadra = rq.idReservaQuadra
JOIN equipamento e ON re.idEquipamento = e.idEquipamento;

CREATE VIEW totalGastoPorCliente AS
SELECT c.idCliente, c.nomeCliente, COALESCE(SUM(q.precoQuadra), 0) + COALESCE(SUM(e.precoEquipamento), 0) AS precoTotal
FROM cliente c
LEFT JOIN reservaQuadra rq 
ON c.idCliente = rq.idCliente
LEFT JOIN quadra q 
ON rq.idQuadra = q.idQuadra
LEFT JOIN reservaEquipamento re 
ON c.idCliente = re.idCliente
LEFT JOIN equipamento e 
ON re.idEquipamento = e.idEquipamento
GROUP BY c.idCliente, c.nomeCliente;

CREATE VIEW clientesBurgueses AS
SELECT c.idCliente, c.nomeCliente, COALESCE(SUM(q.precoQuadra), 0) + COALESCE(SUM(e.precoEquipamento), 0) AS precoTotal
FROM cliente c
LEFT JOIN reservaQuadra rq 
ON c.idCliente = rq.idCliente
LEFT JOIN quadra q 
ON rq.idQuadra = q.idQuadra
LEFT JOIN reservaEquipamento re 
ON c.idCliente = re.idCliente
LEFT JOIN equipamento e 
ON re.idEquipamento = e.idEquipamento
GROUP BY c.idCliente, c.nomeCliente
HAVING precoTotal >= 100.00;

CREATE VIEW numeroDeReservasDeQuadras AS
SELECT COUNT(*) FROM reservaQuadra;

CREATE VIEW separacaoDeReservasPorCliente AS
SELECT c.idCliente, GROUP_CONCAT(rq.idReservaQuadra SEPARATOR ' | ')
FROM Cliente c
LEFT JOIN reservaQuadra rq
ON c.idCliente = rq.idCliente
GROUP BY c.idCliente;

-- SELECT r.idReservaQuadra, c.nomeCliente, q.nomeQuadra, f.nomeFuncionario, r.dataReserva, r.horarioInicio, r.horarioFim 
-- FROM reservaQuadra r
-- JOIN cliente c ON r.idCliente = c.idCliente
-- JOIN quadra q ON r.idQuadra = q.idQuadra
-- JOIN funcionario f ON r.idFuncionario = f.idFuncionario
-- ORDER BY r.dataReserva, r.horarioInicio;