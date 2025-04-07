<?php
    require_once 'classes/Validation.php';
    require_once 'classes/Db_conn.php';
    require_once 'classes/Pdo_methods.php';

    $passConfirmErrorMsg="";
    $validator=new Validation;
    $duplicateEmailErrorMsg="";
    $errors=[];

    if (isset($_POST['firstName'])&&isset($_POST['lastName'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirmPassword'])){
        $validator->checkFormat($_POST['firstName'],'firstName',"This is an invalid name.");
        $validator->checkFormat($_POST['lastName'],'lastName',"This is an invalid name.");
        $validator->checkFormat($_POST['email'],'email',"This is an invalid email address.");
        $validator->checkFormat($_POST['password'],'password',"Password must have at least 8 characters, 1 uppercase letter, 1 number, and 1 symbol.");
        if ($_POST['password']!=$_POST['confirmPassword']){
            $passConfirmErrorMsg="This doesn't match the password you entered.";
        }
        if ($validator->hasErrors()===true){
            $errors=$validator->getErrors();
        }
        
        $dbConn=new Db_conn();
        $dbConn->dbOpen();
        $pdoMethods=new PdoMethods();
        $sql="SELECT * FROM Assignment9";
        $stmt=$dbConn->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            if ($_POST['email']===$row['email']){
                $duplicateEmailErrorMsg="This email has already been used.";
            }
        }

        if (empty($errors)&&empty($duplicateEmailErrorMsg)){
            $sql="INSERT INTO Assignment9 (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)";
            $stmt=$dbConn->conn->prepare($sql);
            $stmt->bindParam(':firstName', $_POST['firstName']);
            $stmt->bindParam(':lastName',$_POST['lastName']);
            $stmt->bindParam(':email',$_POST['email']);
            $stmt->bindParam(':password',$_POST['password']);
            $stmt->execute();

            echo "<table class=" . "table" . ">
                    <tr>
                        <th scope=" . "col" . ">First Name</th>
                        <th scope=" . "col" . ">Last Name</th>
                        <th scope=" . "col" . ">Email</th>
                        <th scope=" . "col" . ">Password</th>
                    </tr>";
            $dbConn=new Db_conn();
            $dbConn->dbOpen();
            $pdoMethods=new PdoMethods();
            $sql="SELECT * FROM Assignment9";
            $stmt=$dbConn->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                echo "<tr>
                    <td>" . $row["firstName"] . "</td>
                    <td>" . $row["lastName"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["password"] . "</td>
                </tr>";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <form action="Index.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" name="firstName">
                    <?php
                        echo $errors['firstName'] ?? '';
                    ?>
                </div>
                <div class="col-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lastName">
                    <?php
                        echo $errors['lastName'] ?? '';
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email">
                    <?php
                        echo $errors['email'] ?? '';
                        echo $duplicateEmailErrorMsg;
                    ?>
                </div>
                <div class="col-4">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password">
                    <?php
                        echo $errors['password'] ?? '';
                    ?>
                </div>
                <div class="col-4">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="text" class="form-control" name="confirmPassword">
                    <?php
                        echo $passConfirmErrorMsg;
                    ?>
                </div>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary" name="register">Register</button>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>