/*
SysVet
*/

--TABELA DE ESTADOS
CREATE TABLE states(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    acronym VARCHAR(2)
);
--TABELA DO CLIENTE
CREATE TABLE costumers(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(11),
    name VARCHAR(50),
    bornDate DATE,
    phone VARCHAR(11),
    email VARCHAR(50),
    cep VARCHAR(8),
    neighborhood VARCHAR(50),
    street VARCHAR(50),
    number VARCHAR(4),
    complement VARCHAR(50),
    reference VARCHAR(50),
    city VARCHAR(50),
    idState INTEGER REFERENCES states(id)
);

--TABELA DO TIPO DO ANIMAL (AVE, MAMIFERO, PEIXE, REPTIL)
CREATE TABLE animalTypes(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);

--TABELA DE ESPÉCIE DO ANIMAL (CACHORRO, GATO, CALOPSITA, PIRIQUITO, COBRA, LAGARTO)
CREATE TABLE species(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    idAnimalType INTEGER REFERENCES animalTypes(id)
);

--TABELA DO GENERO ANIMAL
CREATE TABLE genders(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    acronym VARCHAR(1)
);
--TABELA DO ANIMAL
CREATE TABLE animals(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    idGender INTEGER REFERENCES genders(id),
    idSpecie INTEGER REFERENCES species(id),
    idCostumer INTEGER REFERENCES costumers(id)
);

INSERT INTO states (name, acronym) VALUES
('Acre','AC'),('Alagoas','AL'),('Amapá','AP'),
('Amazonas','AM'),('Bahia','BA'),('Ceará','CE'),
('Goiás','GO'),('Maranhão','MA'),('Mato Grosso','MT'),
('Mato Grosso do Sul','MS'),('Minas Gerais','MG'),('Pará','PA'),
('Paraíba','PB'),('Paraná','PR'),('Pernambuco','PE'),
('Piauí','PI'),('Rio de Janeiro','RJ'),('Rio Grande do Norte','RN'),
('Rio Grande do Sul','RS'),('Rondônia','RO'),('Roraima','RR'),
('Santa Catarina','SC'),('São Paulo','SP'),('Sergipe','SE'),
('Tocantins','TO'),('Distrito Federal','DF');

INSERT INTO genders (name, acronym) VALUES
('Macho','M'),('Fêmea','F'),('NÃO INFORMADO','?');

INSERT INTO animalTypes (name) VALUES
('Ave'),('Cachorro'),('Gato'),('Réptil');