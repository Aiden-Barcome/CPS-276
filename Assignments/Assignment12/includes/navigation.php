<?php
include_once "includes/security.php";

$adminLinks='';
$nav='';

if(isAdmin()){
    $adminLinks=<<<html
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a>
        </li>
    html;

}

if(isLoggedIn()){
    $nav= <<<html
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=deleteContacts">Delete contact(s)</a>
                        </li>
                        {$adminLinks}
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login&logout=true">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    html;
}

?>