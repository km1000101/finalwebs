<?php

include 'components/connect.php';

session_start();

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email']; 
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number']; 
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg']; 
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if($select_contact->rowCount() > 0){
      $message[] = 'message sent already!';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact us</title>

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
   </style>

</head>
<body>

<div class="background-image"></div>

<div class="content">
<?php include 'components/user_header.php'; ?>

<!-- contact section starts  -->

<section class="contact">

   <h1 class="heading">contact us</h1>

   <div class="row">

      <div class="image">
         <img src="images/hod.jpg" alt="">
      </div>

      <form action="" method="post">
         <h3>get in touch</h3>
         <input type="text" placeholder="enter your name" required maxlength="100" name="name" class="box">
         <input type="email" placeholder="enter your email" required maxlength="100" name="email" class="box">
         <input type="number" min="0" max="9999999999" placeholder="enter your number" required maxlength="10" name="number" class="box">
         <textarea name="msg" class="box" placeholder="enter your message" required cols="30" rows="10" maxlength="1000"></textarea>
         <input type="submit" value="send message" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <a href="tel:1234567890">123-456-7890</a>
         <a href="tel:1112223333">111-222-3333</a>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <a href="mailto:shaikhanas@gmail.com">shaikhanas@gmail.come</a>
         <a href="mailto:anasbhai@gmail.com">anasbhai@gmail.come</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>office address</h3>
         <a href="#">flat no. 1, a-1 building, jogeshwari, mumbai, india - 400104</a>
      </div>


   </div>

</section>

<!-- contact section ends -->

<script>
document.addEventListener('DOMContentLoaded', function() {
   const userId = '<?= $user_id; ?>';
   const buttons = document.querySelectorAll('.inline-btn, .option-btn, .view-more-btn, .nav-btn, .category-btn, .topic-btn');

   buttons.forEach(button => {
      button.addEventListener('click', function(event) {
         if (!userId && !button.classList.contains('tutor-login-btn') && !button.classList.contains('home-btn')) {
            event.preventDefault();
            alert('Please log in to continue.');
            window.location.href = 'login.php';
         }
      });
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