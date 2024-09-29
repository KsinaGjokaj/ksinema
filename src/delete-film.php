<?php
require("./lib/auth-admin-action.php");

if ($allow) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Delete rows from `rental` table that reference the `film` record
        $delete_rental_query = "DELETE FROM `rental` WHERE `film_id` = " . $id . ";";
        mysqli_query($conn, $delete_rental_query);

        // Delete the `film` record
        $delete_film_query = "DELETE FROM `film` WHERE `id` = " . $id . ";";
        mysqli_query($conn, $delete_film_query);

        // Commit the transaction
        mysqli_commit($conn);
?>
        <p>Film and related rentals deleted</p>
    <?php
    } catch (mysqli_sql_exception $exception) {
        // Rollback the transaction if something went wrong
        mysqli_rollback($conn);
    ?>
        <h2>Database error, cannot delete!</h2>
<?php
    }
}
?>

<a class="btn btn-primary" href="./admin-dashboard.php">Go back</a>
</body>

</html>