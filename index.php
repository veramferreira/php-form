<?php

session_start(); //initialise a new session

include 'functions.php';

?><!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>A Form!</title>
  
    <link rel="stylesheet" href="style.css">
    
  </head>
  <body>
    <div class="container">
      <h1>Complete This Form:</h1>

      <!-- HANDLING ERRORS/SUCCESS -->
      <?php if(isset($_SESSION['status']) && $_SESSION['status'] === 'error') : 
      $errors = $_SESSION['errors']; 
      ?>
      <ul class="errors">
        <?php foreach($errors as $error) : ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
  
      <?php endif; ?>
      <!-- END OF HANDLING ERRORS/SUCCESS -->
      
      <form action="handle-form.php" method="post">
        <div class="field-group">         
          <label for="name" class="field-title">Full name:</label>
          <input type="text" name="name" id="name" placeholder="Enter your name..." required
          value="<?php echo isset($_SESSION['data']['name']) ? htmlspecialchars($_SESSION['data']['name'], ENT_QUOTES, 'UTF-8') : ''; ?>"/>
        </div>

        <div class="field-group">
          <label for="email" class="field-title">Email:</label>
          <input type="email" name="email" id="email" placeholder="Enter your email..."/>
        </div>

        <div class="field-group">
          <label for="phoneNumber" class="field-title">Phone number:</label>
          <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number..."/>
        </div>

        <div class="field-group">
          <label for="dateOfBirth" class="field-title">Date of birth:</label>
          <input type="date" name="dateOfBirth" id="dateOfBirth" placeholder="Enter your name..."/>
        </div>

        <div class="field-group">
          <p class="field-title">What is your gender:</p>
    
            <input type="radio" id="male" name="gender" value="Male"/>
            <label for="male">Male</label>
        
            <input type="radio" id="female" name="gender" value="Female"/>
            <label for="female">Female</label>
    
            <input type="radio" id="other" name="gender" value="Other" />
            <label for="other">Other</label>
        </div>

        <div class="field-group">
          <p class="field-title">What is your favourite country?</p>
          <select name="country" id="country">
           <option value="">--Select a Country--</option>
           <option value="Armenia">Armenia</option>
           <option value="Portugal">Portugal</option>
           <option value="Ukraine">Ukraine</option>
           <option value="United Kingdom">United Kingdom</option>
           <option value="United States of America">United States of America</option>
          </select>
        </div>

        <div class="field-group">
          <label for="message" class="field-title">What would you like to tell us?</label>
          <textarea name="message" id="message" placeholder="Write your message here..."></textarea>
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
