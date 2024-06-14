use `cinema`;

alter table `user`
add column `failed_logins` tinyint unsigned default 0;

