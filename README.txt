README — RoomEasy Hotel Booking System

RoomEasy is a simple hotel room booking web application developed using PHP, MySQL, HTML, CSS, and JavaScript. It was created for the ITS30605 Web Programming assignment. The system demonstrates complete CRUD operations (Create, Read, Update, Delete) through a clean and straightforward interface.

1. Project Purpose

RoomEasy allows users to:

Create new room bookings

View all existing bookings

Filter bookings by room type or status

Update booking details

Delete bookings with confirmation prompts

The project follows all required assignment constraints:

No frameworks used (no Bootstrap, Laravel, React, etc.)

Only external CSS and JavaScript files

PHP used for backend processing

MySQL database for data storage

Proper database design with sample data

2. Requirements to Run This Project

Anyone can run RoomEasy using only:

XAMPP (which includes PHP, Apache, and MySQL)

A web browser (Chrome, Edge, or Firefox)

No extra tools, installations, or configurations are needed.

3. How to Run the Project (Step-by-Step Guide)

This section explains every step a new user needs to follow to make the project run successfully.

Step 1 — Install XAMPP

Download XAMPP from:

https://www.apachefriends.org/

Install XAMPP using default settings.
This automatically installs:

PHP (for running backend code)

Apache (the local web server)

MySQL (the database system)

phpMyAdmin (database management tool)

No additional setup is required.

Step 2 — Start Apache and MySQL

Open XAMPP Control Panel.

Click Start next to:

Apache

MySQL

Both modules should turn green.
Once they are running, the computer is ready to serve PHP pages and connect to the database.

Step 3 — Copy the Project Folder

Navigate to the local server directory:

C:\xampp\htdocs\


Inside this folder, create a new folder named:

roomeasy


Place all project files and folders inside roomeasy, keeping the structure exactly like this:

roomeasy/
 ┣ css/
 ┣ js/
 ┣ includes/
 ┣ pages/
 ┣ init_database.php
 ┣ schema.sql
 ┣ index.php
 ┣ about.php
 ┣ tasklist.txt
 ┗ README.txt


This is important because Apache serves files from htdocs.

Step 4 — Initialize the Database

RoomEasy requires a database named roomeasy_db with a table called bookings.
The project provides two easy methods to set up the database.

Option A — Automatic Setup (Recommended)

Open a web browser and visit:

http://localhost/roomeasy/init_database.php


This file automatically:

Creates the database

Creates the table

Inserts 5 sample booking records

If the setup succeeds, a confirmation message appears.

No SQL knowledge is required.

Option B — Manual Setup Using phpMyAdmin

Open phpMyAdmin at:

http://localhost/phpmyadmin/


Click Import in the top menu.

Click Choose File and select the file:

roomeasy/schema.sql


Click Go.

This will create the database, table, and insert the sample data.

Step 5 — Run the Application

After the database is ready, the system can be opened in any browser.

Go to:

http://localhost/roomeasy/index.php


This loads the landing page of RoomEasy.

From here, users can:

Create bookings

View bookings

Edit bookings

Delete bookings

Open the About page

Everything is fully functional once Apache and MySQL are running.

4. Project Features
Create Booking

A form where the user enters:

Guest name

Email

Phone number

Room type

Check-in date

Check-out date

Status

JavaScript validates the input before submitting.

View Bookings

Displays all bookings in a table.
Includes optional filters for:

Room type

Status

Each row has Edit and Delete buttons.

Update Booking

Shows a form pre-filled with the selected booking details.
The user can change any field and save the update.

Delete Booking

Removes a booking from the database after a confirmation popup.

5. Folder Structure Overview

/index.php — Landing page

/about.php — About the system and team

/pages/ — CRUD pages

/includes/ — Reusable header, footer, and database connection

/css/style.css — All styling

/js/script.js — Menu toggle, validation, alerts

/init_database.php — Automatic DB setup

/schema.sql — SQL structure for manual setup