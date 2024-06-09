<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function requireLogout(): void
{
    if (isLoggedIn()) {
        header('Location: index.php');
        exit;
    }
}

function logout(): void
{
    session_destroy();
    header('Location: login.php');
    exit;
}