<?php
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
// header("Content-type:application/json;charset=utf-8");
$start = $_GET['start'];
$count = $_GET['count'];
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set utf8");//读库
	$conn->query("set names utf8");//写库
	$sql = "select * from allrestaurents limit $start,$count";
	$result = $conn->query($sql);
	$arr = [];
	while($tempArr = $result->fetch_object()){
		$tempObj = new stdClass();
		$tempObj->restaurentId = $tempArr->restaurentId;
		$tempObj->title = $tempArr->title;
		$tempObj->money = $tempArr->money;
		// $image_info = getimagesize($tempArr->imgSrc1);
		// $tempObj->imgSrc1 = "data:{$image_info['mime']};base64," . chunk_split(base64_encode(file_get_contents($tempArr->imgSrc1)));
		$tempObj->imgSrc1 = $tempArr->imgSrc1;
		$tempObj->address = $tempArr->address;
		$tempObj->feature = $tempArr->feature;
		array_push($arr, $tempObj);
	}
	echo json_encode($arr);
}
?>