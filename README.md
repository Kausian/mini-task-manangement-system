# Mini Task Management System

A simple task management web application built with Core PHP and MySQL. It lets you add tasks, view them in a list, mark them as completed, and delete them. The project uses server-side validation with prepared statements and some basic client-side features written in vanilla JavaScript.

## Technologies Used

- PHP (Core PHP, no framework)
- MySQL (MySQLi)
- HTML5
- CSS3
- Vanilla JavaScript
- XAMPP (Apache + MySQL)

## Features

- Header section and a clean, spaced layout
- Add-task form with title, description, and priority
- Task list shown in a responsive table that becomes cards on small screens
- Latest tasks are shown first
- Mark a pending task as completed directly from the list
- Delete a task with a JavaScript confirmation prompt
- Success and error messages using PHP sessions
- Sticky form values kept after a failed submit
- Server-side validation with prepared statements to prevent SQL injection
- Output escaped with htmlspecialchars
- JavaScript validation for empty fields and a minimum title length of three characters
- Dynamic search that filters tasks by title without reloading the page
- Loading state on the submit button to prevent multiple submissions
- Priority badges styled in green (Low), orange (Medium), and red (High)
- Hover effects on buttons and table rows

## Folder Structure

```
Mini task management system/
├── actions/
│   ├── add-task.php
│   ├── delete-task.php
│   └── update-task.php
├── css/
│   └── style.css
├── includes/
│   ├── db.php
│   └── functions.php
├── js/
│   └── app.js
├── database.sql
├── index.php
└── README.md
```

## XAMPP Setup

1. Install XAMPP.
2. Open the XAMPP Control Panel.
3. Start the Apache module.
4. Start the MySQL module.
5. Copy the `Mini task management system` folder into the XAMPP `htdocs` directory
   (usually `C:\xampp\htdocs`).

## Database Import

1. Open your browser and go to `http://localhost/phpmyadmin`.
2. Click the SQL tab.
3. Open `database.sql`, copy its contents, and paste them into the SQL box.
4. Click Go to run it.

This creates the `intern_task_system` database, the `tasks` table, and a few
sample rows. You can also import the file directly using the phpMyAdmin Import tab.

## How to Run

1. Make sure Apache and MySQL are running in XAMPP.
2. Open your browser and go to:
   `http://localhost/Mini%20task%20management%20system/index.php`

## Default Database Connection

These values are set in `includes/db.php` and match the XAMPP defaults:

- Host: localhost
- Username: root
- Password: (empty)
- Database: intern_task_system

If your MySQL setup uses a different username or password, update `includes/db.php`.

## Basic Testing

1. Add a task with a valid title (three or more characters), a description, and a priority.
   It should appear at the top of the list.
2. Try submitting the form with empty fields or a very short title.
   A validation message should appear and the form should not submit.
3. Submit a valid task and watch the button change to "Adding..." while it saves.
4. Type in the search box and confirm the list filters by title instantly.
   Search for text that does not exist to see the "No matching tasks found" message.
5. Click "Mark Completed" on a pending task and confirm the status changes.
6. Click "Delete" and confirm the browser asks before removing the task.
7. Check that Low, Medium, and High priorities show as colored badges.
