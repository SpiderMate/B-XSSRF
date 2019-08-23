<?php
  // Include db config
  require_once 'db.php';
?>

<?php

date_default_timezone_set('Asia/Kolkata'); // Set your Time Zone Here

   $ip = $_SERVER['REMOTE_ADDR'];
   $datex = date('Y/m/d');
   $timex = date('G:i:s');
   
    $sql = 'INSERT INTO xssrf_logs (ip, datex, timex) VALUES (:ip, :datex, :timex)';
    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
        $stmt->bindParam(':datex', $datex, PDO::PARAM_STR);
        $stmt->bindParam(':timex', $timex, PDO::PARAM_STR);

    if($stmt->execute()){
		  echo 'YES';
        } else {
		  echo 'NO';
        }
      }

    unset($pdo);
    
?>