<?php
// sessionHelper.php

session_start();

/**
 * Check if user is logged in.
 * Redirects to login page if not.
 */
function ensureLoggedIn() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
    }
}

/**
 * Check if the user has admin privileges.
 * Redirects to welcome page if not.
 */
function ensureAdmin() {
    ensureLoggedIn();
    if ($_SESSION['user_status'] !== 'admin') {
        header("Location: index.php?page=welcome");
        exit;
    }
}

function isAdmin() {
    return isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'admin';
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}