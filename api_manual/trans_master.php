<?php



//echo file_get_contents("php://input");

$data = json_decode(file_get_contents("php://input"));


// print_r($data) ;
// exit;

//echo json_encode($data);
 



$trans_no = isset($data->trans_no)?$data->trans_no:"";
$amount = isset($data->amount)?$data->amount:"";
$date= isset($data->date)?$data->date:"";
$mode= isset($data->mode)?$data->mode:"";
$invoice_number = isset($data->invoice_number)?$data->invoice_number:"";
$created_at= isset($data->created_at)?$data->created_at:date('Y-m-d');
$updated_at= isset($data->updated_at)?$data->updated_at:date('Y-m-d');




$con = mysqli_connect("localhost","root","","vprotect") ;



 $qry="INSERT INTO trans_master(trans_no,amount,date,mode,invoice_number,created_at,updated_at) values ('$trans_no','$amount','$date','$mode','$invoice_number','$created_at','$updated_at')";

$result = mysqli_query($con,$qry);
 //echo $qry;exit;
echo $result;
//echo "Your Record Added Sucessfully".$result;

?>



