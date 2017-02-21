<?php
	namespace Home\Controller;
	use Home\Controller\CommonController;
	class FileController extends CommonController{
		private $m;

		function __construct(){
			parent::__construct();
			$this->m = D("File","Logic");
		}

		/**
		* 添加图片素材
		*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function addImg(){
			if(IS_POST){
				$data['small_img'] = json_decode($_POST['small_img']);
				$data['big_img'] = json_decode($_POST['big_img']);
				$data['img_name'] = json_decode($_POST['img_name']);
				$data['img_size'] = json_decode($_POST['img_size']);
			}
			if(IS_GET){
				$data['small_img'] = json_decode($_GET['small_img']);
				$data['big_img'] = json_decode($_GET['big_img']);
				$data['img_name'] = json_decode($_POST['img_name']);
				$data['img_size'] = json_decode($_POST['img_size']);
			}
			//$data['user_id'] = session("id");
			$data['user_id'] = 1;
			$res = $this->m->insert_Img($data);
			$res?$this->getinfo(true,'上传成功',$res):$this->getinfo(false,'上传失败');
		}

		/**
		* 添加视频素材
		*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function addVideo(){
			if(IS_POST){
				$data['video_url'] = json_decode($_POST['video_url']);
				$data['video_name'] = json_decode($_POST['video_name']);
				$data['video_size'] = json_decode($_POST['video_size']);
			}
			if(IS_GET){
				$data['video_url'] = json_decode($_GET['video_url']);
				$data['video_name'] = json_decode($_GET['video_name']);
				$data['video_size'] = json_decode($_POST['video_size']);
			}
			$res = $this->m->insert_Video($data);
			$res?$this->getinfo(true,'上传成功',$res):$this->getinfo(false,'上传失败');
		}

		/**
		* 查询图片素材
		*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function getImg(){
			if(IS_POST){
				$data = I("post.");
			}
			if(IS_GET){
				$data = I("get.");
			}
			$res = $this->m->select_Img($data);
			if($res){
				$this->assign("images",$res);
				return $res;
			}
			return false;
		}

		/**
		* 查询视频素材
		*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function getVideo(){
			if(IS_POST){
				$data = I("post.");
			}
			if(IS_GET){
				$data = I("get.");
			}
			$res = $this->m->select_Video($data);
			if($res){
				$this->assign("video",$res);
				return $res;
			}
			return false;
		}

		/**
		* 编辑素材
		*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function updateFile(){
			if(IS_POST){
				$data['status'] = I("post.status");
				$id = I("post.id");
			}
			if(IS_GET){
				$data['status'] = I("post.status");
				$id = I("post.id");	
			}
			$res = $this->m->update_File($id,$data);
			$res?$this->getinfo(true,'修改成功',$res):$this->getinfo(false,'修改失败');
		}

		/**
		* 删除素材
		*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function delFile(){
			if(IS_POST){
				$id = I("post.id");
			}
			if(IS_GET){
				$id = I("get.id");
			}
			$res = $this->m->del_File($id);
			$res?$this->getinfo(true,'删除成功',$res):$this->getinfo(false,'删除失败');
		}
	}
?>