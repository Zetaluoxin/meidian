<?php 
namespace Admin\Logic;
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
	* 添加终端
	*@param
	*@return
	*/
	public function addProduct($data=''){
		$res=$this->m->data($data)->add();
		return $res;
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
	public function update_Product($id,$mac,$data){
		return $this->m->where("id='%d' or product_maccode='%s'",array($id,$mac))->save($data);
	}

	//删除终端
	public function del_Product($id){
		return $this->m->where("id='%d'",array($id))->delete();
	}

	//查询终端
	public function product($data){
		// dump('haha1');
		$res=$this->m->where($data)->select();
		// dump($res);
		return $res;
	}
	//查询省份的id
	public function getProvinceId($user_id){
		$PA=M('province_agent');
		$res=$PA->where('uid='.$user_id)->select();
		return $res[0]['province'];
	}
	//查询市的id
	public function getCityId($user_id){
		$CA=M('city_agent');
		$res=$CA->where('uid='.$user_id)->select();
		return $res[0]['city_id'];
	}

}
 ?>