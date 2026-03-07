# Sweetwater Project

## Description

This project was created for the Sweetwater coding assignment using PHP and MySQL.
It reads customer comments from the database, categorizes them into groups, and displays them in a report.
It also parses expected ship dates from comments and updates the database.

## Setup

1. Import the provided database into MySQL.
2. Update the database connection string in `db.php` if necessary.
3. Serve the project using a local PHP server or XAMPP.
4. Visit `index.php` to view the comments report.
5. Visit `updateShipDates.php` to populate the shipdate_expected columns.

## Files

- `db.php` – Handles the database connection
- `comments.php` – Retrieves and categorizes comments
- `index.php` – Displays the comments report
- `updateShipDates.php` – Extracts expected ship dates from comments column and updates shipdate_expected column
