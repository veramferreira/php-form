<?php

session_start(); //initialise a new session

include 'functions.php';

?><!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>A Form!</title>
  
    <link rel="stylesheet" href="styles.css">
    
  </head>
  <body>
    <div class="container">
      <h1>Complete This Form:</h1>

      <!-- HANDLING ERRORS/SUCCESS -->
      <?php if(isset($_SESSION['status']) && $_SESSION['status'] === 'error') : 
      $errors = $_SESSION['errors'];
      ?>
      <p class="main-error">🚨 There are items that require your attention! 🚨</p>
      <?php endif; ?>
      <!-- END OF HANDLING ERRORS/SUCCESS -->
      
      <!-- NAME FIELD -->
      <form action="handle-form.php" method="post">
        <div class="field-group">         
          <label for="name" class="field-title">Full name</label>
          <input type="text" name="name" id="name" placeholder="Enter your name..."
            <?php if (isset($errors['name'])) : ?> class="error-input" <?php endif; ?> 
            value="<?php echo $_SESSION['data']['name']; ?>"/>
          <?php if (isset($errors['name'])) : ?>
              <p class="errors"><?php echo $errors['name']; ?></p>
          <?php endif; ?>
        </div>
        
        <!-- EMAIL FIELD -->
        <div class="field-group">
          <label for="email" class="field-title">Email</label>
          <input type="email" name="email" id="email" placeholder="Enter your email..."
            <?php if (isset($errors['email'])) : ?>
                class="error-input"
            <?php endif; ?> 
            value="<?php echo $_SESSION['data']['email']; ?>"/>
          <?php if (isset($errors['email'])) : ?>
              <p class="errors"><?php echo $errors['email']; ?></p>
          <?php endif; ?>
        </div>

        <!-- PHONE FIELD -->
        <div class="field-group">
          <label for="phoneNumber" class="field-title">Phone number <span class="optional">(optional)</span></label>
          <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number..."
            <?php if (isset($errors['phoneNumber'])) : ?>
                class="error-input"
            <?php endif; ?>
            value="<?php echo $_SESSION['data']['phoneNumber']; ?>"/>
          <?php if (isset($errors['phoneNumber'])) : ?>
              <p class="errors"><?php echo $errors['phoneNumber']; ?></p>
          <?php endif; ?>
        </div>

        <!-- DATE OF BIRTH FIELD -->
        <div class="field-group">
          <label for="dateOfBirth" class="field-title">Date of birth <span class="optional">(optional)</span></label>
          <input type="date" name="dateOfBirth" id="dateOfBirth"
          value="<?php echo $_SESSION['data']['dateOfBirth'] ?? ""; ?>"/>
        </div>

        <!-- GENDER FIELD -->
        <div class="field-group">
          <p class="field-title">What is your gender?</p>
    
          <input type="radio" id="male" name="gender" value="Male" <?php echo ($_SESSION['data']['gender'] ?? '') === 'Male' ? 'checked' : ''; ?> />
          <label for="male">Male</label>

          <input type="radio" id="female" name="gender" value="Female" <?php echo ($_SESSION['data']['gender'] ?? '') === 'Female' ? 'checked' : ''; ?> />
          <label for="female">Female</label>

          <input type="radio" id="other" name="gender" value="Other" <?php echo ($_SESSION['data']['gender'] ?? '') === 'Other' ? 'checked' : ''; ?> />
          <label for="other">Other</label>

          <?php if (isset($errors['gender'])) : ?>
              <p class="errors"><?php echo $errors['gender']; ?></p>
          <?php endif; ?>
        </div>

        <!-- COUNTRY FIELD -->
        <div class="field-group">
          <p class="field-title">What is your favourite country?</p>
      
          <select name="country" id="country" <?php if (isset($errors['country'])) : ?>
                class="error-input"
            <?php endif; ?>>
            <option value="">--Select a Country--</option>
            <option value="Armenia" <?php echo ($_SESSION['data']['country'] ?? '') === 'Armenia' ? 'selected' : ''; ?>>Armenia</option>
            <option value="Portugal" <?php echo ($_SESSION['data']['country'] ?? '') === 'Portugal' ? 'selected' : ''; ?>>Portugal</option>
            <option value="Ukraine" <?php echo ($_SESSION['data']['country'] ?? '') === 'Ukraine' ? 'selected' : ''; ?>>Ukraine</option>
            <option value="United Kingdom" <?php echo ($_SESSION['data']['country'] ?? '') === 'United Kingdom' ? 'selected' : ''; ?>>United Kingdom</option>
            <option value="United States of America" <?php echo ($_SESSION['data']['country'] ?? '') === 'United States of America' ? 'selected' : ''; ?>>United States of America</option>
          </select>

          <?php if (isset($errors['country'])) : ?>
              <p class="errors"><?php echo $errors['country']; ?></p>
          <?php endif; ?>
        </div>

        <!-- MESSAGE FIELD -->
        <div class="field-group">
          <label for="message" class="field-title">What would you like to tell us? <span class="optional">(optional)</span></label>
          <textarea name="message" id="message" placeholder="Write your message here..." ><?php echo $_SESSION['data']['message'] ?? ""; ?></textarea>
        </div>

        <div class="field-group">
          <input type="hidden" name="token" value="" >
          <button type="submit" value="Submit">Submit</button>
        </div> 
        
      </form>
    </div>
  </body>
</html>

<?php
unset($_SESSION['status']);
unset($_SESSION['errors']);
unset($_SESSION['data']);
