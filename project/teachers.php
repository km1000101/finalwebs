<?php

include 'components/connect.php';

session_start();

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>teachers</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      body {
         background-color: #f0f0f0; /* Fallback color */
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
      }
      @keyframes fade-slide-up {
         to {
            opacity: 1;
            transform: translateY(0);
         }
      }
      .box {
         transition: transform 0.3s, box-shadow 0.3s;
         background-color: rgba(63, 62, 62, 0.5)!important; /* Ensure the box is transparent */
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
      footer {
         transition: bottom 0.5s ease-in-out; /* Smoother transition for footer */
      }
   </style>

</head>
<body>

<div class="background-image"></div>

<div class="content">
<?php include 'components/user_header.php'; ?>

<!-- teachers section starts  -->

<section class="teachers">

   <h1 class="heading">expert tutors</h1>

   <form action="search_tutor.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container">

      <div class="box offer">
         <h3>Teachers login</h3>
         <p>Login with the userID and password provided by the department.</p>
         <a href="admin/register.php" class="inline-btn">get started</a>
      </div>

      <?php
         $select_tutors = $conn->prepare("SELECT * FROM `tutors`");
         $select_tutors->execute();
         if($select_tutors->rowCount() > 0){
            while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){

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
      ?>
      <div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_tutor['profession']; ?></span>
            </div>
         </div>
         <p>playlists : <span><?= $total_playlists; ?></span></p>
         <p>total videos : <span><?= $total_contents ?></span></p>
         <p>total likes : <span><?= $total_likes ?></span></p>
         <p>total comments : <span><?= $total_comments ?></span></p>
         <form action="tutor_profile.php" method="post">
            <input type="hidden" name="tutor_email" value="<?= $fetch_tutor['email']; ?>">
            <input type="submit" value="view profile" name="tutor_fetch" class="inline-btn">
         </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no tutors found!</p>';
         }
      ?>

   </div>

</section>

<!-- teachers section ends -->

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