use `cinema`;

insert into `role`(`name`) values("admin");
insert into `role`(`name`) values("user");

insert into `user`(`email`, `first_name`, `last_name`, `password`, `role_id`)
values("admin@ksinema.com", "admin", "admin", "password", 1);

