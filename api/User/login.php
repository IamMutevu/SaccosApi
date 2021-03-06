<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->phone = isset($_GET['phone']) ? $_GET['phone'] : die();
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        //"status" => true,
        //"message" => "Successfully Login!",
        //"id" => $row['id'],
        //"firstname" => $row['firstname']

        "success" => "1",
        "message" => "success"
    );
}
else{
    $user_arr=array(
        //"status" => false,
        //"message" => "Invalid phone or Password!",
        "success" => "0",
        "message" => "error"
    );
}
// make it json format
//print_r(json_encode($user_arr));
header('Content-Type: application/json');
echo json_encode($user_arr);
?>