drop database if exists mahjong_data;
create database mahjong_data default character set utf8 collate utf8_general_ci;
grant all on mahjong_data.* to 'staff'@'localhost' identified by 'password';
use mahjong_data;

create table user_information (
	id int auto_increment primary key, 
	name varchar(100) not null, 
	password varchar(100) not null
);

create table battle_management (
	id int auto_increment primary key, 
	play_date date not null,
    point_rate bigint not null,
    tip_rate bigint not null,
    people int not null,
    member1 int not null,
    member2 int not null,
    member3 int not null,
    member4 int,
	foreign key(member1) references user_information(id),
    foreign key(member2) references user_information(id),
    foreign key(member3) references user_information(id),
    foreign key(member4) references user_information(id)
);

create table battle_result (
	id int auto_increment primary key, 
    battle_management_id int not null,
    member1_score bigint not null,
    member2_score bigint not null,
    member3_score bigint not null,
    member4_score bigint ,
    foreign key(battle_management_id) references battle_management(id)
);


create table result_management (
	id int auto_increment primary key, 
    user_information_id int not null,
    battle_management_id int not null,
    score bigint not null,
    tip bigint not null,
    money bigint not null,
    ranking bigint,
    play_number int not null,
    foreign key(user_information_id) references user_information(id),
    foreign key(battle_management_id) references battle_management(id)
);