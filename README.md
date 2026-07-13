# Mini Task Management System

A simple task management web application built using Core PHP, MySQL, HTML, CSS, and vanilla JavaScript.

The application allows users to create tasks, view them, search by title, update their status, and delete them. It also includes responsive design, pagination, dark mode, frontend validation, and Docker support.

## Technologies Used

- PHP 8.2
- MySQL / MariaDB
- MySQLi
- HTML5
- CSS3
- JavaScript
- XAMPP
- Docker
- Docker Compose
- Git and GitHub

## Features

- Add tasks with a title, description, and priority
- Display all task information
- Show the latest tasks first
- Mark pending tasks as completed
- Delete tasks with a confirmation message
- Search tasks by title without reloading the page
- Frontend validation using JavaScript
- Server-side validation using PHP
- Prepared statements to prevent SQL injection
- Safe output using `htmlspecialchars`
- Success and error messages using PHP sessions
- Sticky form values after validation errors
- Loading state on the Add Task button
- Priority badges:
  - Low: Green
  - Medium: Orange
  - High: Red
- Hover effects on buttons and task rows
- Responsive task table that changes into cards on smaller screens

## Optional Features

- Client-side pagination
- Dark mode toggle
- Dark mode preference stored using `localStorage`


## Folder Structure

```text
Mini-task-management-system/
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
├── .dockerignore
├── .env.example
├── .gitignore
├── compose.yaml
├── database.sql
├── Dockerfile
├── index.php
└── README.md
```

## Run with XAMPP

### Requirements

- XAMPP
- A web browser

### 1. Copy the project

Copy the project folder into the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\Mini-task-management-system
```

### 2. Start XAMPP services

Open the XAMPP Control Panel and start:

- Apache
- MySQL

### 3. Import the database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

You can import the database using either of these methods.

#### Method 1: Import tab

1. Click **Import**
2. Click **Choose File**
3. Select `database.sql`
4. Click **Import** or **Go**

#### Method 2: SQL tab

1. Open `database.sql`
2. Copy its contents
3. Paste the SQL into the phpMyAdmin SQL tab
4. Click **Go**

The SQL file creates:

```text
Database: intern_task_system
Table: tasks
```

### 4. Open the application

```text
http://localhost/Mini-task-management-system/
```

You can also open:

```text
http://localhost/Mini-task-management-system/index.php
```

Do not open `index.php` by double-clicking it. PHP must run through Apache using `localhost`.

## Run with Docker

### Requirements

- Docker Desktop
- Docker Compose

### 1. Clone the repository

```bash
git clone https://github.com/Kausian/mini-task-manangement-system.git
cd mini-task-manangement-system
```

### 2. Create the environment file

Copy `.env.example` and create a new file named `.env`.

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Example `.env` values:

```env
MARIADB_ROOT_PASSWORD=root_password
DB_NAME=intern_task_system
DB_USER=task_user
DB_PASSWORD=task_password
```

The `.env` file contains local database values and should not be committed to GitHub.

### 3. Validate the Docker Compose configuration

```bash
docker compose config
```

### 4. Build and start the containers

```bash
docker compose up --build -d
```

This starts:

- PHP 8.2 with Apache
- MariaDB 10.11

### 5. Check the containers

```bash
docker compose ps
```

The expected containers are:

```text
mini-task-app
mini-task-db
```

The database container should display a healthy status.

### 6. Open the Docker application

```text
http://localhost:8080
```


### 8. Check the MySQLi extension

```powershell
docker compose exec app php -m | findstr mysqli
```

Expected output:

```text
mysqli
```

### 9. Check PHP syntax

```bash
docker compose exec app sh -c "find . -name '*.php' -exec php -l {} \;"
```

Each PHP file should report:

```text
No syntax errors detected
```

### 10. Stop the containers

```bash
docker compose down
```

The database data remains stored in the Docker volume.

### 11. Remove containers and database data

```bash
docker compose down -v
```

Warning: this command deletes the Docker database volume and all tasks stored inside it.

## Database Configuration

The application supports both XAMPP and docke

### XAMPP defaults

```text
Host: localhost
Username: root
Password: empty
Database: intern_task_system
```

### Docker configuration

Docker passes the following environment variables to the PHP application:

```text
DB_HOST
DB_USER
DB_PASSWORD
DB_NAME
```

The Docker database hostname is:

```text
db
```

This is the MariaDB service name defined in `compose.yaml`.

The connection file uses environment variables when they are available and falls back to the XAMPP values when running locally.

## Basic Testing

1. Submit the form with empty fields.
   - A validation error should appear.

2. Enter a task title with fewer than three characters.
   - A minimum title-length message should appear.

3. Add a valid task.
   - The task should appear at the top of the list.

4. Add more than five tasks.
   - Pagination controls should appear.

5. Test Previous, Next, and page-number buttons.
   - The page should change without reloading.

6. Search for a task by title.
   - Matching tasks should appear immediately.

7. Search for a title that does not exist.
   - The “No matching tasks found” message should appear.

8. Click Mark Completed on a pending task.
   - The status should change to Completed.

9. Click Delete.
   - A confirmation message should appear before deletion.

10. Check the priority badges.
    - Low should be green.
    - Medium should be orange.
    - High should be red.

11. Toggle dark mode.
    - The page should switch between light and dark themes.

12. Refresh the browser after selecting dark mode.
    - The chosen theme should remain active.

13. Resize the browser window.
    - The task table should change into responsive cards.

14. Run the project using Docker.
    - Both containers should be running.
    - The database container should show as healthy.

15. Add a task using the Docker version, restart the containers, and confirm the task remains available.

## Docker Commands

Build and start:

```bash
docker compose up --build -d
```

Check containers:

```bash
docker compose ps
```

View logs:

```bash
docker compose logs
```

Stop containers:

```bash
docker compose down
```

Stop containers and remove database data:

```bash
docker compose down -v
```