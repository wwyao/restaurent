<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$orderId = $_POST['orderId'];
$userId = $_POST['userId'];
$restaurentId = $_POST['restaurentId'];
$time = $_POST['time'];
$peopleNum = $_POST['numOfPeople'];
$phone = $_POST['phone'];
$statu = $_POST['statu'];
$name = $_POST['contacter'];
$desk = $_POST['desk'];
$money = $_POST['money'];
$orderMenuId = $_POST['orderMenuId'];
$remark = $_POST['remark'];

$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set 'utf8'");//读库
	$conn->query("set names 'utf8'");//写库
	$sql = "insert into orders(orderId,userId,restaurentId,time,peopleNum,phone,statu,name,desk,bookMoney,orderMenuId,remark)  values('{$orderId}','{$userId}','{$restaurentId}','{$time}','{$peopleNum}','{$phone}','{$statu}','{$name}','{$desk}','{$money}','{$orderMenuId}','{$remark}')";
	$result = new stdClass();
	if($conn->query($sql)){
		$result->result = 1;
	}else{
		$result->result = 0;
	}
	echo json_encode($result);
}
?>