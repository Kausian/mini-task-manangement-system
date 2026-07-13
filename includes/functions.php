<?php

// Send the user to another page and stop the current script
function redirect($url) {
    header("Location: " . $url);
    exit;
}

// Short helper to safely print database text in HTML
function h($text) {
    return htmlspecialchars($text);
}
