CREATE TABLE users(
id              int(11) auto_increment primary key,
name            varchar(100) not null,
surname         varchar(100) not null,
email           varchar(100) UNIQUE not null,
password        varchar(255) not null,
day             varchar(10) not null,
mes             varchar(50) not null,
anio            varchar(50) not null,
sexo            varchar(20) not null,
message         text not null
)ENGINE=InnoDb;