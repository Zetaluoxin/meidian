<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
use \Workerman\Worker;
use \Workerman\Lib\Timer;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;
use \GatewayWorker\Lib\Db;
  require_once __DIR__.'\Common\functions.php';
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{   
    
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {   
      print_r($client_id.'    ');
      S('client_id',$client_id);
      // $db1 = Db::instance('db1');
      // $res = D("Online","Logic")->getOnline($client_id);
        Gateway::sendToClient($client_id,json_encode(array(
              'type'  =>  'init',
              "client_id" =>  $client_id
              // 'data'=>$res
          )));
    }
    
   /**
    * 当客户端发来消息时触发
    *规定客户端请求格式 {'type':xx,"c":xx,"a":xx}
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {    
        $data = json_decode($message,true);
        switch ($data['type']) {
          case 'pong':
            print_r($message);
            break;
          case 'ly':
              //路由
              if(!array_key_exists('c', $data)){
                $data['c'] = 'common';
              }
              $obj = D($data['c']);
              if(!array_key_exists('a', $data)){
                //默认执行index方法;
                $data['a'] = 'index';
              }
              if(count($data) > 3){
              	$obj->$data['a']($data);
          	  }else{
          	  	$obj->$data['a']();
          	  }
              break;
          default:
            # code...
            break;
        }
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {  
      print_r($client_id.'duankai    ');
      $db1 = Db::instance('db1');
      $online = D("Online",'logic');
      $pro = D("product",'logic');
      //查询在线终端表中对应client_id的信息
      $res = $online->getOnline($client_id);
      if(!$res){
        die('none  ');
      }else{
        print_r($res[0]['mac']);
        $data = array(
          'last_time'=>$res[0]['start_time'],
          'product_status'=>'0'
        );
        $db1->beginTrans();
        try{
          //修改终端状态和最后一次登陆时间
          $reg = $pro->update_Product($data,$res[0]['mac']);
          //从在线表中删除该终端
          $ret = $online->del_outline($res[0]['mac']);
        }catch(Exception $e){
          $db1->rollBackTrans();
          print_r('shibai');
          return;
        }
        $db1->commitTrans();
        print_r('chenggong');
      }
   }
}
