<?php

    include 'config.php';

    session_start();

    if(isset($_POST['Submit'])){
        
        
         $email = $_POST['email'];
        $email = filter_var($email,FILTER_SANITIZE_STRING);
         $pass = md5($_POST['pass']);
        $pass = filter_var($pass,FILTER_SANITIZE_STRING);

        

        
        

        $select = $conn->prepare("SELECT * FROM users WHERE email = ? AND PASSWORD = ?");

        $select->execute([$email, $pass]);
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if($select->rowCount() > 0){
         
            if($row['user_type'] == 'admin'){

                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');
            
            }elseif($row['user_type'] == 'user'){

                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            }else{
                $message[]   = 'no user found!';
            }

        } else{
            $message[] = 'incorrect email or password!';
        }


    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    

    <link rel="stylesheet" href="components.css">

</head>
<body class="login-page">


   

    <?php
    
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
       <span>'.$message.'</span>
       <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>';
    }
    }

    
    ?>

    <section class="form-container">

    <form action="" enctype="multipart/form-data" method="POST">
        <h3>login now</h3>
        
        <input type="email" name="email" class="box" placeholder="Enter your email" required>
        <input type="password" name="pass" class="box" placeholder="Enter your password" required>
        <input type="submit" value="login now" class="btn" name="Submit">
        <p>Don't have an account? <a href="register.php">register now</a></p>


</form>

    </section>


    
</body>
</html>