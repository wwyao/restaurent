<?php
// header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
header("Content-type:application/json;charset=utf-8");
$start = $_GET['start'];
$count = $_GET['count'];
$classifyValue = $_GET['classifyValue'];
$placeValue = $_GET['placeValue'];
$index = "0";
// echo $classifyValue.$placeValue;
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set utf8");//读库
	$conn->query("set names utf8");//写库
	if($classifyValue != '所有分类'  && $placeValue == '全部'){
		$sql = "select * from allrestaurents where feature like '%$classifyValue%' limit $start,$count";
		$index = "1";
	}else if($classifyValue == '所有分类'  && $placeValue != '全部'){
		$sql = "select * from allrestaurents where area like '%$placeValue%' limit $start,$count";
		$index = "2";
	}else if($classifyValue != '所有分类'  && $placeValue != '全部'){
		$sql = "select * from allrestaurents where area like '%$placeValue%' and feature like '%$classifyValue%' limit $start,$count";
		$index = "3";
	}else{
		$sql = "select * from allrestaurents limit $start,$count";
		$index = "4";
	}
	$result = $conn->query($sql);
	$arr = [];
	while($tempArr = $result->fetch_object()){
		$tempObj = new stdClass();
		$tempObj->ix = $index;
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