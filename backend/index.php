<?php
require_once(__DIR__ . "/includes/db.php");
$title = "ESAKE App - Home";
require_once(BASE_PATH . "/includes/header.php");

$championshipsCount = 0;
$teamsCount = 0;
$playersCount = 0;

if ($result = mysqli_query($db_handler, "SELECT COUNT(*) AS c FROM championships")) {
    $championshipsCount = mysqli_fetch_assoc($result)['c'];
}
if ($result = mysqli_query($db_handler, "SELECT COUNT(*) AS c FROM teams")) {
    $teamsCount = mysqli_fetch_assoc($result)['c'];
}
if ($result = mysqli_query($db_handler, "SELECT COUNT(*) AS c FROM players")) {
    $playersCount = mysqli_fetch_assoc($result)['c'];
}
?>
<div class="container mt-4">
    <div class="p-4 mb-4 bg-light rounded-3">
        <h1>ESAKE App 2.0</h1>
        <p class="lead">Καλωσόρισες. Το backend τρέχει μέσα σε Docker και μιλάει κανονικά με τη βάση.</p>
    </div>

    <div class="row text-center mb-4">
        <div class="col">
            <div class="card p-3">
                <h2><?php echo $championshipsCount; ?></h2>
                <p class="mb-0">Championships</p>
            </div>
        </div>
        <div class="col">
            <div class="card p-3">
                <h2><?php echo $teamsCount; ?></h2>
                <p class="mb-0">Teams</p>
            </div>
        </div>
        <div class="col">
            <div class="card p-3">
                <h2><?php echo $playersCount; ?></h2>
                <p class="mb-0">Players</p>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="/pages/championships.php" class="btn btn-primary">Δες τα Championships</a>
        <a href="/pages/create_team.php" class="btn btn-outline-primary">Πρόσθεσε Team</a>
        <a href="/pages/create_player.php" class="btn btn-outline-primary">Πρόσθεσε Player</a>
        <a href="/pages/create_championship.php" class="btn btn-outline-primary">Πρόσθεσε Championship</a>
    </div>
</div>

<?php
mysqli_close($db_handler);
require_once(BASE_PATH . "/includes/footer.php");
?>