<?php 
namespace Admin\Logic;
use Think\Model;

/**
* 
*/
class PlaceLogic extends Model{


	/**
	*查询/添加所有的省
	*@param $data
	*@return
	*/
	public function province($data){
		$province=M('province');
		$return=array();
		if($data['province_id'] == '' && $data['province_name'] != ''){
			$res=$province->data($data)->add();
			$return['type']='create';
			$return['res']=$res;
			return $return;
		}else if($data['province_id'] != '' && $data['province_name'] == ''){
			$province_id=$data['province_id'];
			$res=$province->where('id='.$province_id)->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else if($data['province_id'] == '' && $data['province_name'] == ''){
			$res=$province->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else{
			return false;
		}
	}

	public function addProvince($data){
		$province=M('city');
		$res=$province->data($data)->add();
		// var_dump($res);die;
		return $res;
	}	




	/**
	*查询/添加 市
	*@param $data
	*@return
	*/
	public function city($data){
		$city=M('city');
		$return=array();
		if($data['city_name'] != '' && $data['province_id'] != ''){
			$res=$city->data($data)->add();
			$return['type']='create';
			$return['res']=$res;
			return $return;
		}else if($data['city_name'] == '' && $data['province_id'] != ''){
			$province_id=$data['province_id'];
			$res=$city->where('province_id='.$province_id)->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else if($data['city_name'] == '' && $data['province_id'] == ''){
			$res=$city->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else{
			return false;
		}
	}







	/**
	*查询/添加 县区
	*@param $data
	*@return
	*/
	public function district($data){
		$district=M('district');
		$return=array();
		if($data['district_name'] !='' && $data['city_id'] != ''){
			$res=$district->data($return)->save();
			$return['type']='create';
			$return['res']=$res;
			return $return;
		}else if($data['district_name'] =='' && $data['city_id'] != ''){
			$city_id=$data['city_id'];
			$res=$district->where('city_id='.$city_id)->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else if($data['district_name'] =='' && $data['city_id'] == ''){
			$res=$district->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else{
			return false;
		}
	}



	/**
	*创建区/县
	*@param 
	*@return
	*/
	public function addDistrict($data){
		$district=M('district');
		$res=$district->data($data)->add();
		// var_dump($res);die;
		return $res;
	}





	/**
	*查询/添加 街道
	*@param $data
	*@return
	*/
	public function street($data){
		$street=M('street');
		$return=array();
		if($data['street_name'] != '' && $data['district_id'] != ''){
			$res=$street->data($return)->save();
			$return['type']='create';
			$return['res']=$res;
			return $return;
		}else if($data['street_name'] == '' && $data['district_id'] != ''){
			$district_id=$data['district_id'];
			$res=$street->where('district_id='.$district_id)->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else if($data['street_name'] == '' && $data['district_id'] == ''){
			$res=$street->select();
			$return['type']='select';
			$return['res']=$res;
			return $return;
		}else{
			return false;
		}
	}



	/**
	*修改街道/村
	*@param 
	*@return
	*/
	public function addStreet($data){
		$street=M('street');
		$res=$street->data($data)->add();
		// var_dump($res);die;
		return $res;
	}





	/**
	*查询/添加 具体地址
	*@param $data
	*@return
	*/
	public function place($data){
		$place=M('place');
		$return=array();
		//如果穿过来的地区名存在切街道的id也存在
		//则判断进行创建操作
		if($data['place_name'] != '' && $data['street_id'] != ''){
			$res=$place->data($data)->add();
			$return['type']='create';
			$return['res']=$res;		
			return $return;	
			//如果穿过来的地区名存在切街道的id也存在
			//则判断进行创建操作

		}else if($data['place_name'] == '' && $data['street_id'] != ''){
			$street_id=$data['street_id'];
			$res=$place->where('street_id='.$street_id)->select();
			// dump($res);exit;
			$return['type']='select';
			$return['res']=$res;
			return $return;		

			}else if($data['place_name'] == '' && $data['street_id'] == ''){
				$res=$place->select();
				// dump($res);exit;
				$return['type']='select';
				$return['res']=$res;
				return $return;
			}else{
				return false;
			}
	}





	/**
	*修改省
	*@param $data $province_id
	*@return
	*/
	public function updateProvince($province_id,$data){
		$province=M('province');
		return $province->where('id='.$province_id)->save($data);
	}





	/**
	*修改市
	*@param $data $city_id city
	*@return
	*/
	public function updateCity($city_id,$data){
		$city=M('city');
		return $city->where('id='.$city_id)->save($data);
	}





	/**
	*修改区
	*@param $data $district_id
	*@return
	*/
	public function updateDistrict($district_id,$data){
		$district=M('district');
		return $district->where('id='.$district_id)->save($data);
	}





	/**
	*修改街道
	*@param $data $street_id
	*@return
	*/
	public function updateStreet($street_id,$data){
		$street=M('street');
		return $street->where('id='.$street_id)->save($data);
	}





	/**
	*修改具体地址
	*@param $data $place_id
	*@return
	*/
	public function updatePlace($place_id,$data){
		$place=M('place');
		return $place->where('id='.$place_id)->save($data);
	}




	/**
	*通过id获得省份
	*@param 
	*@return
	*/
	public function queryProvinceById($province_id){
		return M('province')->where($province_id)->select();
	}





	/**
	*通过id获得市
	*@param 
	*@return
	*/
	public function queryCityById($city_id){
		return M('city')->where('id='.$city_id)->select();
	}





	/**
	*通过id获得区/县
	*@param 
	*@return
	*/
	public function queryDistrictById($district_id){
		return M('district')->where('id='.$district_id)->select();
	}





	/**
	*通过id获得街道/村
	*@param 
	*@return
	*/
	public function queryStreetById($street_id){
		return M('street')->where('id='.$street_id)->select();
	}	





	
	/**
	*通过id获得具体地址
	*@param 
	*@return
	*/
	public function queryPlaceById($place_id){
		return M('place')->where('id='.$place_id)->select();
	}	

}
?>
