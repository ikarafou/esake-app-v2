<?php
require_once(__DIR__ . "/../includes/db.php");
$title = "Championships";
include(BASE_PATH . "/includes/header.php");

$query = "SELECT * FROM championships";
$result = mysqli_query($db_handler, $query);

?>
<div class="container">
    <h2 class="mb-4">ΠΡΩΤΑΘΛΗΜΑΤΑ / ΤΟΥΡΝΟΥΑ</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Championship Name</th>
                <th scope="col">Teams</th>
                <th scope="col" colspan="3" class="text-center">Actions</th>
                <th scope="col" class="text-end"><a href="./create_championship.php" class="btn btn-primary btn-sm">Add Championship</a></th>
            </tr>
        </thead>
        <tbody>
<?php
            while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row['Name']) ?></strong></td>
                    <td><?php echo $row['TeamQuantity'] ?></td>
                    <td><a href="/api/championships/draw_games.php?championship_id=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Draw Games</a></td>
                    <td><a href="#" class="btn btn-warning btn-sm disabled">Edit</a></td>
                    <td><a href="#" class="btn btn-danger btn-sm disabled">Delete</a></td>
                </tr>
            <?php }
?>
        </tbody>
    </table>
</div>

<?php
include(BASE_PATH . "/includes/footer.php");
?>