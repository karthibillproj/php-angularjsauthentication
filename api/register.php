 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$json = file_get_contents('php://input');
$obj = json_decode($json);

$firstname = $obj->firstname;
$lastname = $obj->lastname;
$userid = $obj->username;
$userpwd = $obj->password;


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, username FROM users WHERE username = '$userid'";
$result = mysqli_query($conn, $sql);

$response = new StdClass();

if (mysqli_num_rows($result) > 0) {
    //$response->success = true;
     $response->success = false;
     $response->message = "Username already exist";
} else {
  //  $data = 'failure';
  	   $sql = "INSERT INTO users (first_name, last_name, username, password) VALUES ('$firstname', '$lastname', '$userid', '$userpwd')";
    if ($conn->query($sql) === TRUE) {
        $response->success = true;
    } else {
        $response->success = false;
        $response->message = $conn->error;
    }
}

mysqli_close($conn);

echo json_encode($response);
exit;

?> 