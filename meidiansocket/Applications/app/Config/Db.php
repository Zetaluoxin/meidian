<?php
	namespace Config;
	/**
	 * mysql配置
	 * @author walkor
	 */
	class Db
	{
	    /**
	     * 数据库的一个实例配置，则使用时像下面这样使用
	     * $user_array = Db::instance('db1')->select('name,age')->from('users')->where('age>12')->query();
	     * 等价于
	     * $user_array = Db::instance('db1')->query('SELECT `name`,`age` FROM `users` WHERE `age`>12');
	     * @var array
	     *注意 $db1是数据库名 获取实例时用db1
	     */
	    public static $db1 = array(
	        'host'    => '127.0.0.1',
	        'port'    => 3306,
	        'user'    => 'root',
	        'password' => '',
	        'dbname'  => 'md',
	        'charset'    => 'utf8',
	    );
	}
?>