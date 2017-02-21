drop database if exists md;
create database if not exists md collate 'utf8_general_ci';
use md;
set names utf8;

#用户
create table if not exists md_user(
id int primary key auto_increment,
username varchar(32) default '' comment '帐号',								
password varchar(128) default '' comment 'md5加密密码',								
logintime datetime default now() comment '最后登录的时间',						
regtime datetime default now() comment '注册的时间',
lastloginip varchar(16) default '' comment '最后登录的ip',
nickname varchar(32) default '' comment '昵称',								
names varchar(32) default '' comment '名字',								
qq varchar(16) not null comment 'qq号',						
province_id int not null comment '理发店所在的省份',					
city_id int not null comment '理发店所在的市',					
district_id int not null comment '理发店所在的区',	
street_id int not null comment '理发店所在的街道',								
postalcode int not null comment '邮政编码', 									
telephonenum varchar(16) not null comment '用户手机号码',															
image_id int not null comment '头像图片储存地址 相对于 upload/',
company_id int  comment '所属公司id'					
)engine=MyISAM comment '用户表';


insert into md_user(username,password) values('123','202cb962ac59075b964b07152d234b70');

create table if not exists md_online(
	id int primary key auto_increment,
	mac varchar(32) not null comment 'mac地址',
	client_id varchar(32) not null comment 'client_id',
	start_time datetime not null comment '上线时间'
)comment '在线终端表';






-- ----------------------------
-- Table structure for think_auth_group
-- ----------------------------
CREATE TABLE  if  not exists md_auth_group (
 `id` mediumint(8) unsigned primary key NOT NULL AUTO_INCREMENT,
 `title` char(100) NOT NULL DEFAULT '' comment '用户组中文名',
 `status` tinyint(1) NOT NULL DEFAULT '1' comment '状态 1为正常 0为禁用',
 `rules` char(80) NOT NULL DEFAULT '' comment '用户组拥有的规则id,多个规则","隔开'
) ENGINE=MyISAM AUTO_INCREMENT=2 COMMENT='用户组表';
 
-- ----------------------------
-- Records of think_auth_group
-- ----------------------------
INSERT INTO `md_auth_group` VALUES ('1', '管理组', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15');
INSERT INTO `md_auth_group` VALUES ('2', '用户组', '1', '1,5');
-- ----------------------------
-- Table structure for think_auth_group_access
-- ----------------------------
CREATE TABLE `md_auth_group_access` (
 `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
 `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
 UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
 KEY `uid` (`uid`),
 KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';
 
-- ----------------------------
-- Records of think_auth_group_access
-- ----------------------------
INSERT INTO `md_auth_group_access` VALUES ('1', '1');
 
-- ----------------------------
-- Table structure for think_auth_rule
-- ----------------------------
CREATE TABLE `md_auth_rule` (
 `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
 `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
 `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
 `type` char(80) NOT NULL,
 `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
 PRIMARY KEY (`id`),
 UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='规则表';
 
-- ----------------------------
-- Records of think_auth_rule
-- ----------------------------
INSERT INTO `md_auth_rule` VALUES ('1', 'Index/index', '首页', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('2', 'Index/addAdvert', '新广告', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('3', 'Index/getAdvert', '广告列表', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('4', 'Index/addUser', '添加用户', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('5', 'Index/getUser', '用户列表', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('6', 'Index/getAuth', '权限查询', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('7', 'Index/addFile', '素材上传', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('8', 'Index/getFile', '查询素材', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('9', 'Index/addCompany', '添加广告主', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('10', 'Index/getCompany', '查询广告主', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('11', 'Index/addBarbershop', '添加店铺', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('12', 'Index/getbarbershop', '查询店铺', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('13', 'Index/addProduct', '添加终端', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('14', 'Index/getProduct', '查询终端', '1', 'Admin', '');
INSERT INTO `md_auth_rule` VALUES ('15', 'Index/addPlace', '添加地区', '1', 'Admin', '');










-- INSERT INTO `md_auth_rule` VALUES ('1', 'User/index', '用户首页', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('2', 'User/addUser', '添加用户', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('3', 'User/addUserGroupByUserId', '加入用户组', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('4', 'User/addUserInfo', '编辑用户信息', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('5', 'User/login', '用户登录', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('6', 'Advert/addAdvert', '广告上传', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('7', 'Advert/getAdvert', '广告查询', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('8', 'Advert/getCompany', '广告主查询', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('9', 'Advert/updateAdvert', '广告审核', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('10', 'Advert/delAdvert', '广告删除', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('11', 'User/getUser', '用户查询', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('12', 'User/getAllUser', '用户查询', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('13', 'User/delUser', '用户删除', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('15', 'Advert/saveAdvert', '广告修改', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('16', 'File/addImg', '图片上传', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('17', 'File/addVideo', '视频上传', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('18', 'File/getImg', '查询图片', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('19', 'File/getVideo', '查询视频', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('20', 'File/updateFile', '文件编辑', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('21', 'File/delFile', '文件删除', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('22', 'Company/addCom', '广告主新增', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('23', 'Company/getName', '查询广告主名字', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('24', 'Company/updateCompany', '广告主修改', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('25', 'Barbershop/addBarbershop', '添加店铺', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('26', 'Barbershop/queryBarbershop', '查询店铺', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('27', 'Barbershop/updateBarbershop', '店铺修改', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('28', 'Product/addProduct', '添加终端', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('29', 'Product/getProduct', '查询终端', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('30', 'Product/updateProduct', '编辑终端', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('31', 'Product/delProduct', '删除终端', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('32', 'Area/queryArea', '查询区域', '1', 'Admin', '');
-- INSERT INTO `md_auth_rule` VALUES ('33', 'Area/updatePlace', '修改地区', '1', 'Admin', '');

























#广告表
create table if not exists md_advert(
id int primary key auto_increment,							
ad_name varchar(32) default '' comment '广告的名称',							
ad_company_id int comment '广告投放主id',	
ad_area_id int comment '展示区域id',					
ad_province_id int not null comment '理发店所在的省份',					
ad_city_id int not null comment '理发店所在的市',					
ad_district_id int not null comment '理发店所在的区',	
ad_street_id int not null comment '理发店所在的街道',
barbershop_id int not null comment '理发店名称id',
img_id int comment '图片id',
video_id int comment '视频id',	
ad_text text comment '广告描述',						
ad_putnum int not null comment '投放终端数量',							
ad_time datetime not null comment '投放时间',								
ad_status enum('未上架','已上架','已下架') default '未上架',			#上下架情况
ad_examine enum('通过','驳回','冻结','未审核') default '未审核',		#审核状态
ad_pay enum('已付费','未付费','免费') default '未付费'			#付费情况
)ENGINE=MyISAM comment '广告表';

#insert into md_advertisement values(1,1,'王老吉','mp4','四川联广','主页','四川',1000,now(),'已上架','通过','已付费');
-- insert into md_advert(ad_url) values("a.jpg"),("b.jpg"),("c.jpg");
#广告投放主
create table if not exists md_company(
  id int primary key auto_increment,
  user_id int not null comment '维护者id',
  com_name varchar(32) not null comment '广告主名称',
  province_id int not null comment '理发店所在的省份',					
  city_id int not null comment '理发店所在的市',					
  district_id int not null comment '理发店所在的区',	
  street_id int not null comment '理发店所在的街道',
  barbershop_id int not null comment '理发店名称id'
)ENGINE=MyISAM comment '广告主表';

insert into md_company(com_name,province_id) values('哈哈',1),("呵呵",1);


#图片素材表
create table if not exists md_file_img(
	id int primary key auto_increment,
	big_img varchar(64) not null comment '原图',
	small_img varchar(64) not null comment '缩略图',
	img_name varchar(128) not null comment '文件名',
	img_size varchar(16) not null comment '文件大小',
	user_id int not null comment '上传用户id',
	status enum('已上线','未上线') default '未上线' comment '文件状态'
)ENGINE=MyISAM COMMENT '图片素材表';

#视频素材表
create table if not exists md_file_video(
	id int primary key auto_increment,
	video_url varchar(64) not null comment '视频地址',
	video_name varchar(64) not null comment '视频名称',
	video_size varchar(16) not null comment '文件大小',
	user_id int not null comment '上传用户id',
	status enum('已上线','未上线') default '未上线' comment '文件状态'
)ENGINE=MyISAM COMMENT '视频素材表';

#理发店
create table if not exists md_barbershop(
id int primary key auto_increment,			
user_id int not null comment '店主id',				
barbershop_name varchar(128) default '' comment '理发店名称',	
barbershop_province int not null comment '理发店所在的省份',					
barbershop_city int not null comment '理发店所在的市',					
barbershop_district int not null comment '理发店所在的区',					
barbershop_street int not null comment '理发店所在的街道',					
barbershop_cash float(8,2) default 0 comment '余额',								
babershop_qrcode varchar(32) default '' comment '店铺二维码存放路径'					
)ENGINE=MyISAM comment '理发店';

-- insert into md_barbershop values(1,1,'美美美发','凯越路一号',1000,'www.baidu.com/image');






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
province_id int not null comment '理发店所在的省份',					
city_id int not null comment '理发店所在的市',					
district_id int not null comment '理发店所在的区',	
street_id int not null comment '理发店所在的街道',
barbershop_id int not null comment '终端所在店铺id',							
product_type enum('单面机','双面机','挂式机') not null comment '机型',			
product_maccode varchar(24) default '' comment 'mac码',					
product_batch varchar(32) default '' comment '终端编号',							
product_status enum('0','1') default '0' comment '运行状态:1为正在线', 						
product_fix enum('0','1') default '1' comment '报修状态: 0为报修'	,
last_time datetime default now() comment '最后登录时间'				
)ENGINE=MyISAM comment '终端表';

-- insert into md_product values(1,1,'双面机','11.11.11.11.1',4325346456544,1,1);






create table if not exists `md_where` (
`id` int not null primary key auto_increment,
`where_name` varchar(50) not null comment '地区名字',
`parentid` int default '0' comment '所属上级id,最高级为0',
`parentid_list` varchar(20) default '0' comment '分类的层级关系，从最高级到自己，请用逗号隔开',
`depth` varchar(10) default null comment '深度，从1递增',
`state` varchar(10) default '1' comment '状态：0禁用，1启用',
`priority` varchar(10) default '0'comment '优先级，越大，同级显示的时候越靠前'
)ENGINE=MyISAM comment '地区';

insert into `md_where` values(1,'四川省',0,'1','1','1','0');




create table if not exists`md_province`(
`id` int not null primary key auto_increment,
`province_name` varchar(64	) not null comment '省（级）名称'
)ENGINE=MyISAM comment '省';
insert into `md_province` values(1,'四川');

create table if not exists`md_city`(
`id` int not null primary key auto_increment,
`city_name` varchar(64) not null comment '市（级）名称',
province_id int not null 
)ENGINE=MyISAM comment '市';
insert into `md_city` values(1,'成都',1);
insert into `md_city` values(2,'绵阳',1);
insert into `md_city` values(3,'德阳',1);
insert into `md_city` values(4,'南充',1);

create table if not exists`md_district`(
`id` int not null primary key auto_increment,
`district_name` varchar(64) not null comment '区/县（级）名称',
`city_id` int not null 
)ENGINE=MyISAM comment '区/县';
insert into `md_district` values(1,'涪城区',2);
insert into `md_district` values(2,'高新区',2);
insert into `md_district` values(3,'游仙区',2);
insert into `md_district` values(4,'三台县',2);
insert into `md_district` values(5,'江油市',2);

create table if not exists`md_street`(
`id` int not null primary key auto_increment,
`street_name` varchar(64) not null comment '街道/村（级）名称',
`district_id` int not null 
)ENGINE=MyISAM comment '街道/村';
insert into `md_street` values(1,'石桥铺村',2);
insert into `md_street` values(2,'凯越路一号',3);
insert into `md_street` values(3,'长虹大道',1);


create table if not exists`md_place`(
`id` int not null primary key auto_increment,
`place_name` varchar(64) not null comment '具体地址',
`street_id` int not null 
)ENGINE=MyISAM comment '具体地址';

insert into `md_place` values(1,'万豪尊品二期',1);
insert into `md_place` values(2,'四川联广科技',2);
insert into `md_place` values(3,'涪城区人民政府',3);
insert into `md_place` values(4,'繁华似锦',1);

#页面广告区域
create table if not exists md_area(
id int primary key auto_increment,
area varchar(32) not null comment '区域名称'
);
insert into md_area values(1,'一级页面');
insert into md_area values(2,'二级页面左侧边栏');
insert into md_area values(3,'二级页面顶部');

