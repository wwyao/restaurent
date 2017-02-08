<?php
// 获取某个餐厅的详细信息
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$userId = $_POST['userId'];
$password = md5($_POST['password']);

$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set 'utf8'");//读库
	$conn->query("set names 'utf8'");//写库
	$sql = "update users set password = '$password' where userId = '$userId'";
	$tr = new stdClass();
	if($conn->query($sql)){
		$tr->result = 1;
	}else{
		$tr->result = 0;
	}
	echo json_encode($tr);
}
?>