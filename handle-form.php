<?php
require_once "./Connection.class.php";

session_start();

$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";
$phoneNumber = $_POST['phoneNumber'] ?? "";
$dateOfBirth = $_POST['dateOfBirth'] ?? "";
$gender = $_POST['gender'] ?? "";
$country = $_POST['country'] ?? "";
$message = $_POST['message'] ?? "";

$data = [];
$errors = [];

// Validating the form data
// Name - should not be empty and should only have letters and spaces
if (empty($name)) {
  $errors['name'] = "Name is a required field";
} elseif (!ctype_alpha(str_replace(" ", "", $name))) {
  $errors['name'] = "Name should only contain letters and spaces";
}

// Email - should be a valid email format
if (empty($email)) {
  $errors['email'] = "Email is a required field";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = "Email is not valid";
}

// Phone number - should be a valid UK phone number format
if (!empty($phoneNumber) && !preg_match("/^(?:\+44|0)\d{10}$/", $phoneNumber)) {
  $errors['phoneNumber'] = "Phone number should be a valid UK number";
}

// Gender - at least one option should be selected
if (empty($gender)) {
  $errors['gender'] = "Gender is a required field";
}

// Country - should not be empty
if (empty($country)) {
  $errors['country'] = "You must select a country from the list";
} elseif (!in_array($country, ["Armenia", "Portugal", "Ukraine", "United Kingdom", "United States of America"])) {
  $errors['country'] = "Country is not allowed";
}

if ($errors) {
  // Set session status and errors
  $_SESSION['status'] = 'error';
  $_SESSION['errors'] = $errors;

  // Save the submitted data to repopulate the form
  $_SESSION['data'] = $_POST;

  // Redirect to form page with validation error
  header('Location: index.php?result=validation_error');
  exit();

} else {

  $sql = "INSERT INTO users (name, email, phone_number, date_of_birth, gender, country, message)
            VALUES (:name, :email, :phoneNumber, :dateOfBirth, :gender, :country, :message)";

  try {
    // Access pdo property from Connection class
    $stmt = $connection->pdo->prepare($sql);

    $stmt->execute([
      ':name' => $name,
      ':email' => $email,
      ':phoneNumber' => $phoneNumber,
      ':dateOfBirth' => $dateOfBirth,
      ':gender' => $gender,
      ':country' => $country,
      ':message' => $message
    ]);

    // Set session status and data for success
    $_SESSION['status'] = 'success';
    $_SESSION['data'] = $_POST;

    // Redirect to success page
    header('Location: success-page.php');
    exit();
  } catch (PDOException $e) {
    // Log the error
    error_log("PDO execution error: " . $e->getMessage());

    // Set session status and error message
    $_SESSION['status'] = 'error';
    $_SESSION['errors']['database'] = 'An error occurred while processing your request. Please try again later.';

    // Save the submitted data to repopulate the form
    $_SESSION['data'] = $_POST;

    // Redirect to form page with database error
    header('Location: index.php?result=validation_error');
    exit();
  }
}
?>