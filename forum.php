<?php include("includes/header.php");
include("./tools/datastore.php");
include("./tools/cloudStorage.php");

// Check if session variables have been set, if true, display current user data.
if (isset($_SESSION["id"])) {

    // Declare variables.
    $currentUserName = "";
    $loggenOnUser = $_SESSION["id"];

    // Get current user from datastore using user id.
    $currentUser = getUser($loggenOnUser);

    //  Store result into variable.
    foreach ($currentUser as $index => $userData) {
        $currentUserName = $userData['user_name'];
    } 
    
    // Create dynamic image string to display correct image.
    $imageUrl = "https://storage.cloud.google.com/s3778046-user-profile-images/" . $loggenOnUser . ".jpg";





    //  ======= Validate and store all user input data to datastore================================
    if(isset($_POST['submit'])) {

        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $postImage = $_FILES['file'];



        // add new user to datastore
        addNewPost($subject, $message, $loggenOnUser);

        if($postImage != null) {
            //  Upload image to cloud storage
            uploadImage('s3778046-post-images', $loggenOnUser, $_FILES['file']['tmp_name']);
        } 
    }
?>








    <!-- Main content for forum page -->
    <main class="forum-container">

    <!-- Sign out in button -->
    <a class="user-btn" href="logout.php">Sign Out</a>

    <!-- Display all user information -->
    <section class="user-area">
        <img src="<?php echo $imageUrl ?>" alt="User Image">
        <a class="user-link" href="user.php"> <?php echo $currentUserName  ?> </a>      
    </section>

    
    <!-- Form for posting messages -->
    <section class="message-posting">
        <form class="flex-center-column" id="post-form" method="POST" action="forum.php" enctype="multipart/form-data">
            <div >
                <label for="subject">Subject</label>
                <input type="text" name="subject" placeholder="Type your subject" required>
            </div>

            <div>
                <label for="message">Message Text</label>
                <input type="text" name="message" placeholder="Type your message" required>
            </div>

            <div>
                <label for="file">Image</label>
                <input type="file" name="file" id="file" required>
            </div>
            <div>
                <button class="button" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </section>
  
       


        <!-- Display last 10 posts -->
        <section class="message-display">
            <h1>Last 10 messages</h1>
            

            <?php
            
                $allPosts = getAllPosts('post');
                foreach ($allPosts as $index => $post) {
                   ?> <div class="post"> <?php
                    $postImg = getImage('s3778046-post-images', $post['userid']); 
                    $userImg = getImage('s3778046-user-profile-images', $post['userid']); ?>

                <div class="user-data">
                    <div class="flex">
                        <img class="user-img" src="<?php echo $userImg ?>" alt="User Image">
                        <h6>Mark McLachlan</h6>
                    </div>

                    <p><?php echo $post['date'] . " " . $post['time'] ?></p>
                </div>
                <h4><?php echo $post['subject'] ?></h4>
                <p><?php echo $post['message'] ?></p>
                <img class="post-img" src="<?php echo $postImg ?>" alt="Post Image">   
                </div>
            <?php } ?>
            
        </section>   
    </main>
  <?php  
} else {
    echo "Not logged in";
} ?>
<?php include("includes/footer.php") ?>

<!-- <?php
 //       $allPosts = getAllPosts('post');
 //       foreach ($allPosts as $index => $post) {
//
  //          $postImg = getImage('s3778046-post-images', $post['userid']);
   //        ?> <img src="<?php //echo $postImg ?>" alt="User Image"> <?php
   //        printf('aaaaaaaaa: %s', $post['id']);
   //         printf('Date: %s', $post['date']);
   //         printf(', Time: %s', $post['time']);
   //         printf(', Subject: %s', $post['subject']);
   //         printf(', Message: %s', $post['message']);
      //      ?><br><br><br><?php
    //   }
?> -->