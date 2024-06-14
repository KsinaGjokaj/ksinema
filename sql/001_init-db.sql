-- setup db
create database if not exists `cinema`
       default character set utf8mb4;
use `cinema`;

-- tables
create table if not exists `role` (
       `id` serial,
       `name` varchar(16) unique not null,

       primary key(`id`)
);

create table if not exists `user` (
       `id` serial,
       `email` varchar(128) unique not null,
       `first_name` varchar(32) not null,
       `last_name` varchar(32) not null,
       `role_id` bigint unsigned not null,
       `password` varchar(128) not null,

       primary key(`id`),
       foreign key(`role_id`) references `role`(`id`)
               on delete cascade
               on update cascade
);

create table if not exists `genre` (
       `id` serial,
       `name` varchar(16) unique not null,
       `description` varchar(64),

       primary key(`id`)
);

create table if not exists `film` (
       `id` serial,
       `title` varchar(32) not null,
       `production` date,
       `duration` smallint unsigned not null,
       `genre_id` bigint unsigned,        -- null means undefined/not set
       `price` smallint unsigned not null,
       -- `quantity` smallint unsigned not null,
       `trailer` varchar(128),
       `poster` blob,

       constraint `price_valid` check (`price` > 1),
       primary key(`id`),
       foreign key(`genre_id`) references `genre`(`id`)
               on delete set null
               on update cascade
);

create table if not exists `rental` (
       `id` serial,
       `film_id` bigint unsigned not null,
       `user_id` bigint unsigned not null,
       `start_date` date not null,
       `end_date` date not null,

       constraint `valid_dates` check (`start_date` < `end_date`),
       primary key(`id`),
       unique key `unique`(`film_id`, `user_id`),
       foreign key(`film_id`) references `film`(`id`)
               on delete cascade
               on update cascade,
       foreign key(`user_id`) references `user`(`id`)
               on delete cascade
               on update cascade
);

create table if not exists `purchase` (
       `id` serial,
       `film_id` bigint unsigned not null,
       `user_id` bigint unsigned not null,
       `purchase_date` date not null,

       primary key(`id`),
       unique key `unique`(`film_id`, `user_id`),
       foreign key(`film_id`) references `film`(`id`)
               on delete cascade
               on update cascade,
       foreign key(`user_id`) references `user`(`id`)
               on delete cascade
               on update cascade
);

create table if not exists `person` (
       `id` serial,
       `name` varchar(64) not null,

       primary key(`id`)
);

create table if not exists `role` (
       `id` serial,
       `name` varchar(16) not null unique,

       primary key(`id`)
);

create table if not exists `casting` (
       `film_id` bigint unsigned not null,
       `person_id` bigint unsigned not null,
       `role_id` bigint unsigned not null,

       primary key(`film_id`, `person_id`, `role_id`),
	   foreign key(`film_id`) references `film`(`id`)
               on delete cascade
               on update cascade,
       foreign key(`person_id`) references `person`(`id`)
               on delete cascade
               on update cascade,
	   foreign key(`role_id`) references `role`(`id`)
               on delete cascade
               on update cascade
       
);
