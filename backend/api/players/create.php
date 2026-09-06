<?php
    require_once(__DIR__ . "/../../includes/db.php");

    // Proper input validation
    if (!isset($_POST['player_name']) || !isset($_POST['player_position']) || !isset($_POST['player_team'])) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">All fields are required.</p>
            <a href="../../pages/create_player.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    $player_name = $_POST['player_name'];
    $player_position = $_POST['player_position'];
    $player_team = (int)$_POST['player_team'];

    // Validate position against whitelist
    $allowed_positions = ['Point_Guard', 'Shooting_Guard', 'Small_Forward', 'Power_Forward', 'Center'];
    if (!in_array($player_position, $allowed_positions)) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Invalid position.</p>
            <a href="../../pages/create_player.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Proper file upload validation
    if (!isset($_FILES["player_photo"]) || $_FILES["player_photo"]["error"] != UPLOAD_ERR_OK) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Photo upload failed.</p>
            <a href="../../pages/create_player.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    $target_dir = BASE_PATH . "/photos/";
    $photo_name = basename($_FILES["player_photo"]["name"]);
    $target_file = $target_dir . $photo_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate file type
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.</p>
            <a href="../../pages/create_player.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Validate file size (max 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB
    if ($_FILES["player_photo"]["size"] > $max_size) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">File is too large. Maximum size is 5MB.</p>
            <a href="../../pages/create_player.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Generate unique filename to prevent overwrites
    $unique_name = time() . '_' . bin2hex(random_bytes(8)) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_name;

    if (!move_uploaded_file($_FILES["player_photo"]["tmp_name"], $target_file)) {
        http_response_code(500);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">File upload failed.</p>
            <a href="../../pages/create_player.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Use prepared statement instead of string concatenation
    // This prevents SQL injection attacks
    $stmt = mysqli_prepare($db_handler, "INSERT INTO players (Position, PhotoPath, Team_id, Name) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        http_response_code(500);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Database error.</p>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Bind parameters: "ssii" means string, string, integer, integer
    mysqli_stmt_bind_param($stmt, "ssii", $player_position, $unique_name, $player_team, $player_name);

    if (!mysqli_stmt_execute($stmt)) {
        http_response_code(500);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Error creating player.</p>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        mysqli_stmt_close($stmt);
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db_handler);

    header("Location:../../pages/players.php");
    exit();
?>