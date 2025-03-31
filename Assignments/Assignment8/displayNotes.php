<?php
require_once 'classes/noteGetter.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <form method="POST" action="displayNotes.php">
        <h1>Display Notes</h1>
        <a href="https://russet-v8.wccnet.edu/~abarcome/cps276/Assignments/Assignment8/addNote.php">Add Note</a>
        <br>
        <label for="begDate" class="form-label">Beginning Date</label>
        <input type="date" class="form-control" id="begDate" name="begDate">
        <label for="endDate" class="form-label">Ending Date</label>
        <input type="date" class="form-control" id="endDate" name="endDate">
        <input class="btn btn-primary" type="submit" value="Get Notes" name="getNotes">
        <br>
        <?php
        if (isset($_POST['getNotes'])){
            $noteGetter=new NoteGetter($_POST['begDate'],$_POST['endDate']);
            $noteGetter->getNotes();
        }
        ?>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>