<?php
$servername = "localhost";
$username = "root";
$password = "";
$response_array 	= array();
$student_subj = array();
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = strip_tags($_POST['uName']);
      $email = strip_tags($_POST['uEmail']);
      $password = strip_tags($_POST['uPassword']);
      $user_name = strip_tags($_POST['uUsername']);
      $usertype = strip_tags($_POST['uUserType']);
      if($usertype == 'student'){
          $subject ="";
          if($_POST['uMath'] == 'true' ){
            $math = 0;
            array_push($student_subj,'Math');
          } else {
            $math = -1;
          }
          if($_POST['uScience']  == 'true'){
            $science = 0;
            array_push($student_subj,'Science');
          } else {
            $science = -1;
          }
          if($_POST['uSst'] == 'true'){
            $sst = 0;
            array_push($student_subj,'Sst');
          } else {
            $sst = -1;
          }
          if($_POST['uEnglish']  == 'true'){
            $english = 0;
            array_push($student_subj,'English');
          } else {
              $english = -1;
          }
          if($_POST['uHindi']  == 'true'){
            $hindi = 0;
            array_push($student_subj,'Hindi');
          } else {
            $hindi = -1;
          }
      }else{
          $subject = strip_tags($_POST['uSubject']);
      }
}
try {
      $conn = new PDO("mysql:host=$servername;dbname=attendance", $username);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO users (name, email, username,password,usertype,subject)
      VALUES ('$name', '$email','$user_name','$password','$usertype','$subject')";
      $conn->exec($sql);
      $response_array['success'] = true;

      if($usertype == 'student'){
          $sql = "INSERT INTO class_attendance (username, math, science,sst,english,hindi)
          VALUES ('$user_name', '$math','$science','$sst','$english','$hindi')";
          $conn->exec($sql);
          $response_array['success'] = true;
          $response_array['subject']  = $student_subj;
      }
    }
catch(PDOException $e)
    {
      $response_array['success'] = false;
      echo "Connection failed: " . $e->getMessage();
    }

    header("Content-type: application/json");
    echo json_encode($response_array);
?>
