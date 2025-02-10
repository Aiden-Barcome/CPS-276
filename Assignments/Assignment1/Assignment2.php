<?php
$array=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50);
foreach ($array as $x){
    if ($x%2===0){
        $evenNumbers=$evenNumbers.$x." - ";
    }
}
$evenNumbers=trim($evenNumbers, " - ");
$form=<<<END
<label for="email">Email address</label>
<input type="text" class="form-control" placeholder="name@example.com" id="email">
<br>
<label for="area">Example textarea</label>
<input class="form-control" id="area"></textarea>
END;
function tableFunction($rowNum, $colNum){
    for ($i=1;$i<=$rowNum;$i++){
        $table=$table."<tr>";
        for($j=1;$j<=$colNum;$j++){
            $table=$table."<td>Row $i, Col $j</td>";
        }
        $table=$table."</tr>";
    }
    return $table;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php echo $evenNumbers;
    echo $form
    echo tableFunction(8,6);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>