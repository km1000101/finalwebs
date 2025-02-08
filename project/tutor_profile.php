<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['tutor_fetch'])){

   $tutor_email = $_POST['tutor_email'];
   $tutor_email = filter_var($tutor_email, FILTER_SANITIZE_STRING);
   $select_tutor = $conn->prepare('SELECT * FROM `tutors` WHERE email = ?');
   $select_tutor->execute([$tutor_email]);

   $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
   $tutor_id = $fetch_tutor['id'];

   $count_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
   $count_playlists->execute([$tutor_id]);
   $total_playlists = $count_playlists->rowCount();

   $count_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
   $count_contents->execute([$tutor_id]);
   $total_contents = $count_contents->rowCount();

   $count_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
   $count_likes->execute([$tutor_id]);
   $total_likes = $count_likes->rowCount();

   $count_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
   $count_comments->execute([$tutor_id]);
   $total_comments = $count_comments->rowCount();

}else{
   header('location:teachers.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tutor's Profile</title>

   <!-- Font Awesome Cdn Link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom Css File Link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      body {
         background-color: #f0f0f0; /* Fallback Color */
      }
      .background-image {
         position: fixed;
         top: 0; /* Adjust To Fit The Whole Screen */
         bottom: 0; /* Adjust To Fit The Whole Screen */
         left: 0;
         right: 0;
         background-image: url('images/bg_img2.jpg'); /* Add Background Image */
         background-size: cover; /* Ensure The Image Covers The Whole Screen */
         background-position: center;
         background-repeat: no-repeat;
         z-index: -1;
      }
      .content {
         position: relative;
         z-index: 1;
      }
      .box a:hover i {
         color: #1E90FF; /* Custom Color */
      }
      .heading span {
         color: orange; /* Change Intelligence Text Color To Orange */
      }
      .heading {
         opacity: 0;
         transform: translateY(50px);
         animation: fade-slide-up 1s forwards;
         font-size: 4rem; /* Reduced Font Size */
      }
      @keyframes fade-slide-up {
         to {
            opacity: 1;
            transform: translateY(0);
         }
      }
      .box {
         transition: transform 0.3s, box-shadow 0.3s;
         background-color: rgba(255, 255, 255, 0.8)!important; /* Change To Light Color */
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
         font-size: 4rem; /* Reduced Font Size */
      }
      footer {
         transition: bottom 0.5s ease-in-out; /* Smoother Transition For Footer */
      }
      .empty {
         color: white; /* Change Text Color To White */
      }
    
      .details {
         background-color: rgba(255, 255, 255, 0.12)!important; /* Make The Whole Box Transparent */
      }
      .details .flex p {
         background-color: rgba(43, 40, 40, 0.99)!important; /* Ensure No Transparency */
         padding: 10px;
         border-radius: 5px;
      }
   </style>

</head>
<body>

<div class="background-image"></div>

<div class="content">
<?php include 'components/user_header.php'; ?>

<!-- Teachers Profile Section Starts  -->

<section class="tutor-profile">

   <h1 class="heading">Profile Details</h1>

   <div class="details">
      <div class="tutor">
         <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
         <h3><?= $fetch_tutor['name']; ?></h3>
         <span><?= $fetch_tutor['profession']; ?></span>
      </div>
      <div class="flex">
         <p>Total Playlists : <span><?= $total_playlists; ?></span></p>
         <p>Total Videos : <span><?= $total_contents; ?></span></p>
         <p>Total Likes : <span><?= $total_likes; ?></span></p>
         <p>Total Comments : <span><?= $total_comments; ?></span></p>
      </div>
   </div>

</section>

<!-- Teachers Profile Section Ends -->

<section class="courses">

   <h1 class="heading">Latest Courses</h1>

   <div class="box-container">

      <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ? AND status = ?");
         $select_courses->execute([$tutor_id, 'active']);
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
         echo '<p class="empty">No Courses Added Yet!</p>';
      }
      ?>

   </div>

</section>

<!-- Courses Section Ends -->

<script>
document.addEventListener('DOMContentLoaded', function() {
   const userId = '<?= $user_id; ?>';
   const buttons = document.querySelectorAll('.inline-btn, .option-btn, .view-more-btn, .nav-btn, .category-btn, .topic-btn');
   const footer = document.querySelector('footer');
   let lastScrollTop = 0;

   buttons.forEach(button => {
      button.addEventListener('click', function(event) {
         if (!userId && !button.classList.contains('tutor-login-btn') && !button.classList.contains('home-btn')) {
            event.preventDefault();
            alert('Please Log In To Continue.');
            window.location.href = 'login.php';
         }
      });
   });

   window.addEventListener('scroll', function() {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop) {
         footer.style.bottom = '-60px'; // Adjust According To Footer Height
      } else {
         footer.style.bottom = '0';
      }
      lastScrollTop = scrollTop;
   });
});
</script>

<!-- Footer Section Starts  -->
<?php include 'components/footer.php'; ?>
<!-- Footer Section Ends -->

<!-- Custom Js File Link  -->
<script src="js/script.js"></script>
</div>
</body>
</html>