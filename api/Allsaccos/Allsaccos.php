<?php


// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/sacco.php';

//instantiate User 
$database = new Database();
$db = $database->getConnection();

$sacco = new Sacco($db);

//user query
$result = $sacco->readAll();

//get the row count 
$num = $result->rowCount();

if($num > 0){

    $sacco_arr = array();
    $sacco_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $sacco_item = array(

        'id' => $id,
        'name' => $name,
        '$description' => $description,
        'time_of_cont' => $time_of_cont,
        'created' => $created

      );

      array_push($sacco_arr['data'], $sacco_item);

    }
    //convert to json
    header('Content-Type: application/json');
    echo json_encode($sacco_arr);

}else{
echo json_encode(array('message' => 'No sacco found.'));
}
