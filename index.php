<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件
			// $token = 'weixin';
			// $timestamp = $_GET['timestamp'];
			// $signature = $_GET['signature'];
			// $nonce = $_GET['nonce'];
			// $echostr = $_GET['echostr'];
			// // 1）将token、timestamp、nonce三个参数进行字典序排序
			// $arr = array($token,$timestamp,$nonce);
			// sort($arr);
			// // 2）将三个参数字符串拼接成一个字符串进行sha1加密
			// $str = sha1(join('',$arr));
			// // 3）开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
			// if($str == $signature){
			// 	die($echostr);
			// }else{
   //          	die("失败");
   //          }
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单