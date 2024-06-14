use `cinema`;

ALTER TABLE `rental`
    DROP FOREIGN KEY rental_ibfk_1,
    DROP FOREIGN KEY rental_ibfk_2,
    drop index `unique`,
    ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
    ADD FOREIGN KEY (`film_id`) REFERENCES `film`(`id`);

