create table product(
	id int not null auto_increment,
    name varchar(128) not null,
    size int not null default 0,
    is_available boolean not null default false,
    primary key (id)
);