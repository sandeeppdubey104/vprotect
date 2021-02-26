<?php



//echo file_get_contents("php://input");

$data = json_decode(file_get_contents("php://input"));


// print_r($data) ;
// exit;

//echo json_encode($data);

$name = isset($data->name)?$data->name:"";
$code = isset($data->code)?$data->code:"";
$brand= isset($data->brand)?$data->brand:"";
$description= isset($data->description)?$data->description:"";
$price = isset($data->price)?$data->price:"";
$quantity = isset($data->quantity)?$data->quantity:""; 
$created_at= isset($data->created_at)?$data->created_at:date('Y-m-d');
$updated_at= isset($data->updated_at)?$data->updated_at:date('Y-m-d');




$con = mysqli_connect("localhost","root","","vprotect") ;



 $qry="INSERT INTO product_master(name,code,brand,description,price,quantity,created_at,updated_at) values ('$name','$code','$brand','$description','$price','$quantity','$created_at','$updated_at')";

$result = mysqli_query($con,$qry);
 //echo $qry;exit;
echo $result;
//echo "Your Record Added Sucessfully".$result;

?>



