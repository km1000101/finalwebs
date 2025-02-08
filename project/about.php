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
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about us</title>

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
      .reviews .box p {
         color: white; /* Change review text color to white */
         font-size: 1.2rem; /* Change font size of review text */
      }
      footer {
         transition: bottom 0.5s ease-in-out; /* Smoother transition for footer */
      }
      .mission {
         color: white; /* Change text color to white */
      }
      .mission .highlight {
         color: orange; /* Change highlighted text color to orange */
      }
   </style>

</head>
<body>

<div class="background-image"></div>

<div class="content">
<?php include 'components/user_header.php'; ?>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image slideshow-container">
         <div class="mySlides fade">
            <img src="images/dept.jpg" style="width:70%; border-radius: 15px;">
         </div>
         <div class="mySlides fade">
            <img src="images/hod.jpg" style="width:70%; border-radius: 15px;">
         </div>
         <div class="mySlides fade">
            <img src="images/hod2.jpg" style="width:70%; border-radius: 15px;">
         </div>
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <div class="mission">
            <p style="font-size: 3rem;">The <span class="highlight">vision</span> of the Department of CSE (AI) is to:</p>
            <ul>
               <li>Provide students with a strong foundation in AI fundamentals, equipping them with the knowledge and skills to thrive in the field.</li>
               <li>Foster a collaborative learning environment that encourages innovation and critical thinking.</li>
               <li>Prepare students for future careers in AI-related industries through practical applications and real-world projects.</li>
            </ul>
         </div>
         <div style="text-align: center;">
            <a href="courses.php" class="inline-btn">Our Courses</a>
         </div>
      </div>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-graduation-cap"></i>
         <div>
            <h3 class="running-number" data-target="1000">0</h3>
            <span>Online Courses</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-user-graduate"></i>
         <div>
            <h3 class="running-number" data-target="500">0</h3>
            <span>Brilliants Students</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-chalkboard-user"></i>
         <div>
            <h3 class="running-number" data-target="10">0</h3>
            <span>Expert Teachers</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-briefcase"></i>
         <div>
            <h3 class="running-number" data-target="0">0%</h3>
            <span>Job Placement</span>
         </div>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="heading">Student's Reviews</h1>

   <div class="box-container">

      <div class="box">
         <p>"Great hands-on labs and projects that really prepare you for real-world scenarios.
             We get to work on cutting-edge technology and tools, which gives us a competitive edge when applying for jobs."</p>
         <div class="user">
            <img src="images/pic-2.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="box">
         <p>"I appreciate the supportive and collaborative environment among students and faculty.
             It's easy to reach out for help, and everyone is willing to share their knowledge and experiences."</p>
         <div class="user">
            <img src="images/pic-3.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="box">
         <p> "The department has a strong focus on both theoretical knowledge and practical skills.
             The balance between the two ensures that we are well-rounded professionals who can tackle any challenge.</p>
         <div class="user">
            <img src="images/pic-4.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="box">
         <p>"The department organizes regular workshops and guest lectures from industry experts.
             These events provide invaluable insights into the latest developments and trends in computer science and AI."</p>
         <div class="user">
            <img src="images/pic-5.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="box">
         <p>"The library and online resources are fantastic for research and study. 
            I have access to a vast collection of books, journals, and databases that support my learning and academic growth."</p>
         <div class="user">
            <img src="images/pic-6.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="box">
         <p>"The curriculum is up-to-date with the latest industry trends, especially in AI and machine learning.
             I appreciate that we're learning the skills that employers are looking for, making us job-ready."</p>
         <div class="user">
            <img src="images/pic-7.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

   </div>

</section>

<!-- reviews section ends -->

<script>
// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
   // Get the user ID from PHP
   const userId = '<?= $user_id; ?>';
   // Select all buttons that require user login
   const buttons = document.querySelectorAll('.inline-btn, .option-btn, .view-more-btn, .nav-btn, .category-btn, .topic-btn');
   const footer = document.querySelector('footer');
   let lastScrollTop = 0;

   // Add click event listener to each button
   buttons.forEach(button => {
      button.addEventListener('click', function(event) {
         // If user is not logged in and the button is not for tutor login or home, prevent default action and redirect to login page
         if (!userId && !button.classList.contains('tutor-login-btn') && !button.classList.contains('home-btn')) {
            event.preventDefault();
            alert('Please log in to continue.');
            window.location.href = 'login.php';
         }
      });
   });

   // Add scroll event listener to window
   window.addEventListener('scroll', function() {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      // Hide footer on scroll down, show footer on scroll up
      if (scrollTop > lastScrollTop) {
         footer.style.bottom = '-60px'; // Adjust according to footer height
      } else {
         footer.style.bottom = '0';
      }
      lastScrollTop = scrollTop;
   });
});
</script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/slideshow.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const runningNumbers = document.querySelectorAll('.running-number');

    const runNumbers = (number) => {
        const target = +number.getAttribute('data-target');
        const speed = 200; // Adjust the speed for smoother animation
        let count = 0;
        let increment = Math.ceil(target / speed);

        const updateCount = () => {
            count += increment;
            if (count < target) {
                number.innerText = count;
                requestAnimationFrame(updateCount);
            } else {
                number.innerText = target; // Ensure final value is exact
            }
        };

        updateCount();
    };

    const handleScroll = () => {
        runningNumbers.forEach(number => {
            const rect = number.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;

            if (isVisible && !number.dataset.animated) {
                number.dataset.animated = "true"; // Mark as animated
                number.innerText = "0"; // Reset number
                runNumbers(number);
            } else if (!isVisible) {
                number.dataset.animated = ""; // Reset animation trigger when out of view
            }
        });
    };

    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Run once on page load
});

</script>
   
</div>
</body>
</html>