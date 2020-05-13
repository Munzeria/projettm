
drop database if exists cinema;

create database cinema character set = 'utf8';

use cinema;

create table if not exists film(
idFilm smallint UNSIGNED  not null auto_increment,
titre varchar(100) not null,
dateSortie date not null,
duree smallint UNSIGNED  not null,
description varchar(250),
primary key(idFilm)
) engine=innodb;

create table if not exists projection(
horaire datetime not null,
idFilm smallint UNSIGNED  not null, 
idSalle smallint UNSIGNED  not null,
idGenre smallint UNSIGNED  not null,
primary key(horaire,idSalle),
key(idFilm),
key(idSalle),
key(idGenre)

) engine=innodb;


create table if not exists genre(
idGenre smallint UNSIGNED  not null auto_increment,
libelle varchar(50) not null,
tarifAdulte smallint UNSIGNED  not null,
tarifEnfant smallint UNSIGNED  not null,
tarifSenior smallint UNSIGNED  not null,
tarifEtudiant smallint UNSIGNED  not null,
primary key(idGenre)

) engine=innodb;


create table if not exists salle(
idSalle smallint UNSIGNED  not null auto_increment,
capacite smallint UNSIGNED  not null,
primary key(idSalle)

) engine=innodb;

create table if not exists ticket(
idTicket mediumint UNSIGNED not null auto_increment,
horaire datetime not null,
idSalle smallint UNSIGNED not null,
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
argent smallint UNSIGNED not null default 0,
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

alter table ticket add constraint fkticketprojection foreign key(horaire,idSalle) references projection(horaire,idSalle);

alter table ticket add constraint fkticketuserInformation foreign key (username) references userInformation(username);

insert into administrateur(username,password) values ("admin","77e467eb0169e82e77f090df217a323357c6a157a98c0375e6f6dbafe029c83a");