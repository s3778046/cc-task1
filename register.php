<?php 
include("includes/header.php");
include("./tools/datastore.php");
include("./tools/cloudStorage.php");


$registerError ="";

//  ======= Validate and store all user input data to datastore================================
if(isset($_POST['submit'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userImage = $_FILES['file'];

    $validateID = entityIsUnique('user', 'id', $id);
    $validateUsername = entityIsUnique('user', 'user_name', $username);

    if(($validateID || $validateUsername)) {
        // Check datastore to see if entered ID is unique.
        if($validateID) {
            $registerError = $registerError . " *The ID already exists ";
        }

        // Check datastore to see if entered ID is unique.
        if($validateUsername) {
          $registerError = $registerError . " *The Username already exists ";
        }
    } else {

      // add new user to datastore
      addNewUser($id, $username, $password);

      if($userImage != null) {
          //  Upload image to cloud storage
          uploadImage('s3778046-user-profile-images', $id, $_FILES['file']['tmp_name']);
      }
      

      ?><script>window.location.replace("login.php");</script><?php
    }
} // End of POST check

?>

  <main class="register-container">
    <h2>Register</h2>
    <form class="form" id="register-form" method="POST" action="register.php" enctype="multipart/form-data">
      <div >
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="Type your ID" required>
      </div>
      <div>
        <label for="username">Username</label>
        
        <input type="text" name="username" placeholder="Type your username" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Type your Password" required></input>
      </div>
      <div>
        <label for="file">User Image</label>
        <input type="file" name="file" required>
      </div>
      <p class="error-message"><?php echo $registerError ?></p>
      <div>
        <button type="submit" name="submit">Register</button>
      </div>
    </form>
  </main>

<?php include("includes/footer.php") ?>