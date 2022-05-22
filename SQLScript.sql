create table users
(
    username varchar(255) not null
        constraint users_pk
            primary key,
    password varchar(255),
    email    char(255)
);

alter table users
    owner to postgres;

create table user_info
(
    username char(255),
    peso     integer default 0,
    data     date,
    altezza  integer default 0
);

comment on table user_info is 'Qui ci saranno le informazioni sul peso, sui passi e sulle calorie bruciate e assunte
';

alter table user_info
    owner to postgres;

create table user_activity
(
    username         char(255),
    activity         char(255),
    calorie_bruciate integer default 0,
    durata_minuti    integer,
    data             char(255),
    passi            integer default 0
);

alter table user_activity
    owner to postgres;

create table user_alimenti
(
    username        char(255),
    alimento        char(255),
    calorie_assunte integer default 0,
    data            date,
    ora             time
);

alter table user_alimenti
    owner to postgres;

