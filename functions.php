<?php
// functions.php

function isLinkActive($page) {
    $currentURL = $_SERVER['d']; // Get the current page URL

    // Check if the current page URL matches the given page link
    return (strpos($currentURL, $page) !== false);
}
?>