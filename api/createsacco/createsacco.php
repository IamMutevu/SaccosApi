<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/sacco.php';
 
$database = new Database();
$db = $database->getConnection();
 
$sacco = new Sacco($db);
 
// set user property values
$sacco->name = $_POST['name'];
$sacco->description = $_POST['description'];
$sacco->time_of_cont = $_POST['time_of_cont'];
$sacco->created = date('Y-m-d H:i:s');
 
// create the sacco
if($sacco->createSacco()){
    $sacco_arr=array(
        "status" => true,
        "message" => "Successfully created!",
        "id" => $sacco->id,
        "name" => $sacco->name
    );
}
else{
    $sacco_arr=array(
        "status" => false,
        "message" => "sacco already exists!"
    );
}
//print_r(json_encode($sacco_arr));
header('Content-Type: application/json');
echo json_encode($sacco_arr);
?>