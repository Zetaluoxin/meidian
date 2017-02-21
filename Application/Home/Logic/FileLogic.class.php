<?php
	namespace Home\Logic;
	use Think\Model\RelationModel;
	class FileLogic extends RelationModel{
		Protected $autoCheckFields = false;
		private $m;
		private $v;
		function __construct(){
			parent::__construct();
			$this->m = M("File_img");
			$this->v = M("File_video");
		}

		//添加图片素材
		function insert_Img($data){
			$this->m->startTrans();
			foreach ($data['small_img'] as $key => $val) {
				$img['small_img'] = $val;
				$img['big_img'] = $data['big_img'][$key];
				$img['img_name'] = $data['img_name'][$key];
				$img['img_size'] = $data['img_size'][$key];
				// var_dump($img);
				$res = $this->m->add($img);
				if(!$res){
					$this->m->rollback();
					return false;
				}
			}
			$this->m->commit();
			return true;
		}

		//添加视频素材
		function insert_Video($data){
			$this->v->startTrans();
			foreach ($data['video_url'] as $key => $val) {
				$video['video_url'] = $val;
				$video['video_name'] = $data['video_name'][$key];
				$video['video_size'] = $data['video_size'][$key];
				$res = $this->v->add($video);
				if(!$res){
					$this->v->rollback();
				}
			}
			$this->v->commit();
			return true;
		}

		//查询图片素材
		function select_Img($data){
			return $this->m->where($data)->select();
		}

		//查询视频素材
		function select_Video($data){
			return $this->m->where($data)->select();
		}

		//修改素材
		function update_File($id,$data){
			return $this->m->where("id='%d'",array($id))->save($data);
		}

		//删除素材
		function del_File($id){
			return $this->m->where("id='%d'",array($id))->delete();
		}
		//通过id查询图片
		public function getImgById($img_id){
			return $this->m->where("id=".$img_id)->select();
		}
		//通过id查询视频
		public function getVideoById($viode_id){
			return $this->v->where("id=".$viode_id)->select();
		}
	}
?>