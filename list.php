<a href="/user.php">go to user</a>
<?php
// Replace with your actual database credentials
$server = 'uod-web-technologies-website.database.windows.net';
$database = 'WebTechnologiesDatabase';
$username = 'uodadmin';
$password = 'Password1!';

// Establish connection using ODBC
$connection_string = "DRIVER={ODBC Driver 17 for SQL Server};SERVER=$server;DATABASE=$database;UID=$username;PWD=$password;";
$conn = odbc_connect($connection_string, '', '');

// Check connection
if (!$conn) {
    die("Connection failed: " . odbc_errormsg());
}

// SQL query to select all records from the users table
$sql = "SELECT * FROM users";

// Execute the query and get the result
$result = odbc_exec($conn, $sql);

if (odbc_num_rows($result) > 0) {
    // Output data of each row
    while ($row = odbc_fetch_array($result)) {
        echo "id: " . $row['id'] . " - Username: " . $row['username'] . " - Email: " . $row['email'] . " - Password: " . $row['password'] ."<br>";
    }
} else {
    echo "No users found";
}

// Close the database connection
odbc_close($conn);
?>