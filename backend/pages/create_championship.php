<?php
$title = "Create Championship";
require_once(__DIR__ . "/../includes/db.php");
include(BASE_PATH . "/includes/header.php");


$query = "SELECT id, Name FROM teams";
$result = mysqli_query($db_handler, $query);
$num_teams = mysqli_num_rows($result);

?>
<div class="container  mt-3  w-50">
        
    <form action="/api/championships/create.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="championship_name" name="championship_name" placeholder="Championship Name" required>
            <label for="championship_name">Championship Name</label>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" id="championship_num_teams" name="championship_num_teams">
                <option>Number of teams</option>
<?php         
                $num = 2;
                while($num <= $num_teams){ ?>
                    <option value="<?php echo $num ?>"><?php echo $num ?></option>
                <?php 
                    $num+= 2;
                } ?>
            </select>
        <div class="mt-3">
<?php           
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="<?php echo $row['id'] ?>" id="team_<?php echo $i ?>" name="teams[]">
                        <label class="form-check-label" for="team_<?php echo $i ?>">
                            <?php echo $row['Name'] ?>
                        </label>
                    </div>
                <?php } ?>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-3">Create</button>
        </div>
    </form>
</div>
<?php
include(BASE_PATH . "/includes/footer.php");
?>