<?php

session_start();
require "../includes/db.php";
require "../includes/functions.php";

// Get the task id and make sure it is a number
$id = (int) ($_POST["id"] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("UPDATE tasks SET status = 'Completed' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION["success"] = "Task marked as completed.";
} else {
    $_SESSION["error"] = "Invalid task.";
}

redirect("../index.php");
