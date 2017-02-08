<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$orderId = $_POST['orderId'];
$userId = $_POST['tserId'];
$restaurentId = $_POST['restaurentId'];
$time = $_POST['time'];
$peopleNum = $_POST['peopleNum'];
$phone = $_POST['phone'];
$statu = $_POST['statu'];
$name = $_POST['name'];
$desk = $_POST['desk'];
$money = $_POST['money'];


$conn = mysqli_connect('localhost','root','','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query = "set names utf8";
	$sql = "insert into Users(orderId,userId,restaurentId,time,peopleNum,phone,statu,name,desk,money)  values('{$orderId}','{$userId}','{$restaurentId}','{$time}','{$peopleNum}','{$phone}','{$statu}','{$name}','{$desk}','{$money}')";
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