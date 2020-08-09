<?php


// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';

//instantiate User 
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//user query
$result = $user->readAll();

//get the row count 
$num = $result->rowCount();

if($num > 0){

    $user_arr = array();
    $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $user_item = array(

        'id' => $id,
        'firstname' => $firstname,
        '$lastname' => $lastname,
        'phone' => $phone,
       // 'password' => $password,
        'created' => $created

      );

      array_push($user_arr['data'], $user_item);

    }
    //convert to json 
    header('Content-Type: application/json');
    echo json_encode($user_arr);

}else{
echo json_encode(array('message' => 'No user found.'));
}
