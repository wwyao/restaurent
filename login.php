<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$username = $_POST['username'];
$password = md5($_POST['password']);

$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query = "set names utf8";
	$sql = "select * from Users where username='$username' and password='$password'";
	$queryResult = $conn->query($sql);
	$result = new stdClass();
	if(mysqli_affected_rows($conn)){
		$result->result = 1;
		$tempobj = $queryResult->fetch_object();
		$result->userId = $tempobj->userId;
	}else{
		$result->result = 0;
	}
	echo json_encode($result);
}
?>