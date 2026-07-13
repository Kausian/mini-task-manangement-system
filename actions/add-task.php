<?php

session_start();
require "../includes/db.php";
require "../includes/functions.php";

// Read and trim the submitted values
$title = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$priority = $_POST["priority"] ?? "";

// Validate the inputs
$errors = [];

if (strlen($title) < 3) {
    $errors[] = "Title must be at least 3 characters.";
}
if ($description === "") {
    $errors[] = "Description cannot be empty.";
}
if (!in_array($priority, ["Low", "Medium", "High"])) {
    $errors[] = "Please select a valid priority.";
}

// If anything is wrong, keep the typed values and go back
if (!empty($errors)) {
    $_SESSION["error"] = implode(" ", $errors);
    $_SESSION["old"] = [
        "title" => $title,
        "description" => $description,
        "priority" => $priority
    ];
    redirect("../index.php");
}

// Save the task using a prepared statement
$stmt = $conn->prepare("INSERT INTO tasks (title, description, priority) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $description, $priority);
$stmt->execute();

$_SESSION["success"] = "Task added successfully.";
redirect("../index.php");
