<?php



//echo file_get_contents("php://input");

$data = json_decode(file_get_contents("php://input"));


// print_r($data) ;
// exit;

//echo json_encode($data);
 



$invoice_number = isset($data->invoice_number)?$data->invoice_number:"";
$date = isset($data->date)?$data->date:"";
$due_date= isset($data->due_date)?$data->due_date:"";
$customer_id= isset($data->customer_id)?$data->customer_id:"";
$order_id = isset($data->order_id)?$data->order_id:"";
$total_amount = isset($data->total_amount)?$data->total_amount:"";
$gst_rate= isset($data->gst_rate)?$data->gst_rate:"";
$gst_amount = isset($data->gst_amount)?$data->gst_amount:"";
$grand_total = isset($data->grand_total)?$data->grand_total:"";
$created_at= isset($data->created_at)?$data->created_at:date('Y-m-d');
$updated_at= isset($data->updated_at)?$data->updated_at:date('Y-m-d');




$con = mysqli_connect("localhost","root","","vprotect") ;



 $qry="INSERT INTO invoice_master(invoice_number,date,due_date,customer_id,order_id,total_amount,gst_rate,gst_amount,grand_total,created_at,updated_at ) values ('$invoice_number','$date','$due_date','$customer_id','$order_id','$total_amount','$gst_rate','$gst_amount','$grand_total','$created_at','$updated_at')";

$result = mysqli_query($con,$qry);
 //echo $qry;exit;
echo $result;
//echo "Your Record Added Sucessfully".$result;

?>



