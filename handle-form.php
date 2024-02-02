<?php

session_start();

$name = "";
$email = "";
$phoneNumber = "";
$dateOfBirth = "";
$gender = "";
$country = "";
$message = "";

$data = [];
$errors = [];

//Validating the form data
//Name - should not be empty and should only have letters and spaces
if (!empty($_POST['name'])) {
  $name = $_POST['name'];
  if (ctype_alpha(str_replace(" ", "", $name)) === false) {
    $errors['name'] = "Name should only contain letters and spaces";
  }
} else {
  $errors['name'] = "Name is a required field";
}

//Email - should be a valid email format
if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  if (filter_var($email, FILTER_VALIDATE_EMAIL) !== $email) {
    $errors['email'] = "Email is not valid";
  }
} else {
  $errors['email'] = "Email is a required field";
}

//Phone number - should be a valid UK phone number format
if (!empty($_POST['phoneNumber'])) {
  $phoneNumber = $_POST['phoneNumber'];
  if (!preg_match("/^(?:\+44|0)\\d{10}$/", $phoneNumber)) {
    $errors['phoneNumber'] = "Phone number should be a valid UK number";
  }
}

//Date of birth - should be a valid date format
if (!empty($_POST['dateOfBirth'])) {
  $dateOfBirth = $_POST['dateOfBirth'];
}

//Gender - at least one option should be selected
if (!empty($_POST['gender'])) {
  $gender = $_POST['gender'];
} else {
  $errors['gender'] = "Gender is a required field";
}

//Country - should not be empty
if (!empty($_POST['country'])) {
  $country = $_POST['country'];
  $allowedCountries = ["Armenia", "Portugal", "Ukraine", "United Kingdom", "United States of America"];
  if (!in_array($country, $allowedCountries)) {
    $errors['country'] = "Country is not allowed";
  }
} else {
  $errors['country'] = "You must select a country from the list";
}

//Message - no validation 
if (!empty($_POST['message'])) {
  $message = $_POST['message'];
}

if ($errors) {
  $_SESSION['status'] = 'error';
  $_SESSION['errors'] = $errors;
  
  // Save the submitted data to repopulate the form
  $_SESSION['data'] = $_POST; 

  header('Location: index.php?result=validation_error');
  exit();

} else {
  $data = [
    "name" => $name,
    "email" => $email,
    "phoneNumber" => $phoneNumber,
    "dateOfBirth" => $dateOfBirth,
    "gender" => $gender,
    "country" => $country,
    "message" => $message
  ];

  // Add data to csv file
  $csvFileData = 'form_data.csv';
  $fileHandle = fopen($csvFileData, 'a');
  fputcsv($fileHandle, $data);
  fclose($fileHandle);


  // Set session status and data
  $_SESSION['status'] = 'success';

   // Save the submitted data for display on success page
  $_SESSION['data'] = $_POST;

  // Redirect to success page
  header('Location: success-page.php');
  exit();
}

