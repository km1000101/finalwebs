<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Footer</title>
   <style>
      .social-links a {
         color: orange; /* Assuming the navigation bar buttons are blue */
         margin-right: 10px;
         font-size: 24px;
      }
      .social-links a:hover {
         color: rgb(4, 113, 197); /* Darker blue on hover */
      }
      .footer {
         background-color:rgba(33, 31, 31, 1); /* Make the footer less transparent */
         color: #ffffff; /* Light text color */
         padding: 25px;
         text-align: center;
         transition: bottom .7s ease-in-out; /* Smoother transition for footer */

      }
   </style>
</head>
<body>

   <footer class="footer">

      &copy; copyright @ <?= date('Y'); ?> by <span>Department of CS-AI</span> | all rights reserved!
      
      <div class="social-links" style="margin-top: 10px;">
         <a href="https://github.com/Victor-Ikechukwu" target="_blank">
            <i class="fab fa-github"></i>
         </a>
         <a href="https://www.linkedin.com/in/victor-ikechukwu-agughasi/" target="_blank">
            <i class="fab fa-linkedin-in"></i>
         </a>
         <a href="https://www.youtube.com/@VictorsPortal" target="_blank">
            <i class="fab fa-youtube"></i>
         </a>
         <a href="https://twitter.com/your-profile" target="_blank">
            <i class="fab fa-twitter"></i>
         </a>
      </div>

   </footer>

</body>
</html>