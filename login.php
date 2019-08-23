<?php
  // Include db config
  require_once 'db.php';

  // Init vars
  $email = $password = '';
  $email_err = $password_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // Put post vars in regular vars
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email
    if(empty($email)){
      $email_err = 'Please enter email';
    }

    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    }

    // Make sure errors are empty
    if(empty($email_err) && empty($password_err)){
      // Prepare query
      $sql = 'SELECT name, email, password FROM users WHERE email = :email';

      // Prepare statement
      if($stmt = $pdo->prepare($sql)){
        // Bind params
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            if($row = $stmt->fetch()){
              $hashed_password = $row['password'];
              if(password_verify($password, $hashed_password)){
                // SUCCESSFUL LOGIN
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                header('location: index.php');
              } else {
                // Display wrong password message
                $password_err = 'The password you entered is not valid';
              }
            }
          } else {
            $email_err = 'No account found for that email';
          }
        } else {
          die('Something went wrong');
        }
      }
      // Close statement
      unset($stmt);
    }

    // Close connection
    unset($pdo);
  }
?>

<html>
    <head>
         <title>B-XSSRF - Swiss Knife</title>
    </head>
    
    <body>
<style>
body {
    background-color:#FCFCFC; /*#EFEFEF*/
    color: #000;
    font-family: monospace, courier;
    font-size: 12px;
    margin: 0px 0px;
}
table, th, td {
  border: 1px solid #555;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;    
}
a {color: red;} 

.button {
  background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 7px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
  margin: 0px 0px;
  cursor: pointer;
}

.button1 {border-radius: 2px;}

.footer {
    background-color: #555;
    color:#fff;
    margin-top: 10 px;
    padding-top: 10px;
    padding-bottom: 10px;
	position: absolute;
    left: 400 ; right: 400; bottom: 0;
    height:[footer-height]
    }
</style>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<center>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-signin">    
<?php echo $email_err; ?>
<?php echo $password_err; ?>
<table width="586px">
  <tr>
    <th bgcolor="#40E0D0" colspan="3">LOGIN</th>
  </tr>
  <tr>
    <td><input type="email" name="email" value="<?php echo $email; ?>" class="fc" placeholder="E-mail"></td>
    <td><input type="password" name="password" value="<?php echo $password; ?>" class="fc" placeholder="Password"></td>
    <td><input name="Submit" type="submit" value="Login" class="button"></td>
  </tr>
</form>
</table>        
    </body>
    
</html>