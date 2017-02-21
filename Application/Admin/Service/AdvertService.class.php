<?php
	/*
	广告接口
	版本：1.0
	作者：杜勇
	*/
	interface Advert{
		
		function index(){

		}
		/**
		* 添加广告信息
		*@param 可上传的格式根据情况调整
		*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
		* 
		*/
		function addAdvert();

		/**
		* 获取广告
		*@param $data为提交参数
		*@return 成功返回查询结果集的二维数组，失败返回false;
		* 
		*/
		function getAdvert();

		/**
		* 获取广告主
		*@param $data为提交参数,支持模糊查询
		*@return 成功返回查询结果集的二维数组，失败返回false;
		* 
		*/
		function getCompany()

		/**
		* 修改广告
		*@param $data为提交参数
		*@return 成功返回操作条目数，失败返回false;
		* 
		*/
		function updateAdvert();

		/**
		* 删除广告
		*@param $data为广告id
		*@return 成功返回删除数目，失败返回false;
		* 
		*/
		function delAdvert();




	}
?>