<?php
// functions.php

function isLinkActive($page) {
    $currentURL = $_SERVER['PHP_SELF']; // Get the current page URL

    // Check if the current page URL matches the given page link
    return (strpos($currentURL, $page) !== false);
}