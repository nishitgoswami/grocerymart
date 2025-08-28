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


<header class="header">

<div class="flex">

<a href="admin_page.php" class="logo"><img src="logo1.png" class="logo" alt=""></a>

<nav class="navbar">
    <a href="admin_page.php">Home</a>
    <a href="admin_products.php">products</a>
     <a href="admin_Orders.php">Orders</a>
      <a href="admin_Users.php">Users</a>
       <a href="admin_contacts.php">contacts</a>
</nav>

<div class="icons">
    <div id="menu-btn" class="fas fa-bars"></div>
    <div id="user-btn" class="fas fa-user"></div>
</div>

<div class="profile">
    <?php 
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$admin_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>

    <p><?= $fetch_profile['name']; ?></p>
    <a href="admin_update_profile.php" class="btn">Upadate Profile</a>
    <a href="logout.php" class="delete-btn">Logout</a>

    <div class="flex-btn">

    
    <a href="login.php" class="option-btn">Login</a>
    <a href="register.php" class="option-btn">Register</a>
    </div>




</div>


</div>
</header>