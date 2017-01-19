create database keplerone;
use keplerone;

create table product(
	id int not null auto_increment primary key,
	code varchar(255),
	name varchar(255),
	description text,
	price float,
	created_at datetime
);

create table operation(
	id int not null auto_increment primary key,
	q float,
	product_id int,/*1. in, 2. out*/
	kind int,/*1. in, 2. out*/
	created_at datetime,
	foreign key (product_id) references product(id)
);


