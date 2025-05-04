<?php

$path = "index.php?page=login";


if(isset($_GET)){
    if($_GET['page'] === "addContact"){
        require_once('views/AddContactForm.php');
        $content = init();
    }
    
    else if($_GET['page'] === "deleteContacts"){
        require_once('views/deleteContactTable.php');
        $content = init();
    }

    else if($_GET['page'] === "welcome"){
        require_once('views/Welcome.php');
        $content = init();

    }

    else if($_GET['page'] === "addAdmin"){
        require_once('views/AddAdminForm.php');
        $content = init();
    }

    else if($_GET['page'] === "deleteAdmins"){
        require_once('views/deleteAdminTable.php');
        $content = init();
    }

    else if($_GET['page'] === "login"){
        require_once('views/LoginForm.php');
        $content = init();
    }

    else {
        header('location: '.$path);
    }
}

else {
    header('location: '.$path);
}
?>