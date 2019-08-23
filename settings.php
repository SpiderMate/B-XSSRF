<?php
// Init session
session_start();
// Include db config
require_once 'db.php';

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
header('location: login.php');
exit;
}
?>
<?php
  // Init vars
  $name = $email = $password = $confirm_password = '';
  $name_err = $email_err = $password_err = $confirm_password_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // Put post vars in regular vars
    $name =  trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate email
    if(empty($email)){
      $email_err = 'Please enter email';
    } else {
      // Prepare a select statement
      $sql = 'SELECT id FROM users WHERE email = :email';

      if($stmt = $pdo->prepare($sql)){
        // Bind variables
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            $email_err = 'Email is Same';
          }
        } else {
          die('Something went wrong');
        }
      }

      unset($stmt);
    }

    // Validate name
    if(empty($name)){
      $name_err = 'Please enter name';
    }

    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    } elseif(strlen($password) < 6){
      $password_err = 'Password must be at least 6 characters ';
    }

    // Validate Confirm password
    if(empty($confirm_password)){
      $confirm_password_err = 'Please confirm password';
    } else {
      if($password !== $confirm_password){
        $confirm_password_err = 'Passwords do not match';
      }
    }

    // Make sure errors are empty
    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
      // Hash password
      $password = password_hash($password, PASSWORD_DEFAULT);

      // Prepare insert query
      $sql = 'UPDATE users SET name = :name, email= :email, password= :password WHERE ID=0';

      if($stmt = $pdo->prepare($sql)){
        // Bind params
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Attempt to execute
        if($stmt->execute()){
          // Redirect to login
          echo 'DONE';
        } else {
          echo 'NOT DONE';
        }
      }
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
<?php echo $name_err; ?>
<?php echo $email_err; ?>
<?php echo $password_err; ?>
<?php echo $confirm_password_err; ?>
<table width="586px">
  <tr>
    <th bgcolor="#40E0D0" colspan="5">UPDATE USER DETAILS</th>
  </tr>
  <tr>
    <td><input type="text" name="name" value="<?php echo $name; ?>" class="fc" placeholder="Name"></td>
    <td><input type="email" name="email" value="<?php echo $email; ?>" class="fc" placeholder="E-mail"></td>
    <td><input type="password" name="password" value="<?php echo $password; ?>" class="fc" placeholder="Password"></td>    
    <td><input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" class="fc" placeholder="Confirm Password"></td>
    <td><input name="Submit" type="submit" value="UPDATE" class="button"></td>
  </tr>
</form>
</table>

</body>
</html>
