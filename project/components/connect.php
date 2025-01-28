<?php

   // Define the database connection string
   $db_name = 'mysql:host=localhost;dbname=course_db';
   // Define the database username
   $user_name = 'root';
   // Define the database password
   $user_password = '';

   // Create a new PDO instance to connect to the database
   $conn = new PDO($db_name, $user_name, $user_password);

   // Function to generate a unique ID
   function unique_id() {
      // Define the characters to use in the unique ID
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      // Initialize an array to hold the random characters
      $rand = array();
      // Get the length of the character string minus one
      $length = strlen($str) - 1;
      // Loop to generate 20 random characters
      for ($i = 0; $i < 20; $i++) {
          // Get a random index from the character string
          $n = mt_rand(0, $length);
          // Add the character at the random index to the array
          $rand[] = $str[$n];
      }
      // Return the array as a string
      return implode($rand);
   }

?>