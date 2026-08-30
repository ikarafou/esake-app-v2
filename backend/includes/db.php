<?php

// BASE_PATH = backend/ (the project root), computed once, safely.
// __DIR__ here is ALWAYS "backend/includes" -- fixed, because this is
// db.php's own location, regardless of who includes it or how (web or CLI).
// dirname() goes one level up: backend/includes -> backend
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

define("QUAD_HOSTNAME", "db");
define("QUAD_DATABASE", "esake");
define("QUAD_USERNAME", "esake_user");
define("QUAD_PASSWORD", "password");

// Remote - TopHost
/*
define("QUAD_HOSTNAME", "localhost:3306");
define("QUAD_DATABASE", "anything_ct");
define("QUAD_USERNAME", "atg_username");
define("QUAD_PASSWORD", "atg_password");
*/
$db_handler = mysqli_connect(QUAD_HOSTNAME, QUAD_USERNAME, QUAD_PASSWORD); 
mysqli_select_db($db_handler, QUAD_DATABASE);
$error = mysqli_error($db_handler);
if (!empty($error)) {
    echo "Fuck";
}

?>