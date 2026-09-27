
<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

if (password_verify($password, $user["password"])) {

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_name"] = $user["name"];

    header("Location: dashboard.php");
    exit();

}
    } else {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
</head>

<body>

<h2>Student Login</h2>

<form method="POST">

    <input type="email" name="email"
           placeholder="Enter Email" required>
    <br><br>

    <input type="password" name="password"
           placeholder="Enter Password" required>
    <br><br>

    <button type="submit">Login</button>

</form>

<h3><?php echo $message; ?></h3>

</body>
</html>
<p>New user? <a href="register.php">Register here</a></p><button type="submit">Login</button>

<p>New user? <a href="register.php">Register here</a></p>
