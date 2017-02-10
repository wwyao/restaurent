<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$orderId = $_POST['restaurentId'];
$restaurentId = $_POST['restaurentId'];
$userId = $_POST['restaurentId'];
$content = $_POST['text'];
$time = $_POST['time'];
$sscore = $_POST['sscore'];
$tscore = $_POST['tscore'];
$escore = $_POST['escore'];


$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query = "set names utf8";
	$sql = "insert into comments(time,content,userId,restaurentId,sscore,tscore,escore,orderId) values('{$time}','{$content}','{$userId}','{$restaurentId}','{$sscore}','{$tscore}','{$escore}','{$orderId}')";
	
	$result = new stdClass();
	if($conn->query($sql)){
		$result->result = 1;
	}else{
		$result->result = 0;
	}
	echo json_encode($result);
}
?>