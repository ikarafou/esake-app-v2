<?php
    require_once(__DIR__ . "/../../includes/db.php");

    header("Content-Type: application/json");

    $team_id = isset($_GET['team_id']) ? (int)$_GET['team_id'] : null;
    if (!$team_id || $team_id <= 0) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Invalid team ID',
            'message' => 'team_id parameter must be a positive integer'
        ]);
        mysqli_close($db_handler);
        exit();
    }

    $query = "SELECT * FROM players WHERE Team_id = ? ";
    $stmt = mysqli_prepare($db_handler, $query);
 
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database error',
            'message' => 'Failed to prepare statement'
        ]);
        mysqli_close($db_handler);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $team_id);
 
    if (!mysqli_stmt_execute($stmt)) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database error',
            'message' => 'Failed to execute query'
        ]);
        mysqli_stmt_close($stmt);
        mysqli_close($db_handler);
        exit();
    }
 
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database error',
            'message' => 'Failed to get results'
        ]);
        mysqli_stmt_close($stmt);
        mysqli_close($db_handler);
        exit();
    }

    //  BUILD RESPONSE
    
    $players = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Use player ID as key for easy access
        $players[$row['id']] = [
            'id' => (int)$row['id'],
            'name' => $row['Name'],
            'position' => $row['Position'],
            'photo' => $row['PhotoPath'],
            'team_id' => (int)$row['Team_id']
        ];
    }
    
    // ============================================
    // RETURN RESPONSE
    // ============================================
    
    if (empty($players)) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'No players found for this team',
            'data' => []
        ]);
    } else {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'count' => count($players),
            'data' => $players
        ]);
    }
    
    // ============================================
    // CLEANUP
    // ============================================
    
    mysqli_stmt_close($stmt);
    mysqli_close($db_handler);
    exit();
?>