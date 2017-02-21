<?php
namespace Admin\Controller;
use Think\Controller;
require_once './GatewayClient/Gateway.php';
use GatewayClient\Gateway;
class CommonController extends Controller{
	function __construct(){
			parent::__construct();
			// $this->_init();
			Gateway::$registerAddress = '127.0.0.1:1234';
			if(array_key_exists('uid',session())){


				//登录强行跳转
				if(ACTION_NAME  == 'login'){
					redirect('/meidian/index.php/admin/index/index');	
				}



				// $this->assign("id",session("id"));
				// $this->assign("admin",session("admin"));
				if($this->auth()){
					return;
				}else{
					// $this->error("权限不足，正在返回......");//如果是异步请求请注释此代码
					// $this->getinfo(false,"权限不足",'');//如果是同步请求请注释此代码
				}
			}else{	

				//未登录强行跳转		
				if(ACTION_NAME  !== 'login'){					
					$url='/meidian/index.php/admin/index/login';
					redirect($url);
				}				
			}
		}
		function getinfo($status,$info='',$data=''){
			$val['status'] = $status;
			$val['info'] = $info;
			$val['data'] = $data;
			return $this->ajaxReturn($val);
		}
		function upload(){//上传文件
			$config = array(    
				'maxSize'    =>    0,
				'rootPath'	=>		'./Public/Uploads/',
				'savePath'   =>    '',    
				'saveName'   =>    time().'_'.mt_rand(),  
				'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','mp3','mp4','mov','flac'), 
				'autoSub'    =>    true,    
				'subName'    =>    array('date','Ymd')
			);
			//实例化上传类
			$upload = new \Think\Upload($config);
			//上传文件
			$info = $upload->upload();
			if($info){
				foreach ($info as $val) {
					$type = explode('/', $val['type']);
					if($type[0] == 'image'){
						$arr['big_img'] = $val['savepath'].$val['savename'];
						#生成缩略图
						$image = new \Think\Image();
						$image->open('./Public/Uploads/'.$val['savepath'].$val['savename']);
						$image->thumb(150,150)->save('./Public/Uploads/'.$val['savepath']."thumb".$val['savename']);
						$arr['small_img'] = $val['savepath']."thumb".$val['savename'];
					}
					if($type[0] == 'video'){
						$arr['ad_url_video'] = $val['savepath'].$val['savename'];
					}
					if($type[0] == 'audio'){
						$arr['ad_url_audio'] = $val['savepath'].$val['savename'];
					}
					$arr['filename'] = $val['name'];
					$arr['filesize'] = $val['size'];
				}
				return $arr;
			}
			return $upload->getError();
		}

		function check_verify($code, $id = ''){    //验证码校验
			$verify = new \Think\Verify();    
			return $verify->check($code, $id);
		}

		function page($pageCount,$model,$data){
			$m = M($model); // 实例化User对象
			$count      = $m->where($data)->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,$pageCount);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $m->where($data)->order('createtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			return array("list"=>$list,"show"=>$show);
		}

		function verify(){//验证码生成
			$config =    array(    
				'fontSize'		=>		30,    // 验证码字体大小    
				'length'		=>		4,     // 验证码位数    
				'useNoise'		=>		false, // 关闭验证码杂点
				'useImgBg'		=>		false,//是否使用背景图片	
			);
			$Verify = new \Think\Verify($config);
			$Verify->entry();
		}

		function uploadify(){//异步上传图片处理
			foreach ($_FILES as $v) {
				if($v['error'] != 0){
					$this->getinfo(false,'上传出错',$v['error']);
				}else{
					$info = $this->upload();
					is_array($info)?$this->getinfo(true,'上传成功',$info):$this->getinfo(false,'上传失败',$info);
				}
			}
		}

		function auth($mode='url',$relation='and'){
			$Auth = new \Think\Auth();
			  //需要验证的规则列表,支持逗号分隔的权限规则或索引数组
			  $name = CONTROLLER_NAME . '/' . ACTION_NAME;
			  // dump($name);die;
			  //当前用户id
			  $uid = session('uid');
			  //分类
			  $type = MODULE_NAME;
			  //执行check的模式
			  $mode = $mode;
			  //'or' 表示满足任一条规则即通过验证;
			  //'and'则表示需满足所有规则才能通过验证
			  $relation = $relation;
			  if ($Auth->check($name, $uid, $type, $mode, $relation)) {
			  	return true;
			  }else {
			   	return false;
			  }
		}

		/**
		 * 初始化
		 * @return
		 */
		private function _init() {
			// 如果已经登录
			$isLogin = $this->isLogin();
			if(!$isLogin && ACTION_NAME  !== 'login') {
				// 跳转到登录页面
			// redirect('/meidian/index.php/admin/index/login',2,'页面跳转中');			
					$url='/meidian/index.php/admin/index/login';
					redirect($url);				
			}
			// else{
			// 	$url='/meidian/index.php/admin/index/index';
			// 	redirect($url);	
			// }
		}



		/**
		 * 获取登录用户信息
		 * @return array
		 */
		public function getLoginUser() {
			return session('uid');
		}



		/**
		 * 判定是否登录
		 * @return boolean 
		 */
		public function isLogin() {
			$user = $this->getLoginUser();
			if($user && is_array($user)) {
				return true;
			}
			return false;
		}


}

?>