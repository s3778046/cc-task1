<?php include("includes/header.php");
include("./tools/datastore.php");
include("./tools/cloudStorage.php");

if (isset($_SESSION["id"])) {
    $loggenOnUser = $_SESSION["id"];  
     // Get current user from datastore using user id.
     $currentUser = getUser($loggenOnUser);

     //  Store result into variable.
    foreach ($currentUser as $index => $userData) {
        $currentUserName = $userData['user_name'];
    } 

    // Create dynamic image string to display correct image.
    $imageUrl = "https://storage.cloud.google.com/s3778046-user-profile-images/" . $loggenOnUser . ".jpg";
?>
    <!-- Sign out in button -->
    <a href="logout.php"><button class="user-btn">Sign Out</button></a>

    <!-- Display all user information -->
    <section class="user-area">
        <img src="<?php echo $imageUrl ?>" alt="User Image">
        <a class="user-link" href="user.php"> <?php echo $currentUserName;  ?> </a>      
    </section>

<?php
} else {

    ?><h1><?php echo "Not logged in"; ?></h1><?php
    
} ?>



    <main class="forum-container">
     
    </main>

<?php include("includes/footer.php") ?>