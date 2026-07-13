<?php

session_start();
require "includes/db.php";
require "includes/functions.php";

// Get old form values if the last submit failed, then clear them
$old = $_SESSION["old"] ?? [];
unset($_SESSION["old"]);

// Get all tasks, newest first
$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC, id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Task Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Task Manager</h1>

        <?php if (isset($_SESSION["success"])): ?>
            <p class="message success"><?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION["error"])): ?>
            <p class="message error"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
        <?php endif; ?>

        <!-- Add Task form -->
        <form action="actions/add-task.php" method="POST" class="task-form" id="task-form">
            <p class="validation-message hidden" id="validation-message"></p>

            <input type="text" name="title" id="title" placeholder="Task title"
                   value="<?php echo h($old["title"] ?? ""); ?>">

            <textarea name="description" id="description" placeholder="Description"><?php echo h($old["description"] ?? ""); ?></textarea>

            <select name="priority" id="priority">
                <option value="">Select priority</option>
                <?php foreach (["Low", "Medium", "High"] as $level): ?>
                    <option value="<?php echo $level; ?>"
                        <?php echo (($old["priority"] ?? "") === $level) ? "selected" : ""; ?>>
                        <?php echo $level; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" id="submit-btn">Add Task</button>
        </form>

        <!-- Search bar -->
        <input type="text" id="search" class="search-bar" placeholder="Search tasks by title...">

        <!-- Task list -->
        <table class="task-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="task-list">
                <?php if ($result->num_rows === 0): ?>
                    <tr><td colspan="6">No tasks yet.</td></tr>
                <?php else: ?>
                    <?php while ($task = $result->fetch_assoc()): ?>
                        <tr class="task-row">
                            <td data-label="Title" class="task-title"><?php echo h($task["title"]); ?></td>
                            <td data-label="Description"><?php echo h($task["description"]); ?></td>
                            <td data-label="Priority">
                                <span class="badge badge-<?php echo strtolower($task["priority"]); ?>">
                                    <?php echo h($task["priority"]); ?>
                                </span>
                            </td>
                            <td data-label="Status"><?php echo h($task["status"]); ?></td>
                            <td data-label="Created"><?php echo h($task["created_at"]); ?></td>
                            <td data-label="Action">
                                <?php if ($task["status"] === "Pending"): ?>
                                    <form action="actions/update-task.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
                                        <button type="submit">Mark Completed</button>
                                    </form>
                                <?php else: ?>
                                    Done
                                <?php endif; ?>

                                <form action="actions/delete-task.php" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
                <tr id="no-results" class="hidden">
                    <td colspan="6">No matching tasks found.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="js/app.js"></script>
</body>
</html>
