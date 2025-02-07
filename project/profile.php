<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      body {
         background: url('images/bg_img2.jpg') no-repeat;
         background-size: cover;
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         overflow-y: scroll; /* Enable vertical scrolling */
         transition: background 0.5s ease-in-out; /* Smooth transition for background */
      }
      .footer {
         margin-top: auto;
         position: fixed;
         bottom: 0;
         width: 100%;
         background: rgb(43, 39, 39);
         color: #fff;
         text-align: center;
         padding: 10px 0;
         transition: bottom 0.3s ease-in-out, background 0.5s ease-in-out; /* Smoother transition for footer */
      }
      .footer.scrolled {
         bottom: -20px; /* Move the footer down a bit when scrolling */
      }
      .details {
         background: rgba(255, 255, 255, 0.8); /* Make the box transparent */
         padding: 20px;
         border-radius: 10px;
         transition: background 0.5s ease-in-out; /* Smooth transition for background */
      }
      .user img {
         position: relative;
         transition: transform 0.3s ease-in-out; /* Smooth transition for image */
      }
      .user img:hover {
         transform: scale(1.1); /* Scale up the image on hover */
      }
      .box {
         transition: transform 0.3s ease-in-out, background 0.5s ease-in-out; /* Smooth transition for box */
      }
      .box:hover {
         transform: translateY(-10px); /* Move the box up on hover */
         background: rgba(255, 255, 255, 0.9); /* Slightly change background on hover */
      }
   </style>

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="profile">

   <h1 class="heading">profile details</h1>

   <div class="details">

      <div class="user">
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <p>student</p>
         <a href="update.php" class="inline-btn">update profile</a>
      </div>

      <div class="box-container">

         <div class="box">
            <div class="flex">
               <i class="fas fa-bookmark"></i>
               <div>
                  <h3><?= $total_bookmarked; ?></h3>
                  <span>saved playlists</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view playlists</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <h3><?= $total_likes; ?></h3>
                  <span>liked tutorials</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view liked</a>
         </div>

         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <h3><?= $total_comments; ?></h3>
                  <span>video comments</span>
               </div>
            </div>
            <a href="#" class="inline-btn">view comments</a>
         </div>

      </div>

   </div>

</section>

<!-- profile section ends -->

<!-- footer section starts  -->

<footer class="footer">
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
         <a href="https://github.com/your-profile" target="_blank">
            <i class="fab fa-github"></i>
         </a>
         <a href="https://linkedin.com/in/your-profile" target="_blank">
            <i class="fab fa-linkedin-in"></i>
         </a>
         <a href="https://youtube.com/your-channel" target="_blank">
            <i class="fab fa-youtube"></i>
         </a>
         <a href="https://twitter.com/your-profile" target="_blank">
            <i class="fab fa-twitter"></i>
         </a>
      </div>

   </footer>

</body>
</html>

</footer>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script>
   window.addEventListener('scroll', function() {
      const footer = document.querySelector('.footer');
      if (window.scrollY > 0) {
         footer.classList.add('scrolled');
      } else {
         footer.classList.remove('scrolled');
      }
   });
</script>
   
</body>
</html>