<?php
function validateInput($data) {
    return preg_match("/^[a-zA-Z ]*$/", $data);
}
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if (!validateInput($name) || !validateEmail($email)) {
        echo "Invalid input data. Please check your inputs and try again.";
    } else {
        $sql = "INSERT INTO contactinfo(name, email, message) VALUES ('$name', '$email', '$message')";
         if ($conn->query($sql) === TRUE)
        {
              echo "Message sent successfully.";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
       }
    }
}
$conn->close();
?>   
