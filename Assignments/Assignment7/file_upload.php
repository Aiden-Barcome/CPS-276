<?php
require_once "fileUploadProc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="fileUploadProc.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fileName">File Name</label>
            <input class="form-control" type="text" id="fileName" name="fileName">
        </div>
        <div class="mb-3">
            <label for="fileUpload">File Upload</label>
            <input class="form-control" type="file" id="fileUpload" name="fileUpload">
        </div>
        <div class="mb-3">
            <input type="submit" value="Submit" class="btn btn-primary" id="submit" name="submit">
        </div>
    </form>
    <a href="https://russet-v8.wccnet.edu/~abarcome/cps276/Assignments/Assignment7/list_files.php">Show File List</a>
    <?php 
    if(!empty($errorMessage)){
        echo "<div class='alert alert-danger'>$errorMessage</div>";
    }
    if(!empty($uploadStatus)){
        echo "<div class='alert alert-success'>$uploadStatus</div>";
    }
    ?>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>