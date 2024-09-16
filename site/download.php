<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "SERVERNAME";
$username = "USERNAME";
$password = "PASSWORD";
$db = "DATABASE-NAME";
$table = "IMG";

// Create a connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the HTTP headers for the CSV file download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $table . '.csv');

// Open output stream for writing CSV data
$output = fopen('php://output', 'w');

// Define the specific columns you want to select
$columns = ['ID', 'NAME', 'LABEL']; // Replace with your column names

// Output the column headers
fputcsv($output, $columns);

// Fetch the specified columns from the table
$query = "SELECT " . implode(", ", $columns) . " FROM $table";
$result = $conn->query($query);

if ($result) {
    // Output each row as CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

// Close the output stream
fclose($output);

// Close the database connection
$conn->close();
?>
