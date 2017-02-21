<?php
	namespace Admin\Logic;
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
				$img['user_id'] = session("uid");
				// $img['user_id'] = 1;
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
				$img['user_id'] = session("uid");
				// $video['user_id'] = 1;
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
			return $this->v->where($data)->select();
		}

		//修改图片素材
		function update_Img($id,$data){
			return $this->m->where("id='%d'",array($id))->save($data);
		}

		//修改视频素材
		function update_Video($id,$data){
			return $this->v->where("id='%d'",array($id))->save($data);
		}

		//删除图片素材
		function del_Img($id){
			return $this->m->where("id='%d'",array($id))->delete();
		}

		//删除视频素材
		function del_Video($id){
			return $this->v->where("id='%d'",array($id))->delete();
		}
	}
?>