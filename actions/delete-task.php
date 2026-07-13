<?php

session_start();
require "../includes/db.php";
require "../includes/functions.php";

$id = (int) ($_POST["id"] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION["success"] = "Task deleted.";
} else {
    $_SESSION["error"] = "Invalid task.";
}

redirect("../index.php");
