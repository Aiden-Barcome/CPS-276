<?php
require_once dirname(__FILE__) . "russet-v8.wccnet.edu/~abarcome/cps276/Assignments/Assignment5/classes/Directories.php";
$errorMessage="";
$successLink="";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <form action="Directories.php" method="post">
      <h1>File and Directory Assignment</h1>
      <br>
      <h6>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</h6>
      <br>
      <div>
        <?php echo htmlspecialchars($successLink); ?>
      </div>
      <div>
        <?php echo $errorMessage; ?>
      </div>
      <div class="mb-3">
        <label for="folderName" class="form-label">Folder name:</label>
        <input type="text" class="form-control" id="folderName">
      </div>
      <div class="mb-3">
        <label for="fileContent" class="form-label">File content:</label>
        <textarea class="form-control" id="fileContent" rows="3"></textarea>
      </div>
      <div>
        <input class="btn btn-primary" type="submit" value="Submit" id="SubmitButton">
      </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>