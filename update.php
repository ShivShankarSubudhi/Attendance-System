<?php
$servername = "localhost";
$username = "root";
$password = "";
$response_array 	= array();
$student_array = array();
if($_SERVER["REQUEST_METHOD"] == "POST") {
  header('Content-type: application/json');
  $json = file_get_contents('php://input');
  $json_decode = json_decode($json, true);
  $user_name = $json_decode['name'];

}
try {
      $conn = new PDO("mysql:host=$servername;dbname=attendance", $username);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT subject from users where username = '$user_name' and usertype = 'teacher'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      if($stmt->rowCount() != 0){
         foreach($stmt->fetchAll() as $key=>$value) {
                  $subject = $value['subject'];
         }

         foreach ($json_decode['students'] as $name) {
           switch ($subject) {
             case 'math':
               $stmt = $conn->prepare("SELECT math from class_attendance where username = '$name'");
               break;
             case 'science':
               $stmt = $conn->prepare("SELECT science from class_attendance where username = '$name'");
               break;
             case 'sst':
               $stmt = $conn->prepare("SELECT sst from class_attendance where username = '$name'");
               break;
             case 'english':
               $stmt = $conn->prepare("SELECT english from class_attendance where username = '$name'");
               break;
             case 'hindi':
               $stmt = $conn->prepare("SELECT hindi from class_attendance where username = '$name'");
               break;
           }
           $stmt->execute();
           foreach($stmt->fetchAll() as $key=>$value) {
               switch ($subject) {
                 case 'math':
                  $attend = $value['math'];
                  $attend++;
                  $stmt = $conn->prepare("UPDATE class_attendance SET math = '$attend' where username = '$name'");
                   break;
                 case 'science':
                   $attend = $value['science'];
                   $attend++;
                   $stmt = $conn->prepare("UPDATE class_attendance SET science = '$attend' where username = '$name'");
                   break;
                 case 'sst':
                   $attend = $value['sst'];
                   $attend++;
                   $stmt = $conn->prepare("UPDATE class_attendance SET sst = '$attend' where username = '$name'");
                   break;
                 case 'english':
                   $attend = $value['english'];
                   $attend++;
                   $stmt = $conn->prepare("UPDATE class_attendance SET english = '$attend' where username = '$name'");
                   break;
                 case 'hindi':
                   $attend = $value['hindi'];
                   $attend++;
                   $stmt = $conn->prepare("UPDATE class_attendance SET hindi = '$attend' where username = '$name'");
                   break;
               }
             }
              $stmt->execute();
              $response_array['success'] = true;
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
