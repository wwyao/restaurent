<?php
// 获取某个餐厅的详细信息
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$menuId = $_GET['menuId'];
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set 'utf8'");//读库
	$conn->query("set names 'utf8'");//写库
	$sql = "select * from menu where menuId=$menuId";
	$result = $conn->query($sql);
	$tempArr = $result->fetch_object();
	echo json_encode($tempArr);
}
?>