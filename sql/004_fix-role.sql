use `cinema`;

alter table `casting` drop foreign key `casting_ibfk_3`;

create table if not exists `film_role`(
    `id` serial,
    `name` varchar(64) not null,

    primary key(`id`)
);

alter table `casting` add constraint `casting_ibfk_3`
    foreign key(`role_id`) references `film_role`(`id`)
        on delete cascade
        on update cascade;
