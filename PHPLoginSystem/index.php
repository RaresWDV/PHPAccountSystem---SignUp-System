<?php
   require_once('functions/errorHandler.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign UP</title>
</head>

<!-- Link to CSS -->
<link rel="stylesheet" href="style/main.css">

<body>

<form action="includes/signup.inc.php" method="post">
     <div class="title">
          Sign UP by RaresWDV
     </div>
     <?php
      if(isset($_GET['error'])) {
          echo "<div class='error'>";
            errorHandler($_GET['error']);
          echo "</div>";
      }
     ?>
     <div>
          <input type="text" name='firstname' placeholder='First Name'>
          <input type="text" name='lastname' placeholder='Last Name'>
     </div>

     <input type="text" name='username' placeholder='Username'>

     <input type="text" name='email' placeholder='Email'>

     <input type="password" name='pwd' placeholder='Password'>

     <input type="text" name='pwdr' placeholder='Password Repeat'>

     <button name='submit'>Sign Up</button>
</form>

</body>

</html>