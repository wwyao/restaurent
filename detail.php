<?php
// 获取某个餐厅的详细信息
header("Content-Type: text/html;charset=utf-8");
$restaurentId = $_GET['restaurentId'];
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set 'utf8'");//读库
	$conn->query("set names 'utf8'");//写库
	$sql = "select * from allrestaurents where restaurentId=$restaurentId";
	$result = $conn->query($sql);
	$tempArr = $result->fetch_object();
	echo json_encode($tempArr);
}
?>