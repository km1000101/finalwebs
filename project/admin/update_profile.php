<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['update'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `tutors` SET name = ?, profession = ? WHERE id = ?");
   $update_profile->execute([$name, $profession, $tutor_id]);

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename_image = unique_id().'.'.$image_ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename_image;

   if(!empty($image)){
      if($image_size > 50000000){ // Increase limit to 50MB
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `tutors` SET image = ? WHERE id = ?");
         $update_image->execute([$rename_image, $tutor_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($old_image != '' && file_exists('../uploaded_files/'.$old_image)){
            unlink('../uploaded_files/'.$old_image);
         }
         $message[] = 'profile updated successfully!';
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
   <title>Update Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <input type="hidden" name="old_image" value="<?= $fetch_tutor['image']; ?>">
      <input type="text" name="name" placeholder="enter your name" required class="box" value="<?= $fetch_tutor['name']; ?>">
      <input type="text" name="profession" placeholder="enter your profession" required class="box" value="<?= $fetch_tutor['profession']; ?>">
      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" value="update now" name="update" class="btn">
   </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
