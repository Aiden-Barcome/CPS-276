<?php

function init(){
    return <<<HTML
    <div class="container mt-5">
        <h1>Welcome Page</h1>
        <p>Welcome, {$_SESSION['user_name']}!</p>
</div>
HTML;
}
?>