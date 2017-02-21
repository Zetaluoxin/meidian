<?php
	/**
	* 获取广告主名称
	*@param $arr为查询到的所有广告主信息的二维数组，$id为当前广告对应的广告主id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	// function getCompany($arr,$id){
	// 	foreach ($arr as $k => $v) {
	// 		if($id == $v['id']){
	// 			return $v['com_name'];
	// 		}
	// 	}
	// 	return "无";
	// }

	/**
	* 获取终端编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getProduct($arr,$id){
		foreach ($arr as $k => $v) {
			if($id == $v['id']){
				return $v['product_batch'];
			}
		}
		return "无";
	}

	/**
	* 查询用户名通过id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getUser($id){
		return D("User","Logic")->select_User(array("id"=>$id))[0]['names'];
	}

	/**
	* 查询公司通过id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getCompany($id){
		return D("Company","Logic")->getName(array("id"=>$id))[0]['com_name'];
	}

	/**
	* 查询店铺通过id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getShopname($id){
		return D("Barbershop","Logic")->queryBarbershop(array('id'=>$id))[0]['barbershop_name'];
	}
?>