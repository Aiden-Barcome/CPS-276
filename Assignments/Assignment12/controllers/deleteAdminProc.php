<?php

require_once 'classes/Pdo_methods.php';
require_once 'includes/security.php';

ensureLoggedIn();
ensureAdmin();

$pdo = new PdoMethods();

$msg = "<p>&nbsp;</p>"; //I use $msg as a placeholder because sometimes it has data and sometimes it does not and if it does not I don't want the space to collapse. 
$output = "";
$deleted = false;

if(isset($_POST['delete'])){
    if(isset($_POST['chkbx'])){
        
        foreach($_POST['chkbx'] as $id){
            
            $sql = "DELETE FROM admins WHERE id=:id";
            $bindings = [
                [':id', $id, 'int'],
            ];
            $result = $pdo->otherBinded($sql, $bindings);

            if($result === 'error'){
                $msg = "<pThere was a problem deleting this record.</p>";
                break;
            }
            else {
                $deleted = true;
            }
        }
    }
}


//This gets the records for the table
$sql = "SELECT * FROM admins";

$records = $pdo->selectNotBinded($sql);

?>