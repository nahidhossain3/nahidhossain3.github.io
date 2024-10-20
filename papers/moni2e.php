<?php
session_start();
include_once('../assigner/db.php');

    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = '6LcI5m4jAAAAAJV-3pri8n4BOXxmsiciKg9qMPr0';
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $secret_key . '&response=' . $recaptcha;
    $response = file_get_contents($url);
    $response = json_decode($response);
    if ($response->success == true) {
        
          $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $nahid_username = trim(mysqli_real_escape_string($conn, $_POST['nahid_username']));
            $nahid_password = trim(mysqli_real_escape_string($conn, $_POST['nahid_password']));
            $nahid_password = hash("sha512",$nahid_password);
            $sql = "SELECT * FROM faculty_user WHERE `nam`='$nahid_username'";
            $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              
              
              if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                  $ip=$_SERVER['HTTP_CLIENT_IP'];
                }
                elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else{
                  $ip=$_SERVER['REMOTE_ADDR'];
                }

                  date_default_timezone_set('Asia/Dhaka');
                  $date = date('h:i A d-m-Y');
                  $comments = "admin_login";
                $sql2e = "INSERT INTO `assigner_log` (`id` , `user` , `user_ip`, `log_time`, `comments`) VALUES ('', '$nahid_username', '$ip', '$date','$comments')";

                if ($result = mysqli_query($conn, $sql2e)) {
                  
                } else {
                  echo "Server Error! Please notify me at +8801754257670";
                }

              if($nahid_password == $row["word"]){
                  $_SESSION['nahid_faculty_user'] = $nahid_username;
                  header("Location: proc.php"); 
              }
              else{
                  $_SESSION['nahid_faculty_error'] = "passwordnotmatched";
                  header("Location: index.php");
                  exit();
              }
              
              
                
              
     }
     else {
                  $_SESSION['nahid_faculty_error'] = "recaptcha";
                  header("Location: index.php");
      }
      