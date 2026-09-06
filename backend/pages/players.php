<?php
require_once(__DIR__ . "/../includes/db.php");
$title = "Players";
include(BASE_PATH . "/includes/header.php");

$query = "SELECT players.id, players.Name as PlayerName, players.Position, players.PhotoPath, teams.Name as TeamName
FROM players 
join teams on players.Team_id = teams.id;";
$result = mysqli_query($db_handler, $query);

$position_labels = [
    'PG' => 'Point Guard (PG)',
    'SG' => 'Shooting Guard (SG)',
    'SF' => 'Small Forward (SF)',
    'PF' => 'Power Forward (PF)',
    'C'  => 'Center (C)'
];

?>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Name</th>
                <th scope="col">Team</th>
                <th scope="col">Position</th>
                <th scope="col">&nbsp;</th>
                <th scope="col" class=" justify-content-right"><a href="./create_player.php" class="btn btn-primary btn-sm">Add Player</a></th>
            </tr>
        </thead>
        <tbody>
<?php
            while($row = mysqli_fetch_assoc($result)){ 
                 // Use mapping to display full position name
                $position_display = $position_labels[$row['Position']] ?? $row['Position'];
                ?>
                <tr>
                    <td><img src="/photos/<?php echo $row['PhotoPath'] ?>" alt="Photo of the player"  width="50"></td>
                    <td><?php echo $row['PlayerName'] ?></td>
                    <td><?php echo $row['TeamName'] ?></td>
                    <td><?php echo $position_display ?></td>
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