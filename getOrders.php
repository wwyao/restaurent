<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
// header("Content-type:application/json;charset=utf-8");
$start = $_GET['start'];
$count = $_GET['count'];
$statu = $_GET['statu'];

$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set utf8");//读库
	$conn->query("set names utf8");//写库
	$sql = "select * from orders where statu = '$statu' limit $start,$count";
	$result = $conn->query($sql);
	$arr = [];
	while($tempArr = $result->fetch_object()){
		$sql2 = "select * from allrestaurents where restaurentId = '".$tempArr->restaurentId."'";
		$tempRes = $conn->query($sql2);
		$tempArr->title = $tempRes->fetch_object()->title;
		array_push($arr, $tempArr);
	}
	echo json_encode($arr);
}
?>