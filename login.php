<?php
include "conn.php";

$errorMessage = null;   // Error message variable
$successMessage = null;  // Success message variable
#session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") // Check if form is submitted via POST
{   
    // Function to validate input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    // Get form data and validate
    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    Query($username, $pass, $conn);
}

function Query($username, $pass, $conn)
{
    global $errorMessage, $successMessage;
    
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    print_r($result);
    if ($result->num_rows == 0) 
    {
        $errorMessage = 'Хэрэглэгч бүртгэлгүй байна.';
        header("Location: login.php?error=" . urlencode($errorMessage));
        exit();
    } 
    else 
    {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if(password_verify($pass, $hashed_password))
        {
            $successMessage = 'Амжилттай нэвтэрлээ.';
            header("Location: home.html?success=" . urlencode($successMessage));
            {
                $_SESSION['username'] = $username;
                //utasnii dugaar avah
                $sql = "SELECT phone FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['phone'] = $row['phone'];

                //ner avah
                $sql = "SELECT firstname FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['firstname'] = $row['firstname'];


                //ovog avah
                $sql = "SELECT lastname FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['lastname'] = $row['lastname'];

                //zurag avah
                $sql = "SELECT image FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['image'] = $row['image'];

            }
            exit(); 
        }
        else
        {
            $errorMessage = 'Нууц үг буруу байна';
            header("Location: login.php?error=" . urlencode($errorMessage));
            exit();
        }
    }
}
?>
