<?php
require_once(__DIR__ . "/../../includes/db.php");

// $query = "SELECT * FROM Games WHERE Championship_id = $championship_id AND GameFinished = false";

$query = "SELECT * FROM teams";

$result = mysqli_query($db_handler, $query);

$games = array();
while($row = mysqli_fetch_assoc($result)){
    $games[$row['id']] = $row;
}

header("Content-Type: application/json");
echo json_encode($games);
mysqli_close($db_handler);

?>