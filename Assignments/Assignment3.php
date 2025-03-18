<?php

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Names</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <form action="Assignment3.php" method="post"> 
        <div row>
            <input class="btn btn-primary" type="button" value="Add Name">
            <input class="btn btn-primary" type="button" value="Clear Names">
        </div>
        <div row>
            <label for="Enter Name">Enter Name</label>
            <br>
            <input type="text" class="form-control" id="Enter Name">
        </div>
        <div row>
            <label for="List of Names">List of Names</label>
            <br>
            <textarea class="form-control" id="List of Names" rows="10"></textarea>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>