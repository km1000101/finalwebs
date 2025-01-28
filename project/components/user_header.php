<?php
// Check if there are any messages to display
if(isset($message)){
   foreach($message as $message){
      // Display each message in a div with a close button
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<style>
   /* Change color of icons on hover */
   .navbar a:hover i {
      color:rgb(4, 113, 197); /* Custom color */
   }
   /* Change color of search icon to orange */
   .icons .fa-search {
      color: orange;
   }
   .search-form .fa-search {
      color: orange;
   }
</style>

<header class="header">

   <section class="flex">

      <!-- Logo linking to home page -->
      <a href="home.php" class="logo"><img src="images/LOGO.jpg"></a>

      <!-- Search form for courses -->
      <form action="search_course.php" method="post" class="search-form">
         <input type="text" name="search_course" placeholder="search courses..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_course_btn"></button>
      </form>

      <!-- Icons for menu, search, user, and toggle -->
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun" style="display: none;"></div>
      </div>

      <!-- User profile section -->
      <div class="profile">
         <?php
            // Fetch user profile from database
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <!-- Display user profile information -->
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>student</span>
         <a href="profile.php" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
         <!-- Prompt user to login or register if not logged in -->
         <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            // Fetch user profile from database
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <!-- Display user profile information -->
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>student</span>
         <a href="profile.php" class="btn">view profile</a>
         <?php
            }else{
         ?>
         <!-- Prompt user to login or register if not logged in -->
         <h3>please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <!-- Navigation links -->
      <a href="home.php" class="nav-btn home-btn"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="about.php" class="nav-btn"><i class="fas fa-question"></i><span>About Us</span></a>
      <a href="courses.php" class="nav-btn"><i class="fas fa-graduation-cap"></i><span>Courses</span></a>
      <a href="teachers.php" class="nav-btn"><i class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
      <a href="contact.php" class="nav-btn"><i class="fas fa-headset"></i><span>Contact Us</span></a>
   </nav>

</div>

<!-- side bar section ends -->

<script>
// Hide toggle button on page load
document.addEventListener('DOMContentLoaded', function() {
   const toggleBtn = document.getElementById('toggle-btn');
   if (toggleBtn) {
      toggleBtn.style.display = 'none';
   }
});
</script>