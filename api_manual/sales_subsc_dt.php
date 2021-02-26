<?php



//echo file_get_contents("php://input");

$data = json_decode(file_get_contents("php://input"));


// print_r($data) ;
// exit;

//echo json_encode($data);
 
$product_code = isset($data->product_code)?$data->product_code:"";
$customer_code = isset($data->customer_code)?$data->customer_code:"";
$validity= isset($data->validity)?$data->validity:"";
$renewal_cost= isset($data->renewal_cost)?$data->renewal_cost:"";
$status = isset($data->status)?$data->status:"";
$product_price = isset($data->product_price)?$data->product_price:"";
$created_at= isset($data->created_at)?$data->created_at:date('Y-m-d');
$updated_at= isset($data->updated_at)?$data->updated_at:date('Y-m-d');




$con = mysqli_connect("localhost","root","","vprotect") ;



 $qry="INSERT INTO sales_subsc_details(product_code,customer_code,validity,renewal_cost,status,product_price,created_at,updated_at ) values ('$product_code','$customer_code','$validity','$renewal_cost','$status','$product_price','$created_at','$updated_at' )";

$result = mysqli_query($con,$qry);
 //echo $qry;exit;
echo $result;
//echo "Your Record Added Sucessfully".$result;

?>



