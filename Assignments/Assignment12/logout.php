<?php
function logoutUser() {
    $_SESSION = [];
    session_destroy();
}
?>