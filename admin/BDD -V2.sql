
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
primary key(horaire,idSalle),
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
idSalle smallint not null,
capacite smallint not null,
primary key(idSalle)

) engine=innodb;

create table if not exists ticket(
idTicket smallint not null,
horaire datetime not null,
idSalle smallint not null,
username varchar(50) not null,
tarif varchar(13) not null,
primary key(idTicket),
key(horaire),
key(idSalle),
key(username)
) engine=innodb;

create table if not exists administrateur(
username varchar(50) not null,
password varchar(100) not null,
primary key(username)

) engine=innodb;

create table if not exists userInformation(
username varchar(50) not null,
password varchar(100) not null,
nom varchar(150),
prenom varchar(150),
addresse varchar(150),
cp varchar(6),
ville varchar(100),
tel varchar(15),
argent smallint not null default 0,
primary key(username)
)engine=innodb;

delimiter | 

create trigger before_delete_ticket before delete on ticket for each row
begin 
    if now()<old.horaire then
		if old.tarif = "tarifEtudiant" then
			select tarifEtudiant into @ticket_price from genre inner join projection on old.horaire = projection.horaire and old.idSalle=projection.idSalle  where genre.idGenre = projection.idGenre;
		elseif old.tarif = "tarifEnfant" then
			select tarifEnfant into @ticket_price from genre inner join projection on old.horaire = projection.horaire and old.idSalle=projection.idSalle  where genre.idGenre = projection.idGenre;
		elseif old.tarif = "tarifAdulte" then
			select tarifAdulte into @ticket_price from genre inner join projection on old.horaire = projection.horaire and old.idSalle=projection.idSalle  where genre.idGenre = projection.idGenre;
		elseif old.tarif = "tarifSenior" then
			select tarifSenior into @ticket_price from genre inner join projection on old.horaire = projection.horaire and old.idSalle=projection.idSalle  where genre.idGenre = projection.idGenre;
		end if;
        update userInformation set argent = argent + @ticket_price where username = old.username;
    end if;
end | 

--used to replace delete on cascade cause they doesn't trigger
create trigger before_delete_film before delete on film for each row
begin
	delete from projection where projection.idFilm = old.idFilm;
end |

create trigger before_delete_salle before delete on salle for each row
begin
	delete from projection where projection.idSalle = old.idSalle;
end |

create trigger before_delete_genre before delete on genre for each row
begin
	delete from projection where projection.idGenre = old.idGenre;
end |

create trigger before_delete_projection before delete on projection for each row
begin
	delete from ticket where ticket.idSalle = old.idSalle and ticket.horaire = old.horaire;
end |

delimiter ;


alter table projection add constraint fkprojFilm foreign key(idFilm) references film(idFilm);

alter table projection add constraint fkprojSalle foreign key(idSalle) references salle(idSalle);

alter table projection add constraint fkprojGenre foreign key(idGenre) references genre(idGenre);

alter table ticket add constraint fkticketprojection foreign key(horaire,idSalle) references projection(horaire,idSalle) on delete cascade;

alter table ticket add constraint fkticketuserInformation foreign key (username) references userInformation(username);


insert into film (titre,datesortie,duree, description) values 
("Harry Potter et la chambre des sorciers","2015-09-18",100,"un bon vieux Harry Potter pour remonter le moral"),
("Aladin","2000-12-14",64,"un classique disney pour petits et grands"),
("Hunger Games","2012-03-21",142,"Que la chance soit avec vous");

insert into genre(libelle,tarifAdulte,tarifEnfant,tarifEtudiant,tarifSenior) values
("Normal",9,7.5,8,7),
("3D",10.5,9,9.5,8.5),
("Atmos",11.5,10,10.5,9.5);

insert into salle(idSalle,capacite) values
(1,75),
(2,82),
(3,92);

insert into projection(horaire,idFilm,idSalle,idGenre) values
("2020-04-26 18:00:00",1,1,1),
("2020-06-27 20:30:00",2,2,2),
("2020-04-28 10:00:00",1,3,3);


insert into userInformation(username,password,nom,prenom,addresse,cp,ville,tel) values ("username","password","nom","prenom","adresse","cp","ville","tel");

insert into ticket(idTicket,horaire,idSalle,username,tarif) values 
(12345,"2020-06-27 20:30:00",2,"username","tarifEtudiant");
