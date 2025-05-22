create database app01_amb

create table categorias(
    cat_id serial primary key,
    cat_nom varchar(50) not null unique
);


create table productos(
    pro_id serial primary key,
    pro_nombre varchar(100),
    pro_cantidad integer,
    pro_categoria integer,
    pro_prioridad integer,
    pro_comprado smallint default 0,
    pro_situacion char(1)
);

alter table productos add constraint (foreign key(pro_categoria)
references categorias(cat_id) constraint fk_pro_cat)

alter table productos add constraint unique (pro_nombre, pro_categoria);