<?php
$data = [2,3,2,4,7,1,4,7,8,2];
$result = coordinate($data);
print_r($result);
exit;
/**
 * (X轴距)图表坐标点换算(可用于echarts等常用不等距图表呈现)
 * $y_downline Y轴谷值
 * $y_online   Y轴峰值
 * 备注：请在PHP版本不小于5.4.0版本下运行！
 * 示例:[2, 1],[5, 1],[5, 4],[7, 4],[7, 1],[11, 1],[11, 4],[18, 4],
 * [18, 1],[19, 1],[19, 4],[23, 4],[23, 1],[30, 1],[30, 4],[38, 4],
 * [38, 1],[40, 1],[40, 4]
 */
function coordinate($points, $y_downline = 1, $y_online = 4){
	$y_axises = [];//Y值系初始化
	$count = count($points);//统计用于生成Y轴匹配点组数量
	//生成波峰和峰谷对应的Y值（两个为一组，偶数组为谷值, 奇数组为峰值）
	for($i=0;$i<=$count;$i++){
		if(($i%2)==0){
			$y_axises[] = $y_downline;
			$y_axises[] = $y_downline;
		}else{
			$y_axises[] = $y_online;
			$y_axises[] = $y_online;
		}
	}
	
	$x_axises = [];
	$data = [];//坐标点初始化
	$sum = 0;
	foreach($points as $k=>$v){
		$sum = $sum + $v;//坐标点累积增加
		if($k!=0){//踢除初始坐标值（根据需要是否不生成）
			$x_axises[] = $sum;
		}
		$x_axises[] = $sum;
	}
	
	//映射X、Y坐标集合
	foreach($x_axises as $key=>$val){
		$y_axis = $y_axises[$key];
		$data[] = "[{$val}, {$y_axis}]";
	}
	$data = implode(',', $data);
	return $data;
}