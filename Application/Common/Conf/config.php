<?php
define('COMMENT_DELIM', '%@@*@@%');
define('OUT_TIME', 10);//终端在线过期时间
define('APPID', 'wx0f23c005cde0cb71');
define('APPSECRET', '65e8fcc305f1ab5da0808cda7edf44a9');
return array(
	//'配置项'=>'配置值'
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'md',
	'DB_USER' => 'root',
	'DB_PWD' => '',
	'DB_PORT' => 3306,
	'DB_PREFIX' => 'md_',
	'DB_CHARSET' => 'utf8',
	'TMPL_L_DELIM' => '<{',
	'TMPL_R_DELIM' => '}>',
	'SHOW_PAGE_TRACE' => true,
	"URL_MODEL" => 2,
	'URL_CASE_INSENSITIVE' => true, 
	'URL_HTML_SUFFIX'=>'.html',
	"HTML_FILE_SUFFIX"=>'.html',
	// 'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
	// 'DEFAULT_ACTION'        =>  'login', // 默认操作名称
	// 'URL_MODULE_MAP'    =>    array('index'=>'admin'),//模块映射
	'TMPL_PARSE_STRING'  =>array(    
		 '__PUBLIC__' => 'http://localhost/meidian/Public', // 更改默认的/Public 替换规则    
		 '__JS__'     => 'http://localhost/meidian/Public/JS/', // 增加新的JS类库路径替换规则    
		 '__UPLOAD__' => 'http://localhost/meidian/Public/Uploads', // 增加新的上传路径替换规则)
		 '__APP__'	=> 'http://localhost/meidian/index.php'
	 ),
	 'AUTH_CONFIG' => array(
	  'AUTH_ON' => false, //认证开关
	  'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
	  'AUTH_GROUP' => 'md_auth_group', //用户组数据表名
	  'AUTH_GROUP_ACCESS' => 'md_auth_group_access', //用户组明细表
	  'AUTH_RULE' => 'md_auth_rule', //权限规则表
	  'AUTH_USER' => 'md_user'//用户信息表
	 )
	// 配置文件增加设置
// USER_AUTH_ON 是否需要认证
// USER_AUTH_TYPE 认证类型
// USER_AUTH_KEY 认证识别号
// REQUIRE_AUTH_MODULE  需要认证模块
// NOT_AUTH_MODULE 无需认证模块
// USER_AUTH_GATEWAY 认证网关
// RBAC_DB_DSN  数据库连接DSN
// RBAC_ROLE_TABLE 角色表名称
// RBAC_USER_TABLE 用户表名称
// RBAC_ACCESS_TABLE 权限表名称
// RBAC_NODE_TABLE 节点表名称
);