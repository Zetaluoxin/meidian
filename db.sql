drop database if exists md;
create database if not exists md collate 'utf8_general_ci';
use md;
set names utf8;

#用户
create table if not exists md_user(
id int primary key auto_increment,
username varchar(32) default '' comment '帐号',								
password varchar(128) default '' comment 'md5加密密码',								
group_id int(6) not null comment '所属用户组id',									
logintime datetime default now() comment '最后登录的时间',						
regtime datetime default now() comment '注册的时间',
lastloginid varchar(16) default '' comment '最后登录的id'
)engine=InnoDB comment '用户表';


insert md_user values(1,'sclg','sclg',1,now(),now(),'11.11.11.11.11');
insert md_user(username,password) values('xxx2','ooo3');
-- insert md_user values(3,'xxx3','ooo2',1,now());
-- insert md_user values(4,'xxx4','ooo1',2,now());








#用户详情
create table if not exists md_user_info(
id int primary key auto_increment,
user_id int not null comment '所属用户id', 								
nickname varchar(32) default '' comment '昵称',								
names varchar(32) default '' comment '名字',								
qq int not null comment 'qq号',										
companyname varchar(32) default '' comment '所属公司名称',							
address varchar(64) default '' comment '练习地址',								
postalcode int not null comment '邮政编码', 									
telephonenum int not null comment '用户手机号码',								
shopname varchar(32) default '' comment '所有店铺的名称',							
image varchar(128) default '' comment '头像图片储存地址 相对于 upload/'								
)engine=MyISAM comment '用户详情';

insert into md_user_info values(1,1,'小明','明道',111111111,'四川联广','凯越路一号',621000,1800000,'美美美发','www.baidu.com/imgage');







#用户分组
create table if not exists md_group(
id int primary key auto_increment,
group_name varchar(12) default '' comment '用户组名称'						
)engine=MyISAM comment '用户组';

insert into md_group values(1,'美发店用户');
insert into md_group values(2,'美点学院用户');
insert into md_group values(3,'广告经销商');
insert into md_group values(4,'广告主');
insert into md_group values(5,'视频管理员');
insert into md_group values(6,'游戏管理员');
insert into md_group values(7,'省代理');
insert into md_group values(8,'市代理');
insert into md_group values(9,'广告审判员');
insert into md_group values(10,'广告代理专员');
insert into md_group values(11,'美发店客户服务');
insert into md_group values(12,'美点学院客户服务');
insert into md_group values(13,'售后管理员');
insert into md_group values(14,'财务');
insert into md_group values(15,'系统管理员');





CREATE TABLE IF NOT EXISTS `md_access` (
  `role_id`smallint(6) unsigned NOT NULL,					#角色id
  `node_id` smallint(6) unsigned NOT NULL,					#节点id
  `level` tinyint(1) NOT NULL,							#等级
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;






CREATE TABLE IF NOT EXISTS `md_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,			#节点id
  `name` varchar(20) NOT NULL,						#节点名称（英文名，对应应用控制器、应用、方法名
  `title` varchar(50) DEFAULT NULL,						#节点中文名（方便看懂）
  `status` tinyint(1) DEFAULT '0',						#启用状态（同上）
  `remark` varchar(255) DEFAULT NULL,					#备注信息
  `sort` smallint(6) unsigned DEFAULT NULL,					#排序值（默认值为50）
  `pid` smallint(6) unsigned NOT NULL,					#父节点ID（如:方法pid对应相应的控制器
  `level` tinyint(1) unsigned NOT NULL,					#节点类型：1:表示应用（模块）；2:表示控制器；3：表示方法
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;






CREATE TABLE IF NOT EXISTS `md_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT, 			#角色id
  `name` varchar(20) NOT NULL,						#角色名称
  `pid` smallint(6) DEFAULT NULL,						#父角色对应点id
  `status` tinyint(1) unsigned DEFAULT NULL,					#启用状态
  `remark` varchar(255) DEFAULT NULL,					#备注信息
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;






CREATE TABLE IF NOT EXISTS `md_role_user` (				#角色id
  `role_id` mediumint(9) unsigned DEFAULT NULL,				#用户id
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




#广告表

create table if not exists md_advert(
id int primary key auto_increment,
user_id int not null comment '上传用户的id ',	
ad_url varchar(128) default '' comment '链接地址',						
ad_name varchar(32) default '' comment '广告的名称',							
ad_format varchar(12) default '' comment '广告的格式',							
ad_company varchar(32) default '' comment '广告投放主',						
ad_area varchar(12) default '' comment '在终端产品展示的区域',							
ad_place varchar(12) default '' comment '投放地区',							
ad_putnum int not null comment '投放数量',							
ad_time datetime not null comment '投放时间',								
ad_status enum('未上架','已上架','已下架') default '未上架',			#上下架情况
ad_examine enum('通过','驳回','冻结','未审核') default '未审核',		#审核状态
ad_pay enum('已付费','未付费','免费') default '未付费'			#付费情况
)ENGINE=MyISAM comment '广告表';

-- insert into md_advert values(1,1,'王老吉','mp4','四川联广','主页','四川',1000,now(),'已上架','通过','已付费');

#广告投放主
create table if not exists md_company(
  id int primary key auto_increment,
  com_name varchar(32) not null comment '广告主名称',
  com_contact varchar(128) not null comment '联系方式',
  com_logo_big varchar(32) not null comment '大logo',
  com_logo_small varchar(32) not null comment '小logo'
)ENGINE=MyISAM comment '广告主表';




#理发店
create table if not exists md_barbershop(
id int primary key auto_increment,
user_id int not null comment '理发店店主id',								
barbershop_name varchar(12) default '' comment '理发店名称',					
barbershop_address varchar(64) default '' comment '理发店地址',					
barbershop_productnum int not null comment '终端投放数量',						
barbershop_cash int not null comment '余额',								
babershop_qrcode varchar(32) default '' comment '店铺二维码存放路径'					
)ENGINE=MyISAM comment '理发店';

insert into md_barbershop values(1,1,'美美美发','凯越路一号',1000,1000,'www.baidu.com/image');






#视频
create table if not exists md_video(
id int primary key auto_increment,
user_id int not null comment '上传用户id',								
video_image varchar(128) default '' comment '视频预览图地址',
video_url varchar(128) default '' comment '视频地址 相对于 upload/',					
video_name varchar(12) default '' comment '视频名称',						
video_size varchar(12) default '' comment '视频大小',						
video_area varchar(12) default '' comment '播放区域',						
video_type enum('视频教程','娱乐视频','电影预告片') not  null comment '视频分类',		
video_productnum int not null comment '投放终端数量',							
video_time datetime default now() not null comment '传时间',					
video_status enum('上线','未上线') default '未上线' comment '线状态 默认未上线'				
)ENGINE=MyISAM comment '视频表';

insert into md_video values(1,1,'www.imgage.com','wfewrwerewre','动物世界','400MB','四川','娱乐视频',1000,now(),'上线');






#终端
create table if not  exists md_product(
id int primary key auto_increment,
barbershop_id int not null comment '终端所在店铺id',							
product_type enum('单面机','双面机','挂式机') not null comment '机型',			
product_maccode varchar(24) default '' comment 'mac码',					
product_batch int not null comment '终端编号',							
product_status enum('0','1') not null comment '运行状态:1为正在线', 						
product_fix enum('0','1') default '1' comment '报修状态: 0为报修'					
)ENGINE=MyISAM comment '终端表';

insert into md_product values(1,1,'双面机','11.11.11.11.1',4325346456544,1,1);






#地区
create table if not  exists md_place(
id int primary key auto_increment,
place_name varchar(32) default '' comment '地区名'						
)ENGINE=MyISAM comment '地区表';

insert into md_place values(1,'成都');
insert into md_place values(2,'绵阳');
insert into md_place values(3,'德阳');
insert into md_place values(4,'广汉');
insert into md_place values(5,'武都');
insert into md_place values(6,'江油');
insert into md_place values(7,'河北');
insert into md_place values(8,'石桥铺');






#地区分组
create table if not exists md_placegroup(
id int primary key auto_increment,
place_id int not null comment '所属地区id',									
group_name varchar(12) default '' comment '分组名'						
)ENGINE=MyISAM comment '地区分组表';

insert into md_placegroup values(1,1,'成都一组');





#用户-分组 中间表
create table if not exists md_placegroup_user(
id int primary key auto_increment,
user_id int not  null comment '用户id',								
placegroup_id int  not null comment '地区分组id'							
)ENGINE=MyISAM comment '用户-分组 中间表';

insert  into md_placegroup_user values(1,1,1);