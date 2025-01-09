<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);
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
   $image_folder = '../uploaded_files/'.$rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);
   
   if($select_tutor->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
         $insert_tutor->execute([$id, $name, $profession, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $verify_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? AND password = ? LIMIT 1");
         $verify_tutor->execute([$email, $pass]);
         $row = $verify_tutor->fetch(PDO::FETCH_ASSOC);
         
         if($verify_tutor->rowCount() > 0){
            setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:dashboard.php');
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
   <title>tutor register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      body {
         background: url('../images/bg_img2.jpg') no-repeat center center fixed;
         background-size: cover;
      }
      .register {
         padding: 20px;
      }
      .box-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         justify-content: center;
      }
      .box {
         background-color: transparent;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         padding: 20px;
         transition: transform 0.3s, box-shadow 0.3s;
      }
      .box:hover {
         transform: translateY(-10px);
         box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      }
      .thumb {
         border-radius: 10px;
         margin-bottom: 10px;
         transition: transform 0.3s;
      }
      .thumb:hover {
         transform: scale(1.05);
      }
      .title {
         font-size: 1.2rem;
         margin-bottom: 10px;
      }
      .flex {
         display: flex;
         justify-content: space-between;
         margin-bottom: 10px;
      }
      .flex-btn {
         display: flex;
         gap: 10px;
      }
      .btn, .option-btn, .delete-btn {
         padding: 10px 20px;
         border-radius: 5px;
         transition: background-color 0.3s;
      }
      .btn:hover, .option-btn:hover, .delete-btn:hover {
         background-color: #333;
         color: #fff;
      }
      .empty {
         text-align: center;
         font-size: 1.2rem;
         color: #666;
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
<body>

<?php include '../components/admin_header.php'; ?>

<section class="register">
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

      <form class="register" action="" method="post" enctype="multipart/form-data">
         <div class="header">
            <!-- Add small home button with arrow symbol to the left side of the register new text -->
            <a href="../home.php" class="btn-small">&larr;</a><h3>register new</h3>
         </div>
         <div class="flex">
            <div class="col">
               <p>your name <span>*</span></p>
               <input type="text" name="name" placeholder="eneter your name" maxlength="50" required class="box">
               <p>your profession <span>*</span></p>
               <select name="profession" class="box" required>
                  <option value="" disabled selected>-- select your profession</option>
                  <option value="developer">HOD</option>
                  <option value="desginer">professor</option>
                  <option value="musician">assistant professor</option>
                  
         
               </select>
               <p>your email <span>*</span></p>
               <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
            </div>
            <div class="col">
               <p>your password <span>*</span></p>
               <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
               <p>confirm password <span>*</span></p>
               <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
               <p>select pic <span>*</span></p>
               <input type="file" name="image" accept="image/*" required class="box">
            </div>
         </div>
         <p class="link">already have an account? <a href="login.php">login now</a></p>
         <input type="submit" name="submit" value="register now" class="btn">
      </form>

   </section>

   <!-- registe section ends -->

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>
      
   </div>
</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
   document.querySelectorAll('.register .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>