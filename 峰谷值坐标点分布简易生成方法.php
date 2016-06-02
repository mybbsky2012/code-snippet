<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$data = [2,3,2,4,7,1,4,7,8,2];
$result = coordinate($data);
print_r($result);
exit;


/**
 * (X���)ͼ������㻻��(������echarts�ȳ��ò��Ⱦ�ͼ�����)
 * $y_downline Y���ֵ
 * $y_online   Y���ֵ
 * ʾ��:[2, 1],[5, 1],[5, 4],[7, 4],[7, 1],[11, 1],[11, 4],[18, 4],
 * [18, 1],[19, 1],[19, 4],[23, 4],[23, 1],[30, 1],[30, 4],[38, 4],
 * [38, 1],[40, 1],[40, 4]
 */
function coordinate($points, $y_downline = 1, $y_online = 4){
	$y_axises = [];//Yֵϵ��ʼ��
	$count = count($points);//ͳ����������Y��ƥ���������

	//���ɲ���ͷ�ȶ�Ӧ��Yֵ������Ϊһ�飬ż����Ϊ��ֵ, ������Ϊ��ֵ��
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
	$data = [];//������ʼ��
	$sum = 0;
	foreach($points as $k=>$v){
		$sum = $sum + $v;//������ۻ�����
		if($k!=0){//�߳���ʼ����ֵ
			$x_axises[] = $sum;
		}
		$x_axises[] = $sum;
	}
	
	//ӳ��X��Y���꼯��
	foreach($x_axises as $key=>$val){
		$y_axis = $y_axises[$key];
		$data[] = "[{$val}, {$y_axis}]";
	}
	$data = implode(',', $data);
	return $data;
}