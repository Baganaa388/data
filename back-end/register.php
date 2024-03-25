<?php
include("conn.php");
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// $role = $username = $password =  $firstname = $lastname = $email = " ";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $role = validate($_POST["role"]);
    $username = validate($_POST["username"]);
    $password = validate($_POST["password"]);
    $firstname = validate($_POST["firstname"]);
    $lastname = validate($_POST["lastname"]);
    $email = validate($_POST["email"]);
}

if (empty($role) || empty($username) || empty($password) || empty($firstname) || empty($lastname) || empty($email)) {
    header("Location: reg.php?error=Username or password is empty");
    exit();
} 
else {
    $user_check = "SELECT * FROM user WHERE username='$username'";
    $result_1 = mysqli_query($conn, $user_check);

    if (mysqli_num_rows($result_1) > 0) {
        header("Location: reg.php?error=Username already exists");
        exit();
    } else {
        $sql = "INSERT INTO user VALUES ('$role', '$username', '$password', '$firstname', '$lastname', '$email')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $uname;
            header('location: b.html');
            exit();
        } else {
            header("Location: reg.php?error=Error executing SQL query");
            exit();
        }
    }
}
?>