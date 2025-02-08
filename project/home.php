<?php

// Include database connection file
include 'components/connect.php';

// Start session
session_start();

// Check if user_id is set in cookies
if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

// Fetch total likes for the user
$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

// Fetch total comments for the user
$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

// Fetch total bookmarks for the user
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
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Custom styles for dark mode and animations */
      body {
         background-color: #121212; /* Dark background color */
         color: #ffffff; /* Light text color */
      }
      .background-image {
         position: fixed;
         top: 60px; /* Adjust according to header height */
         bottom: 60px; /* Adjust according to footer height */
         left: 0;
         right: 0;
         background-image: url('images/bg_img2.jpg'); /* Add background image */
         background-size: auto;
         background-position: center;
         background-repeat: no-repeat;
         z-index: -1;
      }
      .content {
         position: relative;
         z-index: 1;
      }
      .box a:hover i {
         color: #1E90FF; /* Custom color */
      }
      .heading span {
         color: orange; /* Change intelligence text color to orange */
      }
      .heading {
         opacity: 0;
         transform: translateY(50px);
         animation: fade-slide-up 1s forwards;
         color: #ffffff; /* Change heading color to white */
      }
      @keyframes fade-slide-up {
         to {
            opacity: 1;
            transform: translateY(0);
         }
         
      }
      .box {
         transition: transform 0.3s, box-shadow 0.3s;
         background-color: rgba(63, 62, 62, 0.5) !important; /* Ensure the box is more transparent */
         color: #ffffff; /* Change box text color to white */
      }
      .box:hover {
         transform: translateY(-10px);
         box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      }
      .box img.thumb {
         transition: transform 0.3s;
      }
      .box img.thumb:hover {
         transform: scale(1.05);
      }
      .courses .heading {
         font-size: 4rem; /* Reduced font size */
      }
      .footer a i {
         transition: transform 0.3s;
      }
      .footer a:hover i {
         transform: scale(1.2);
      }
      footer {
         background-color:rgba(33, 31, 31, 1); /* Make the footer less transparent */
         color: #ffffff; /* Light text color */
         padding: 20px;
         text-align: center;
         transition: bottom 0.5s ease-in-out; /* Smoother transition for footer */
      }
   </style>

</head>
<body>

<div class="background-image"></div>

<div class="content">
<?php include 'components/user_header.php'; ?>

<!-- quick select section starts  -->

<section class="quick-select">

   <h1 class="heading">Department of Computer Science & Artificial <span>Intelligence</span></h1>

   <div class="box-container">

      <?php
         // Check if user is logged in
         if($user_id != ''){
      ?>
      <div class="box">
         <h3 class="title">Likes and Comments</h3>
         <p>Total Likes : <span><?= $total_likes; ?></span></p>
         <a href="likes.php" class="inline-btn">View Likes</a>
         <p>Total Comments : <span><?= $total_comments; ?></span></p>
         <a href="comments.php" class="inline-btn">View Comments</a>
         <p>Saved Playlist : <span><?= $total_bookmarked; ?></span></p>
         <a href="bookmark.php" class="inline-btn">View Bookmark</a>
      </div>
      <?php
         }else{ 
      ?>
      <div class="box" style="text-align: center;">
         <h3 class="title">Please Login or Register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">Login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div>
      </div>
      <?php
      }
      ?>

      <div class="box">
         <h3 class="title">Top Categories</h3>
         <div class="flex">
            <a href="#" class="category-btn"><i class="fas fa-code"></i><span>Development</span></a>
            <a href="#" class="category-btn"><i class="fas fa-chart-simple"></i><span>Business</span></a>
            <a href="#" class="category-btn"><i class="fas fa-pen"></i><span>Design</span></a>
            <a href="#" class="category-btn"><i class="fas fa-chart-line"></i><span>Marketing</span></a>
            <a href="#" class="category-btn"><i class="fas fa-music"></i><span>Music</span></a>
            <a href="#" class="category-btn"><i class="fas fa-camera"></i><span>Photography</span></a>
            <a href="#" class="category-btn"><i class="fas fa-cog"></i><span>Software</span></a>
            <a href="#" class="category-btn"><i class="fas fa-vial"></i><span>Science</span></a>
         </div>
      </div>

      <div class="box">
         <h3 class="title">Popular Topics</h3>
         <div class="flex">
            <a href="#" class="topic-btn"><i class="fab fa-html5"></i><span>HTML</span></a>
            <a href="#" class="topic-btn"><i class="fab fa-css3"></i><span>CSS</span></a>
            <a href="#" class="topic-btn"><i class="fab fa-js"></i><span>Javascript</span></a>
            <a href="#" class="topic-btn"><i class="fab fa-react"></i><span>react</span></a>
            <a href="#" class="topic-btn"><i class="fab fa-php"></i><span>PHP</span></a>
            <a href="#" class="topic-btn"><i class="fab fa-bootstrap"></i><span>Bootstrap</span></a>
         </div>
      </div>

      <div class="box tutor">
         <h3 class="title">Teachers Login</h3>
         <hr>
         <p>Login with the userID and password provided by the department.</p>
         <hr>
         <a href="admin/register.php" class="inline-btn tutor-login-btn">Get Started</a>
      </div>

   </div>

</section>

<!-- quick select section ends -->

<!-- courses section starts  -->

<section class="courses">

   <h1 class="heading">Latest Courses</h1>

   <div class="box-container">   

      <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
         $select_courses->execute(['active']);
         if($select_courses->rowCount() > 0){
            while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
               $course_id = $fetch_course['id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutor->execute([$fetch_course['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_course['date']; ?></span>
            </div>
         </div>
         <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fetch_course['title']; ?></h3>
         <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">View Playlist</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no courses added yet!</p>';
      }
      ?>

   </div>

   <div class="more-btn">
      <a href="courses.php" class="inline-option-btn view-more-btn">View More</a>
   </div>

</section>

<!-- courses section ends -->

<script>
document.addEventListener('DOMContentLoaded', function() {
   const userId = '<?= $user_id; ?>';
   const buttons = document.querySelectorAll('.inline-btn, .option-btn, .view-more-btn, .nav-btn, .category-btn, .topic-btn');
   const header = document.querySelector('header');
   const footer = document.querySelector('footer');
   let lastScrollTop = 0;

   buttons.forEach(button => {
      button.addEventListener('click', function(event) {
         if (!userId && !button.classList.contains('tutor-login-btn') && !button.classList.contains('home-btn')) {
            event.preventDefault();
            alert('Please log in to continue.');
            window.location.href = 'login.php';
         }
      });
   });

   window.addEventListener('scroll', function() {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop) {
         footer.style.bottom = '-60px'; // Adjust according to footer height
      } else {
         footer.style.bottom = '0';
      }
      lastScrollTop = scrollTop;
   });
});
</script>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
</div>
</body>
</html>