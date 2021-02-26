<?php



//echo file_get_contents("php://input");

$data = json_decode(file_get_contents("php://input"));


// $array = json_decode(json_encode($data), True);
// foreach ($data as $value) 
//     $array[] = $value->fname;

 print_r($data[0]->fname);exit;

$fname = isset($data->fname)?$data->fname:"";
 
$fname = isset($data->fname)?$data->fname:"";
$lname = isset($data->lname)?$data->lname:"";
$address= isset($data->address)?$data->address:"";
$mobile= isset($data->mobile)?$data->mobile:"";
$email = isset($data->email)?$data->email:"";
$gstin = isset($data->gstin)?$data->gstin:"";
$coach= isset($data->coach)?$data->coach:"";
$salesperson= isset($data->salesperson)?$data->salesperson:"";
$type= isset($data->type)?$data->type:"";
$status=isset($data->status)?$data->status:0;
$type= isset($data->type)?$data->type:"";
$created_by= isset($data->created_by)?$data->created_by:"";
$remarks= isset($data->remarks)?$data->remarks:"";
$created_at= isset($data->created_at)?$data->created_at:date('Y-m-d');
$updated_at= isset($data->updated_at)?$data->updated_at:date('Y-m-d');




$con = mysqli_connect("localhost","root","","vprotect") ;



 $qry="INSERT INTO customer_master(fname,lname,address,mobile,email,gstin,coach,salesperson,type,status,created_by,remarks,created_at,updated_at) values ('$fname','$lname','$address','$mobile','$email','$gstin','$coach','$salesperson','$type','$status','$created_by','$remarks','$created_at','$updated_at')";

$result = mysqli_query($con,$qry);
 //echo $qry;exit;
echo $result;
//echo "Your Record Added Sucessfully".$result;

?>



