<?php 
namespace Home\Logic;
use Think\Model;
/**
* Product
*/
class ProductLogic extends Model{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=M('product');
	}



	/**
	* 查询终端
	*@param
	*@return
	*/
	public function getProduct($data){
		$res=$this->m->where($data)->select();
		return $res;
	}

	//修改终端信息
	public function update_Product($mac,$data){
		return $this->m->where("product_maccode='%s'",array($mac))->save($data);
	}
	//查询理发店的终端
	public function getProductByBabershop($barbershop_id){
		return $this->m->where("barbershop_id=".$barbershop_id)->select();
	}
	//查询接到的终端
	public function getProductByStreet($street_id){
		return $this->m->where("street_id=".$street_id)->select();
	}
	//查询区县的中段
	public function getProductByDistrict($district_id){
		return $this->m->where("district_id=".$district_id)->select();
	}
	//查询市区的中段
	public function getProductByCity($city_id){
		return $this->m->where("city_id=".$city_id)->select();
	}
	//查询省份的中段
	public function getProductByProvince($province_id){
		return $this->m->where("province_id=".$province_id)->select();
	}
}
 ?>