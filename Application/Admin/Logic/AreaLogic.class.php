<?php 
namespace Admin\Logic;
use Think\Model;
/**
* 
*/
class AreaLogic extends Model{

	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=M('area');
	}
	public function queryarea($data){
		$res=$this->m->where($data)->select();
		return $res;
	}
}




 ?>