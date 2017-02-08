<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$userId = $_GET['userId'];
$restaurentId = $_GET['restaurentId'];
$conn = mysqli_connect('localhost','root','','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query = "set names utf8";
	$sql = "insert into concern(userId,restaurentId) values('{$userId}','{$restaurentId}')";
	$conn->query($sql);
	$result = new stdClass();
	if(mysqli_affected_rows($conn)){
		$result->result = 1;
	}else{
		$result->result = 0;
	}
	echo json_encode($result);
}
?>