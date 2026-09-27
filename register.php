<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>

<h2>Student Registration</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Enter Name" required>
    <br><br>

    <input type="email" name="email" placeholder="Enter Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Enter Password" required>
    <br><br>

    <button type="submit">Register</button>

</form>

</body>
</html>
