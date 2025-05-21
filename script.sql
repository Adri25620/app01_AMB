create database app01_amb

create table categorias(
    cat_id serial primary key,
    cat_nom varchar(50) not null unique
);

insert into categorias(cat_nom) values('Alimentos');
GO
insert into categorias(cat_nom) values('Higiene');
GO
insert into categorias(cat_nom) values('Hogar');



create table prioridades(
    pri_id serial primary key,
    pri_desc varchar(50) not null unique
);

insert into prioridades(pri_desc) values('Alta');
GO
insert into prioridades(pri_desc) values('Media');
GO
insert into prioridades(pri_desc) values('Baja');



create table productos(
    pro_id serial primary key,
    pro_nombre varchar(100),
    pro_cantidad integer,
    pro_categoria integer,
    pro_prioridad integer,
    pro_comprado smallint default 0
);

alter table productos add constraint (foreign key(pro_categoria)
references categorias(cat_id) constraint fk_pro_cat)

alter table productos add constraint (foreign key(pro_prioridad)
references prioridades(pri_id) constraint fk_pro_pri)

alter table productos add constraint unique (pro_nombre, pro_categoria);