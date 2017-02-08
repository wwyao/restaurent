<?php
header("Content-Type: text/html;charset=utf-8");
header("Access-Control-Allow-Origin:*");
$start = $_GET['start'];
$count = $_GET['count'];
$restaurentId = $_GET['restaurentId'];
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set utf8");//读库
	$conn->query("set names utf8");//写库
	$sql = "select * from comments where restaurentId = '$restaurentId' limit $start,$count";
	$result = $conn->query($sql);
	$arr = [];
	while($tempArr = $result->fetch_object()){
		$sql2 = "select * from users where userId ='".$tempArr->userId."'";
		$tempRes = $conn->query($sql2);
		$tempArr->name = $tempRes->fetch_object()->username;
		// $tempArr->avatar = $tempRes->fetch_object()->avatar;
		array_push($arr, $tempArr);
	}
	echo json_encode($arr);
}
?>