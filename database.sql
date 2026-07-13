-- 1. Create the database only if it does not already exist
CREATE DATABASE IF NOT EXISTS intern_task_system;

-- 2. Switch to that database so the table is created inside it
USE intern_task_system;

-- 3. Create the tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id          INT AUTO_INCREMENT PRIMARY KEY,         
    title       VARCHAR(255) NOT NULL,                   
    description TEXT,                                     
    priority    ENUM('Low', 'Medium', 'High') NOT NULL DEFAULT 'Low',
    status      ENUM('Pending', 'Completed') NOT NULL DEFAULT 'Pending',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP     
);

-- 4. (Optional) A few sample rows so the list is not empty while testing
INSERT INTO tasks (title, description, priority, status) VALUES
('Prepare interview notes', 'Revise Core PHP and MySQL basics', 'High', 'Pending'),
('Buy groceries',           'Milk, eggs, bread',                'Low',  'Completed'),
('Finish task manager',     'Complete the CRUD project',        'Medium', 'Pending');
