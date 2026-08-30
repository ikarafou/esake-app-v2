<?php
require_once(__DIR__ . "/../includes/db.php");
$title = "Teams";
include(BASE_PATH . "/includes/header.php");

$query = "SELECT * FROM championships";
$result = mysqli_query($db_handler, $query);

?>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Team Quantity</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
                <th scope="col" class=" justify-content-right"><a href="./create_championship.php" class="btn btn-primary btn-sm">Add Championship</a></th>
            </tr>
        </thead>
        <tbody>
<?php
            while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['Name'] ?></td>
                    <td><?php echo $row['TeamQuantity'] ?></td>
                    <td><a href="./championship_api/api_draw_games.php?championship_id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Matchmaking</a></td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            <?php }
?>
        </tbody>
    </table>
</div>

<?php
include(BASE_PATH . "/includes/footer.php");
?>