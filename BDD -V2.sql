
drop database if exists cinema;

create database cinema character set = 'utf8';

use cinema;

create table if not exists film(
idFilm smallint not null auto_increment,
titre varchar(100) not null,
dateSortie date not null,
duree smallint not null,
description varchar(250),
primary key(idFilm)
) engine=innodb;

create table if not exists projection(
horaire datetime not null,
idFilm smallint not null, 
idSalle smallint not null,
idGenre smallint not null,
primary key(horaire,idFilm,idSalle),
key(idFilm),
key(idSalle),
key(idGenre)

) engine=innodb;


create table if not exists genre(
idGenre smallint not null auto_increment,
libelle varchar(50) not null,
tarifAdulte smallint not null,
tarifEnfant smallint not null,
tarifSenior smallint not null,
tarifEtudiant smallint not null,
primary key(idGenre)

) engine=innodb;


create table if not exists salle(
idSalle smallint not null auto_increment,
capacite smallint not null,
primary key(idSalle)

) engine=innodb;

create table if not exists siege(
idSalle smallint not null,
numsiege smallint not null,
occupe smallint not null default 0,
primary key(idSalle,numsiege),
key(numsiege)

) engine =innodb;

create table if not exists ticket(
idTicket smallint not null,
horaire datetime not null,
idFilm smallint not null, 
idSalle smallint not null,
numsiege smallint not null,
primary key(idTicket),
key(horaire),
key(idFilm),
key(idSalle),
key(numsiege)
) engine=innodb;





alter table projection add constraint fkprojFilm foreign key(idFilm) references film(idFilm);

alter table projection add constraint fkprojSalle foreign key(idSalle) references salle(idSalle);

alter table projection add constraint fkprojGenre foreign key(idGenre) references genre(idGenre);


alter table siege add constraint fksiegesalle foreign key(idSalle) references salle(idSalle);

alter table ticket add constraint fkticketprojection foreign key(horaire,idFilm,idSalle) references
projection(horaire,idFilm,idSalle);

alter table ticket add constraint fkticketsiege foreign key (numsiege) references siege(numsiege);




insert into film (titre,datesortie,duree, description) values 
("Harry Potter et la chambre des sorciers","2015-09-18",100,"un bon vieux Harry Potter pour remonter le moral"),
("Aladin","2000-12-14",64,"un classique disney pour petits et grands"),
("Hunger Games","2012-03-21",142,"Que la chance soit avec vous");

insert into genre(libelle,tarifAdulte,tarifEnfant,tarifEtudiant,tarifSenior) values
("Normal",9,7.5,8,7),
("3D",10.5,9,9.5,8.5),
("Atmos",11.5,10,10.5,9.5);

insert into salle(capacite) values
(3),
(4),
(5);

insert into projection(horaire,idFilm,idSalle,idGenre) values
("2020-04-26 18:00:00",1,1,1),
("2020-04-27 20:30:00",2,2,2),
("2020-04-28 10:00:00",1,3,3);


insert into siege(idSalle,numsiege) values
(1,1), (1,2) ,(1,3) , (2,1), (2,2) ,(2,3) , (2,4) , (3,1), (3,2) ,(3,3) , (3,4) ,(3,5);

insert into ticket(idTicket,horaire,idFilm,idSalle,numsiege) values 
(12345,"2020-04-27 20:30:00",2,2,1);

update siege set occupe=12345 where idsalle=2 and numsiege=1;

select capacite-(select count(*) from ticket where idsalle=2 and horaire="2020-04-27 20:30:00") as "nbTicketAvailable" from salle where idSalle=2;
