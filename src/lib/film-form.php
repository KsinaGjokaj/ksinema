<?php
require_once("connect.php");
?>
<form id="role-form" class="cataloge" method="post" action="./process-add-film.php" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <h2 class="h-form">Add/Edit film</h2>
            <div class="col-sm">
                <input type="hidden" id="exists" name="exists" value=<?php echo "\"$exists\"" ?>>
                <?php
                if ($exists) {
                ?>
                    <input type="hidden" id="id" name="id" value=<?php echo "\"$id\"" ?>>
                <?php
                }
                ?>
                <div>
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value=<?php echo "\"$title\"" ?> required>
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="production">Production</label>
                    <input type="date" id="production" name="production" class="form-control" value=<?php echo "\"$production\"" ?> required>
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="duration">Duration</label>
                    <input type="number" id="duration" name="duration" class="form-control" value=<?php echo "\"$duration\"" ?> min="1" required>
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="genre">Genre</label>
                    <select id="genre" name="genre" class="genre-select">
                        <?php
                        $query = "select * from `genre`;";
                        $res = mysqli_query($conn, $query);
                        if ($res) {
                            while ($arr = mysqli_fetch_assoc($res)) {
                                $id = $arr["id"];
                                $selected = "";
                                if ($genre == $id) {
                                    $selected = " selected";
                                }

                                printf("<option value=\"%s\"%s>%s</option>", $id, $selected, $arr["name"]);
                            }
                        } else {
                            // TODO no genre in db
                            echo "Error! No genre in db";
                        }
                        ?>
                    </select>
                    <span class="error_form"></span>
                </div>
            </div>
            <div class="col-sm">
                <div>
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control" value=<?php echo "\"$price\"" ?> min="1" required>
                    <span class="error_form"></span>
                </div>
                <div>
                    <label for="traile">Trailer</label>
                    <input type="text" id="trialer" name="trailer" class="form-control" value=<?php echo "\"$trailer\"" ?> required>
                    <span class="error_form"></span>
                </div>
                <?php
                if (!$exists) {
                ?>
                    <div>
                        <label for="poster">Poster</label>
                        <input type="file" id="poster" name="poster" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                        <span class="error_form"></span>
                    </div>
                    <div>
                        <label for="video">Video</label>
                        <input type="file" id="video" name="video" class="form-control" accept="video/mp4" required>
                        <span class="error_form"></span>
                    </div>
                <?php
                }
                ?>
                <div class="film-submit">
                    <input type="submit" value="submit" class="form-control btn-sec">
                </div>
            </div>
        </div>
    </div>
</form>