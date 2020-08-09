<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->firstname = $_POST['firstname'];
$user->lastname = $_POST['lastname'];
$user->phone = $_POST['phone'];
$user->password = base64_encode($_POST['password']);
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->signup()){
    $user_arr=array(
      //  "status" => true,
        //"message" => "Successfully Signup!",
        //"id" => $user->id,
        //"firstname" => $user->firstname

        "success" => "1",
        "message" => "success"
    );
}
else{
    $user_arr=array(
        //"status" => false,
        //"message" => "User already exists!"
     
        "success" => "0",
        "message" => "error"

    );
}
//print_r(json_encode($user_arr));
header('Content-Type: application/json');
echo json_encode($user_arr);
?>