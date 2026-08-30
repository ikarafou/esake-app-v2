<?php
$title = "Create Player";

require_once(__DIR__ . "/../includes/db.php");
include(BASE_PATH . "/includes/header.php");

$query = "SELECT id, Name FROM teams";
$result = mysqli_query($db_handler, $query);

?>
<div class="container  mt-3  w-50">
        
    <form action="/api/players/create.php" method="POST" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="player_name" name="player_name" placeholder="Player Name" required>
            <label for="player_name">Player Name</label>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" id="player_position" name="player_position">
                <option selected>Player's Position</option>
                <option value="Point_Guard">Point Guard (PG)</option>
                <option value="Shooting_Guard">Shooting Guard (SG)</option>
                <option value="Small_Forward">Small Forward (SF)</option>
                <option value="Power_Forward">Power Forward (PF)</option>
                <option value="Center">Center (C)</option>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" id="player_team" name="player_team">
                <option selected>Player's Team</option>
<?php           while($row = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['Name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Player's Photo</label>
            <input class="form-control" type="file" id="player_photo" name="player_photo" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-3">Create</button>
        </div>
    </form>
</div>
<?php
include(BASE_PATH . "/includes/footer.php");
?>