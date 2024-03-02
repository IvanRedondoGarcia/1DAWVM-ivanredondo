create database finalivanredondo;
use finalivanredondo;

CREATE TABLE usuarios (
  usuario VARCHAR(200) NOT NULL,
  contrasena VARCHAR(200) NOT NULL,
  constraint pk_usuarios_usuario primary key(usuario)
);

create table canciones (
    codca varchar(200) NOT NULL,
    nombre varchar(200) NOT NULL,
    autor varchar(200) NOT NULL,
    constraint pk_canciones_codca primary key (codca)
);

insert into canciones values ("C1","Nombre Direccion","Kaze");
insert into canciones values ("C2","Callejero","Dollar Selmouni");
insert into canciones values ("C3","Columbia","Quevedo");
insert into canciones values ("C4","Me Pregunto","Miranda");
insert into canciones values ("C5","Efecto","Khea");
insert into canciones values ("C6","Supernova","Saiko");
insert into canciones values ("C7","Rapido","Mora");
insert into canciones values ("C8","Nomada","Rubin");
insert into canciones values ("C9","Antes","Rvfv");
insert into canciones values ("C10","Lala","Myke Towers");
insert into canciones values ("C11","Andromeda","Anier");
insert into canciones values ("C12","Cruella de Vil","Don Patricio");
insert into canciones values ("C13","Oye","Fernandocosta");
insert into canciones values ("C14","Noches sin dormir","Natos y Waor");
insert into canciones values ("C15","Traductor","Tiago PZK");
commit;
