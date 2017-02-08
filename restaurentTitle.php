<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$restaurentId = $_GET['restaurentId'];
$conn = mysqli_connect('localhost','root','','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set 'utf8'");//读库
	$conn->query("set names 'utf8'");//写库
	$sql = "select * from allrestaurents where restaurentId ='$restaurentId'";
	$result = $conn->query($sql);
	$arr = [];
	while($tempArr = $result->fetch_object()){
		array_push($arr, $tempArr);
	}
	echo json_encode($arr);
}
?>