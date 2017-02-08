<?php
// 获取某个餐厅的详细信息
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
$commetId = $_GET['commetId'];
$conn = mysqli_connect('localhost','root','root','restaurent');
if($conn->connect_error){
	echo "链接服务器错误";
}else{
	$conn->query("set character set 'utf8'");//读库
	$conn->query("set names 'utf8'");//写库
	$sql = "select * from comments where commetId=$commetId";
	$result = $conn->query($sql);
	$tempArr = $result->fetch_object();
	// UPDATE 表名称 SET 列名称 = 新值 WHERE 列名称 = 某值
	$usefulValue = (int)$tempArr->useful + 1;
	$updateSql = "update comments set useful = '$usefulValue' where commetId = '$commetId'";
	$tr = new stdClass();
	if($conn->query($updateSql)){
		$tr->result = 1;
	}else{
		$tr->result = 0;
	}
	echo json_encode($tr);
}
?>