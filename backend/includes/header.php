<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $title; ?></title>
    <style>
        body { background: #f8f9fa; }
        .header-section { 
            background: linear-gradient(135deg, #003366 0%, #0052cc 100%); 
            color: white; 
        }
        .header-section img { max-height: 200px; }
        .header-section h1 { font-size: 50px; margin-bottom: 4px; }
        .header-section small { font-size: 14px; opacity: 0.9; }
    </style>
</head>
<body>
    <!-- HEADER WITH LOGO -->
   <div class="header-section" style="background: white; color: #333;">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <img src="/photos/esake-logo.png" alt="ESAKE Logo">
            <div>
                <h1 style="color: #003366;">ESAKE Basketball Tracker 2.0</h1>
                <small style="color: #666;">Manage Championships, Teams & Players</small>
            </div>
        </div>
    </div>
</div>

    <!-- NAVIGATION -->
    <ul class="nav justify-content-center bg-light">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/teams.php">Teams</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/players.php">Players</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/pages/championships.php">Tournaments</a>
        </li>
    </ul>