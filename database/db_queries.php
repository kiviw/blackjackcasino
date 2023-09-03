<?php
// Include the database connection
require_once('db_connection.php');

// Function to perform a SELECT query
function selectQuery($sql)
{
    global $conn;
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

// Function to perform an INSERT, UPDATE, or DELETE query
function executeQuery($sql)
{
    global $conn;
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    return $result;
}
?>
