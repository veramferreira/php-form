<?php
require_once "config.php";

session_start();
include 'functions.php';

// Display details from the current form submission
$currentFormData = isset($_SESSION['data']) ? $_SESSION['data'] : [];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Success Page</title>

  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <div class="container">

    <h1>Form successfully submitted! Hooray! 🥳</h1>
    <h3>Here are your details:</h3>
    <ul class="details-entered">
      <li>Name: <p>
          <?php echo escapeStr($currentFormData['name']); ?>
        </p>
      </li>
      <li>Email: <p>
          <?php echo escapeStr($currentFormData['email']); ?>
        </p>
      </li>
      <li>Phone number: <p>
          <?php echo escapeStr($currentFormData['phoneNumber']); ?>
        </p>
      </li>
      <li>Date of birth: <p>
          <?php echo $currentFormData['dateOfBirth']; ?>
        </p>
      </li>
      <li>Gender: <p>
          <?php echo $currentFormData['gender']; ?>
        </p>
      </li>
      <li>Country: <p>
          <?php echo $currentFormData['country']; ?>
        </p>
      </li>
      <li>Your message: <p>
          <?php echo escapeStr($currentFormData['message']); ?>
        </p>
      </li>
    </ul><br />

    <!-- Read data from csv file -->
    <?php
    $csvFileData = 'form_data.csv';
    displayCsvData($csvFileData);
    ?>

    <a href="index.php"><button class="new-form-btn">Fill in a new form</button></a>

    <?php
    // Clear the session data after displaying it
    unset($_SESSION['data']);
    ?>
    
  </div>
</body>

</html>