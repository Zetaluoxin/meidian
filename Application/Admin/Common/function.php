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
	* 查询用户名详情通过id编号
	*@param 
	*@return 
	* 
	*/
	function getUserInfo($id){
		return D("User","Logic")->select_User(array("id"=>$id));
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
	* 查询公司通过用户id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getCompanyById($id){
		return D("Company","Logic")->getName(array("user_id"=>$id))[0]['com_name'];
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


	/**
	* 查询店铺通过用户id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getShopnameById($id){
		return D("Barbershop","Logic")->queryBarbershop(array('user_id'=>$id))[0]['barbershop_name'];
	}

	/**
	* 查询图片通过id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getImg($id){
		return D("File","Logic")->select_Img(array("id"=>$id))[0]['big_img'];
	}

	/**
	* 查询视频通过id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getVideo($id){
		return D("File","Logic")->select_Video(array("id"=>$id))[0]['video_url'];
	}

	/**
	* 查询终端数量通过店铺id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getProductNum($id){
		$res = D("Product","Logic")->getProduct(array("barbershop_id"=>$id));
		return count($res);
	}


	/**
	* 查询正常运行的终端数量通过店铺id编号
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getProductRun($id){
		$res = D("Product","Logic")->getProduct(array("barbershop_id"=>$id));
		foreach ($res as $key => $val) {
			if($val['product_fix'] == '0'){
				unset($res[$key]);
			}
		}
		return count($res);
	}


	/**
	* 查询省份通过省份id
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getProvince($id){
		return D("Place","Logic")->province(array("province_id"=>$id))['res'][0]['province_name'];
	}




	/**
	* 查询城市通过城市id
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getCity($id){
		return D("Place","Logic")->queryCityById($id)[0]['city_name'];
	}


	/**
	* 查询区县通过区县id
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getDistrict($id){
		return D("Place","Logic")->queryDistrictById($id)[0]['district_name'];
	}

	/**
	* 查询街道通过街道id
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getStreet($id){
		return D("Place","Logic")->queryStreetById($id)[0]['street_name'];
	}



	/**
	* 查询展示区域通过id
	*@param $arr为查询到的所有终端信息的二维数组，$id为当前广告对应的终端id
	*@return 成功返回广告主名称，失败返回无;
	* 
	*/
	function getArea($id){
		return D("Area","Logic")->queryarea(array("id"=>$id))[0]['area'];
	}

?>