<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
</head>
<body>
    <a href="/list.php">go to list</a>
	<h1>Add User</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="username">Username:</label>
		<input type="text" name="username"><br><br>
		<label for="email">Email:</label>
		<input type="text" name="email"><br><br>
		<label for="password">Password:</label>
		<input type="password" name="password"><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>

	<?php
	// Check if the form has been submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Retrieve the form data
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Connect to Azure SQL
		$server = 'uod-web-technologies-website.database.windows.net';
		$database = 'WebTechnologiesDatabase';
		$username_sql = 'uodadmin';
		$password_sql = 'Password1!';
		$connection_string = "DRIVER={ODBC Driver 17 for SQL Server};SERVER=$server;DATABASE=$database;UID=$username_sql;PWD=$password_sql;";
		$conn = odbc_connect($connection_string, '', '');

		// Prepare the SQL statement to insert a new user
		$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

		// Execute the SQL statement
		if (odbc_exec($conn, $sql)) {
			echo "<p>New user added successfully!</p>";
		} else {
			echo "<p>Error adding new user: " . odbc_errormsg($conn) . "</p>";
		}

		// Close the database connection
		odbc_close($conn);
	}
	?>
</body>
</html>
In this example, replace your_server_name, your_database_name, your_sql_username, and your_sql_password with the actual values for your Azure SQL server, database, username, and password.

To create the users table in Azure SQL, you can use the following SQL statement:

sql
Copy code
CREATE TABLE users (
	id INT IDENTITY(1,1) PRIMARY KEY,
	username VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL
);
This will create a table named users with columns for id, username, email, and password, where id is an auto-incrementing primary key.






