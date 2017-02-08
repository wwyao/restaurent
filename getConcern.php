<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
// header("Content-type:application/json;charset=utf-8");
$userId = $_GET['userId'];
$start = $_GET['start'];
$count = $_GET['count'];
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set utf8");//读库
	$conn->query("set names utf8");//写库
	$sql = "select * from concern where userId = '$userId' limit $start,$count";
	$result = $conn->query($sql);
	$arr = [];
	while($tempArr = $result->fetch_object()){
		$sql2 = "select * from allrestaurents where restaurentId = '".$tempArr->restaurentId."'";
		$tempRes = $conn->query($sql2);
		$tempResultR = $tempRes->fetch_object();
		$image_info = getimagesize($tempResultR->imgSrc1);
		$tempResultR->imgSrc1 = "data:{$image_info['mime']};base64," . chunk_split(base64_encode(file_get_contents($tempResultR->imgSrc1)));
		array_push($arr, $tempResultR);
	}
	echo json_encode($arr);
}
?>