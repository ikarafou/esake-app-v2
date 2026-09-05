<?php
    require_once(__DIR__ . "/../../includes/db.php");

    // Proper input validation
    if (!isset($_POST['team_name']) || empty(trim($_POST['team_name'])) ||
     !isset($_POST['team_city']) || empty(trim($_POST['team_city'])) ) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">All fields are required.</p>
            <a href="../../pages/create_team.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    $team_name = $_POST['team_name'];
    $team_city = $_POST['team_city'];

    // Validate input length
    if (strlen($team_name) > 100 || strlen($team_city) > 50) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Input too long.</p>
            <a href="../../pages/create_team.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Proper file upload validation
    if (!isset($_FILES["team_logo"]) || $_FILES["team_logo"]["error"] != UPLOAD_ERR_OK) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Logo upload failed.</p>
            <a href="../../pages/create_team.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    $target_dir = BASE_PATH . "/photos/";
    $logo_name = basename($_FILES["team_logo"]["name"]);
    $target_file = $target_dir . $logo_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate file type
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    if (!in_array($imageFileType, $allowed_types)) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Invalid file type. Only JPG, JPEG, PNG, GIF, and SVG are allowed.</p>
            <a href="../../pages/create_team.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Validate file size (max 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB
    if ($_FILES["team_logo"]["size"] > $max_size) {
        http_response_code(400);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">File is too large. Maximum size is 5MB.</p>
            <a href="../../pages/create_team.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Generate unique filename to prevent overwrites and directory traversal
    $unique_name = time() . '_' . bin2hex(random_bytes(8)) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_name;

    if (!move_uploaded_file($_FILES["team_logo"]["tmp_name"], $target_file)) {
        http_response_code(500);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">File upload failed.</p>
            <a href="../../pages/create_team.php" class="btn btn-primary btn-sm">Return</a>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        exit();
    }

    // Use prepared statement instead of string concatenation
    // This prevents SQL injection attacks
    $stmt = mysqli_prepare($db_handler, "INSERT INTO teams (Name, City, LogoPath) VALUES (?, ?, ?)");

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

    // Bind parameters: "sss" means string, string, string
    mysqli_stmt_bind_param($stmt, "sss", $team_name, $team_city, $unique_name);

    if (!mysqli_stmt_execute($stmt)) {
        http_response_code(500);
        $title = "Error";
        include(BASE_PATH . "/includes/header.php");
        ?>
            <p class="alert alert-danger">Error creating team.</p>
        <?php
        include(BASE_PATH . "/includes/footer.php");
        mysqli_stmt_close($stmt);
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db_handler);

    header("Location:../../pages/teams.php");
    exit();
?>