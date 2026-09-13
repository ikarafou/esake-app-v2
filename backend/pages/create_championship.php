<?php
$title = "Create Championship";
require_once(__DIR__ . "/../includes/db.php");
include(BASE_PATH . "/includes/header.php");

$query = "SELECT id, Name FROM teams";
$result = mysqli_query($db_handler, $query);
$num_teams = mysqli_num_rows($result);

?>
<div class="container mt-3 w-50">
        
    <form action="/api/championships/create.php" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="championship_name" name="championship_name" 
                   placeholder="e.g., Greek Basket League 2024-2025" required>
            <label for="championship_name">Championship Name</label>
        </div>

        <div class="mb-3">
            <label for="championship_num_teams" class="form-label">Number of Teams</label>
            <select class="form-select" id="championship_num_teams" name="championship_num_teams" required>
                <option value="">-- Select Number of Teams --</option>
<?php         
                $num = 2;
                while($num <= $num_teams){ ?>
                    <option value="<?php echo $num ?>"><?php echo $num ?></option>
                <?php 
                    $num+= 2;
                } ?>
            </select>
        </div>

        <div class="mt-4">
            <h5>Select Teams:</h5>
            <div class="border p-3 rounded">
<?php           
                $i = 0;
                mysqli_data_seek($result, 0);
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php echo $row['id'] ?>" 
                               id="team_<?php echo $i ?>" name="teams[]">
                        <label class="form-check-label" for="team_<?php echo $i ?>">
                            <?php echo htmlspecialchars($row['Name']) ?>
                        </label>
                    </div>
                <?php $i++; } ?>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Create Championship</button>
        </div>
    </form>
</div>

<?php
include(BASE_PATH . "/includes/footer.php");
?>