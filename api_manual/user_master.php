<?php



//echo file_get_contents("php://input");

$data = json_decode(file_get_contents("php://input"));


// print_r($data) ;
// exit;

//echo json_encode($data);

 

$name = isset($data->name)?$data->name:"";
$user_name = isset($data->user_name)?$data->user_name:"";
$password= isset($data->password)?$data->password:"";
$mobile= isset($data->mobile)?$data->mobile:"";
$email = isset($data->email)?$data->email:"";
$email_verified_at = isset($data->email_verified_at)?$data->email_verified_at:"";
$emp_code = isset($data->emp_code)?$data->emp_code:"";
$designation= isset($data->designation)?$data->designation:"";
$designation_hierarchy= isset($data->designation_hierarchy)?$data->designation_hierarchy:"";
$remember_token= isset($data->remember_token)?$data->remember_token:"";
$created_at= isset($data->created_at)?$data->created_at:date('Y-m-d');
$updated_at= isset($data->updated_at)?$data->updated_at:date('Y-m-d');




$con = mysqli_connect("localhost","root","","vprotect") ;



 $qry="INSERT INTO users_master(name,user_name,password,mobile,email,email_verified_at,emp_code,designation,designation_hierarchy,remember_token,created_at,updated_at) values ('$name','$user_name','$password','$mobile','$email','$email_verified_at','$emp_code','$designation','$designation_hierarchy','$remember_token','$created_at','$updated_at')";

$result = mysqli_query($con,$qry);
 //echo $qry;exit;
echo $result;
//echo "Your Record Added Sucessfully".$result;

?>



