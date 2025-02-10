<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // Define multiple restricted email, ID, and password combinations
   $restricted_users = [
      ['email' => 'hemanth@gmail.com', 'password' => sha1('caits001')],
      ['email' => 'victor@gmail.com', 'password' => sha1('caits002')],
      ['email' => 'navya@gmail.com', 'password' => sha1('caits003')],
      ['email' => 'vinayashree@gmail.com', 'password' => sha1('caits004')],
      ['email' => 'shashank@gmail.com', 'password' => sha1('caits005')],
      ['email' => 'charlie@gmail.com', 'password' => sha1('caits006')],
      ['email' => 'david@gmail.com', 'password' => sha1('caits007')],
      ['email' => 'eve@gmail.com', 'password' => sha1('caits008')],
      ['email' => 'frank@gmail.com', 'password' => sha1('caits009')],
      ['email' => 'grace@gmail.com', 'password' => sha1('caits010')]
   ];

   $is_valid_user = false;

   foreach ($restricted_users as $user) {
      if ($email === $user['email'] && $pass === $user['password']) {
         $is_valid_user = true;
         break;
      }
   }

   if($is_valid_user){
      $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? AND password = ? LIMIT 1");
      $select_tutor->execute([$email, $pass]);
      $row = $select_tutor->fetch(PDO::FETCH_ASSOC);
      
      if($select_tutor->rowCount() > 0){
         setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
         header('location:dashboard.php');
      }else{
         $message[] = 'incorrect email or password!';
      }
   } else {
      $message[] = 'incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      body {
         background-color: #f0f0f0; /* Fallback color */
      }
      .background-image {
         position: fixed;
         top: 0; /* Adjust according to header height */
         bottom: 0; /* Adjust according to footer height */
         left: 0;
         right: 0;
         background-image: url('../images/bg_img2.jpg'); /* Add background image */
         background-size: cover;
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
      .btn-small {
         color: orange;
         font-size: 3.5rem; /* Make the button a bit bigger */
         text-decoration: none;
         margin-right: 10px;
         vertical-align: middle; /* Align with text */
      }
      .btn-small:hover {
         color: darkorange;
      }
      .form-container h3 {
         display: inline-block;
         margin-left: 10px;
         vertical-align: middle; /* Align with button */
      }
      .form-container .header {
         display: flex;
         justify-content: center; /* Center the header */
         align-items: center;
         position: relative;
      }
      .form-container .header .btn-small {
         position: absolute;
         left: 0;
      }
   </style>

</head>
<body style="padding-left: 0;">

<div class="background-image"></div>

<div class="content">
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- register section starts  -->

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <div class="header">
         <!-- Add small home button with arrow symbol to the left side of the welcome back text -->
         <a href="../home.php" class="btn-small">&larr;</a><h3>welcome back!</h3>
      </div>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">
      <p class="link">don't have an account? <a href="register.php">register new</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>

<!-- registe section ends -->

<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () => {
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () => {
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</div>
</body>
</html>