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
// Get Logs
$query = "SELECT id, ip, datex, timex FROM xssrf_logs";

try {

    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
catch(PDOException $ex) {

    die("Fuck Man: " . $ex->getMessage());
}

$rows = $stmt->fetchAll();
?>


<?php

if(isset($_GET['delete_logs'])){
      $sql = 'TRUNCATE TABLE xssrf_logs';
      $stmt = $pdo->prepare($sql);
          if($stmt->execute()){
            echo '<script type="text/javascript">';
                echo 'window.location.replace("index.php")';
                echo '</script>';
              } else {
            echo '<script type="text/javascript">';
                echo 'alert("Not Deleted")';
                echo '</script>';
              }
            }
 unset($pdo);

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
a {color: #001f3f;}

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

    .avatar {
    display: block;
    border-radius: 200px;
    box-sizing: border-box;
    border: 2px solid #111111;
}
</style>
<center>
<br/>
<table width="560px">
    <tr>
        <td width="160px" bgcolor="#F8F8FF" nowrap>
            <div style="margin-bottom: 6px;">
                <img class="avatar" src="img/logo.png" width=32>
                <div style="margin-top: -25px; padding-left: 40px;color: #000;"><b>B-XSSRF</b></div>
            </div>
        </td>
        <td  bgcolor="#F8F8FF" nowrap>
            <div style="padding-left:4px; padding-bottom:0px;" >
                <a href="index.php">DASHBOARD</a>  |
                <a href="" onClick="location.href=location.href">REFRESH</a> |
                <a href="?delete_logs">DELETE</a>  |
                <a href="settings.php">SETTINGS</a>  |
                <a href="javascript:alert('I &hearts; Hacking')">ABOUT</a>  |
                <a href="logout.php">LOGOUT</a>
            </div>
        </td>
    </tr>
</table>

<h3><p>My Swiss Knife For : Blind XSS, XXE & SSRF</p></h3>

<table width="586px">
  <tr>
    <th bgcolor="#40E0D0">NO</th>
    <th bgcolor="#40E0D0">IP</th>
    <th bgcolor="#40E0D0">DATE</th>
    <th bgcolor="#40E0D0">TIME</th>
  </tr>
  <tr>
    <?php foreach($rows as $row): ?>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['ip']; ?></td>
    <td><?php echo $row['datex']; ?></td>
    <td><?php echo $row['timex']; ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<br/>
<br/>
</center>

    </body>
</html>
