<?php
$servername = "localhost";
$username = "root";
$password = "";
$response_array 	= array();
$student_array = array();
$password_correct = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $password = strip_tags($_POST['uPassword']);
      $user_name = strip_tags($_POST['uUsername']);
      $usertype = strip_tags($_POST['uUserType']);

}
try {
      $conn = new PDO("mysql:host=$servername;dbname=attendance", $username);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT password,name,subject from users where username = '$user_name' and usertype = '$usertype'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      if($stmt->rowCount() != 0){
         foreach($stmt->fetchAll() as $key=>$value) {
             if($value['password'] == $password){
                  $response_array['success'] = true;
                  $response_array['name'] = $value['name'] ;
                  $subject = $value['subject'] ;
                  $password_correct = true;
             }
         }
         if($usertype == 'student' && $password_correct == true){
           $stmt = $conn->prepare("SELECT * from class_attendance where username = '$user_name'");
           $stmt->execute();
           $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
           if($stmt->rowCount() != 0){
              foreach($stmt->fetchAll() as $key=>$value) {
                  $response_array['success'] = true;
                  if($value['math'] != -1){
                    $student_subj['Math'] = $value['math'];
                  }
                  if($value['science'] != -1){
                    $student_subj['Science'] = $value['science'];
                  }
                  if($value['sst'] != -1){
                    $student_subj['Sst'] = $value['sst'];
                  }
                  if($value['english'] != -1){
                    $student_subj['English'] = $value['english'];
                  }
                  if($value['hindi'] != -1){
                    $student_subj['Hindi'] = $value['hindi'];
                  }
              }
              $response_array['subject']  = $student_subj;
            } else {
              $response_array['success'] = false;
            }
         } elseif($password_correct == true) {
              if($subject == 'math'){
                $stmt = $conn->prepare("SELECT username from class_attendance where math > -1");
              } elseif($subject == 'science') {
                $stmt = $conn->prepare("SELECT username from class_attendance where science > -1");
              } elseif ($subject == 'sst') {
                $stmt = $conn->prepare("SELECT username from class_attendance where sst > -1");
              } elseif ($subject == 'english') {
                $stmt = $conn->prepare("SELECT username from class_attendance where sst > -1");
              } else {
                $stmt = $conn->prepare("SELECT username from class_attendance where hindi > -1");
              }
               $stmt->execute();
               $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
               if($stmt->rowCount() != 0){
                    foreach($stmt->fetchAll() as $key=>$value) {
                        $response_array['success'] = true;
                        array_push($student_array,$value['username']);
                    }
                    $response_array['student_array']  = $student_array;
              }  else {
                  $response_array['success'] = false;
              }
         }
      } else {
          $response_array['success'] = false;
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
