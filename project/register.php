<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'Email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
         }
      }
   }

}

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
   </style>

</head>
<body>

<div class="background-image"></div>

<div class="content">
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Create Account</h3>
      <div class="flex">
         <div class="col">
            <p>Your Name <span>*</span></p>
            <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
            <p>Your Email <span>*</span></p>
            <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
         </div>
         <div class="col">
            <p>Your Password <span>*</span></p>
            <input type="password" name="pass" placeholder="Enter your password" maxlength="50" required class="box">
            <p>Confirm Password <span>*</span></p>
            <input type="password" name="cpass" placeholder="Confirm your password" maxlength="50" required class="box">
         </div>
      </div>
      <p>Select Pic <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">Already have an account? <a href="login.php">Login now</a></p>
      <input type="submit" name="submit" value="Register now" class="btn">
   </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</div>
</body>
</html>