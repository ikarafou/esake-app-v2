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

<div class="container mt-5">
    <!-- STATS SECTION -->
    <div class="row mb-5">
        <h1>Dashboard</h1>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h2 class="text-primary"><?php echo $championshipsCount; ?></h2>
                    <p class="text-muted mb-0">ΠΡΩΤΑΘΛΗΜΑΤΑ</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h2 class="text-primary"><?php echo $teamsCount; ?></h2>
                    <p class="text-muted mb-0">ΟΜΑΔΕΣ</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h2 class="text-primary"><?php echo $playersCount; ?></h2>
                    <p class="text-muted mb-0">ΠΑΙΧΤΕΣ</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="text-center mb-5">
        <h3 class="mb-4">Δημιουργία</h3>
        <div class="d-flex gap-2 flex-wrap justify-content-center">
            <a href="/pages/create_championship.php" class="btn btn-success btn-lg">Νέο Πρωτάθλημα</a>
            <a href="/pages/create_team.php" class="btn btn-success btn-lg">Νέα Ομάδα</a>
            <a href="/pages/create_player.php" class="btn btn-success btn-lg">Νέος Παίχτης</a>
        </div>
    </div>
</div>

<?php
mysqli_close($db_handler);
require_once(BASE_PATH . "/includes/footer.php");
?>