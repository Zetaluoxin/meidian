<?php
	namespace Home\Model;
	use Think\Model\RelationModel;
	class AdvertModel extends RelationModel{
		protected $_link = array(
			// 'place' => array(
			// 	'mapping_type' => self::MANY_TO_MANY,
	  //           'class_name' => 'place',
	  //           'foreign_key' => 'ad_id',
	  //           'relation_foreign_key'  =>  'place_id',
	  //           'relation_table'    =>  'md_ad_place'
			// ),
			'imgfile' => array(
				'mapping_type'  => self::BELONGS_TO,   
				 'class_name'    => 'file_img',   
				  'foreign_key'   => 'img_id',    
				  'mapping_name'  => 'imgFile'
			),
			'videofile' => array(
				'mapping_type'  => self::BELONGS_TO,   
				 'class_name'    => 'file_video',   
				  'foreign_key'   => 'video_id',    
				  'mapping_name'  => 'videoFile'
			)
		);
	}
?>