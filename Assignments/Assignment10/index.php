<?php
    $output = "";
    $acknowledgement = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'php/rest_client.php';
        $result = getWeather();
        $acknowledgement = $result[0];
        $output = $result[1];

    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <form method="post" action="index.php">
        <div class="row">
            <h1>Enter Zip Code to Get City Weather</h1>
        </div>
        <div class="row">
            <div class="col-3">
                <label for="zip-code">Zip Code:</label>
                <input class="form-control" type="text" name="zip_code" id="zip_code">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>