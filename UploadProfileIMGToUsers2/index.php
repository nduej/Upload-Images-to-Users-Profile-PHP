<?php
    session_start();
    include_once 'dbh.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Upload Images to Users PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
       $sql = "SELECT * FROM user";
       $result = mysqli_query($conn, $sql);
       if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $sqlImg = "SELECT * FROM profileimg WHERE  userid='id'";
                $resultImg = mysqli_query($conn, $sqlImg);
                while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                    echo "<div class='user-container'>";
                           if ($rowImg ['status'] == 0) {
                              echo "<img src='uploads/profile".$id.".jpg?".mt_rand()."'>";
                           } else {
                                echo "<img src='uploads/default-profile.jpg'>";
                           }
                           echo "<p>".$row['username']."</p>";
                           echo "</div>";
                }
               }
       } else {
        echo "There are no users yet!";
       }

       if (isset($_SESSION['id'])) {
                 if ($_SESSION['id'] == 1) {
                    echo "You are logged in as user #1";
                 }

                 echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>
                       <input type='file' name='file'>
                       <button type='submit' name='submit'>UPLOAD</button>
                       </form>";
       } else {
               echo "You are not logged in!";
               echo "<form action='signup.php' method='POST'>
                     <input type='text' name='first' placeholder='First Name'>
                     <input type='text' name='last' placeholder='Last Name'>
                     <input type='text' name='uid' placeholder='Username'>
                     <input type='password' name='pwd' placeholder='Password'>
                     <button type='submit' name='submitSignup'>Signup</button>
                     
                     </form>";
       }
    ?>

    <p>Login as User!</p>
    <form action="login.php" method="POST">
        <button type="submit" name="submitLogin">Login</button>
    </form>

    <p>Logout as user!</p>
    <form action="logout.php" method="POST">
        <button type="submit" name="submitLogout">Logout</button>
    </form>
</body>
</html>