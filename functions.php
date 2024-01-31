<?php

// Function to escape malicious code from being entred as text (html tags, JS, etc)
function escapeStr($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Function to open, read, display and close csv file
function displayCsvData($csvFile) {
    
  if (file_exists($csvFile)) {
        $fileHandle = fopen($csvFile, 'r');

        echo "<h3>Previous Entries:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Date of Birth</th><th>Gender</th><th>Country</th><th>Message</th></tr>";

        // Read and display data
        while (($data = fgetcsv($fileHandle)) !== false) {
            echo "<tr>";
            foreach ($data as $value) {
                echo "<td>" . escapeStr($value) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";

        // Close file
        fclose($fileHandle);
    
    } else {
        echo "<p>Sorry, no data available.</p>";
    }
}