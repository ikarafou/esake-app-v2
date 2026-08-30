<?php
$title = "Create Team";
require_once(__DIR__ . "/../includes/db.php");
include(BASE_PATH . "/includes/header.php");


?>
<div class="container  mt-3  w-50">
        
    <form action="/api/teams/create.php" method="POST" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="team_name" name="team_name" placeholder="Team Name" required>
            <label for="team_name">Team Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="team_city" name="team_city" placeholder="Team City" required> 
            <label for="team_city">Team City</label>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Team Logo</label>
            <input class="form-control" type="file" id="team_logo" name="team_logo" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mb-3">Create</button>
        </div>
    </form>
</div>
<?php
include(BASE_PATH . "/includes/footer.php");
?>