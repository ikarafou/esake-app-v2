<?php
require_once(__DIR__ . "/../includes/db.php");
$title = "Teams";
include(BASE_PATH . "/includes/header.php");

$query = "SELECT * FROM teams";
$result = mysqli_query($db_handler, $query);

?>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Name</th>
                <th scope="col">City</th>
                <th scope="col">&nbsp;</th>
                <th scope="col" class=" justify-content-right"><a href="/pages/create_team.php" class="btn btn-primary btn-sm">Add Team</a></th>
            </tr>
        </thead>
        <tbody>
<?php
            while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><img src="/photos/<?php echo $row['LogoPath'] ?>" width="50" alt="Logo of the team"></td>
                    <td><?php echo $row['Name'] ?></td>
                    <td><?php echo $row['City'] ?></td>
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