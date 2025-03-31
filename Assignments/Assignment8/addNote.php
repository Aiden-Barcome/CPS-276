<?php
require_once 'classes/Date_time.php';
if (isset($_POST['Submit'])){
  $dt = new Date_time($_POST['dateTime']);
  $dt->checkSubmit();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <form method="POST" action="addNote.php">
      <h1>Add Note</h1>
      <a href="https://russet-v8.wccnet.edu/~abarcome/cps276/Assignments/Assignment8/displayNotes.php">Display Notes</a>
      <div>
        <label for="dateTime" class="form-label">Date and Time</label>
        <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
      </div>
      <div>
        <label for="Note" class="form-label">Note</label>
        <textarea class="form-control" name="Note" style="height: 300px"></textarea>
      </div>
        <input class="btn btn-primary" type="submit" value="Add Note" name="Submit">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>