<?php
function init_session_php(): void
{
    if (!session_id()) {
        session_start();
        session_regenerate_id();
    }
    ;
}

function clear_session_php(): void
{
    session_unset();
    session_destroy();
}

function is_admin(): bool
{
    return isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
}

function is_logged_in(): bool
{
    return isset($_SESSION['username']);
}