<?php include("includes/header.php"); ?>
<?php include("./tools/datastore.php"); ?>

<?php

    //  Declare login error variable.
    $loginError = "";

    // Check if post isset, validate the entered details.
    if (isset($_POST['submit'])) {

        $validCredentials = authLogin($_POST['id'], $_POST['password']);

        if($validCredentials) {

            // Store entered id as session id. 
            $_SESSION['id'] = $_POST['id'];

            // Javascript to direct user to forum page.
            ?><script>window.location.replace("forum.php");</script><?php
        } else {

            // Change login eroor variable to login error message.
            $loginError = '*ID or password is invalid';
        }
    }
?>

<!-- HTML content -->
  <main class="login-container">
    <h2 class="">Login</h2>

    <!-- User login form  -->
    <form class="form" id="login-form" method="POST" action="login.php">
      <div>
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="Type your ID" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="text" name="password" placeholder="Type your Password" required></input>
      </div>
      <p class="error-message"><?php echo $loginError ?></p>
      <div>
        <button type="submit" name="submit">Login</button>
      </div>
      <a class="register-link" href="register.php">Register</a>
    </form>
  </main>

<?php include("includes/footer.php") ?>