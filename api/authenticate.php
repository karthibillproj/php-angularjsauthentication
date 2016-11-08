 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$json = file_get_contents('php://input');
$obj = json_decode($json);

$userid = $obj->username;
$userpwd = $obj->password;

class Response{
   public $success;
   public $message;
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, username, password FROM users WHERE username = '$userid' AND password = '$userpwd'";
$result = mysqli_query($conn, $sql);

$response = new StdClass();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
  /*  while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    } */
   // $data = 'success';
    $response->success = true;
} else {
  //  $data = 'failure';
	 $response->success = false;
	 $response->message = "Username or password is incorrect";
}

mysqli_close($conn);

echo json_encode($response);
exit;

?> 