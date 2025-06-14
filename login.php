<?php
    session_start();
    if (isset($_POST['cancel']))
    {
      // Redirect the browser to index.php
      header("Location: index.php");
      return;
    }

    $salt = 'XyZzy12*_';
    $stored_hash = hash('md5', 'XyZzy12*_php123');;  // Password is php123
    $failure = false;

    if (isset($_POST['email']) && isset($_POST['pass']))
    {
        if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1)
        {
            $_SESSION['error'] = "User name and password are required";
        }
        else if (strpos($_POST['email'], "@") === false)
        {
            $_SESSION['error'] = "Email must have an at-sign (@)";
            header("Location: login.php");
            return;
        }
        else
        {
            $check = hash('md5', $salt . $_POST['pass']);
            if ($check == $stored_hash)
            {
                error_log("Login success ".$_POST['email']);
                $_SESSION['name'] = $_POST['email'];
                header("Location: view.php");
                return;
            }
            else
            {
                $_SESSION['error'] = "Incorrect password";
                error_log("Login fail ".$_POST['email']." $check");
                header("Location: login.php");
            }
        }
      }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Ambika Patidar's Login Page 86892ef7</title>
  <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>

    <?php
    if ( isset($_SESSION['error']) )
    {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>

    <form method="POST" action="login.php">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        For a password hint, view source and find a password hint
        in the HTML comments.
        <!-- Hint: The password is the four character sound a cat
        makes (all lower case) followed by 123. -->
    </p>
</div>
</body>
</html>
