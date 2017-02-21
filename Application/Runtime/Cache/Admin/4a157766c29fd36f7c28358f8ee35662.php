<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>美点首页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- basic styles -->
		<link href="http://localhost/meidian/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="http://localhost/meidian/Public/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="http://localhost/meidian/Public/assets/css/chosen.css">
		<link rel="stylesheet" href="http://localhost/meidian/Public/assets/css/colorbox.css">
		<link rel="stylesheet" href="http://localhost/meidian/Public/css/common.css">
		<!-- fonts -->

		<!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" /> -->

		<!-- ace styles -->

		<link rel="stylesheet" href="http://localhost/meidian/Public/assets/css/ace.min.css" />
		<link rel="stylesheet" href="http://localhost/meidian/Public/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="http://localhost/meidian/Public/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="http://localhost/meidian/Public/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body>
	<div class="navbar navbar-default" id="navbar">
		<script type="text/javascript">
			try{ace.settings.check('navbar' , 'fixed')}catch(e){}
		</script>

		<div class="navbar-container" id="navbar-container">
			<div class="navbar-header pull-left">
				<a href="#" class="navbar-brand">
					<small>
						<i class="icon-leaf"></i>
						美点后台管理系统
					</small>
				</a><!-- /.brand -->
			</div><!-- /.navbar-header -->

			<div class="navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<span class="user-info">
								<small>欢迎光临,</small>
								<?php echo getUser(session('uid')); ?>
							</span>

							<i class="icon-caret-down"></i>
						</a>

						<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="#">
									<i class="icon-cog"></i>
									设置
								</a>
							</li>

							<li>
								<a href='http://localhost/meidian/index.php/admin/index/userinfo'>
									<i class="icon-user"></i>
									个人资料
								</a>
							</li>

							<li class="divider"></li>

							<li id="logout">
								<a href="javascript:void(0)">
									<i class="icon-off"></i>
									退出
								</a>
							</li>
						</ul>
					</li>
				</ul><!-- /.ace-nav -->
			</div><!-- /.navbar-header -->
		</div><!-- /.container -->
	</div>
	<!-- <script src='http://localhost/meidian/Public/Js/dialog/layer.js'></script>
	<script src='http://localhost/meidian/Public/Js/dialog.js'></script>
	<script src="http://localhost/meidian/Public/Js/jquery.js"></script>
	<script src="http://localhost/meidian/Public/Js/fun.js"></script> -->
<!-- <script>
	
</script> -->
	<div class="main-container" id="main-container">
		<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- #sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php echo ($index_style["li"]); ?>">
						<a href="http://localhost/meidian/index.php/Admin/Index/index">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> 首页 </span>
						</a>
					</li>

					<li class="<?php echo ($advert_style["li"]); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="icon-desktop"></i>
							<span class="menu-text"> 广告管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" style="display: <?php echo ($advert_style["ul"]); ?>;">
							<li class="<?php echo ($advert_style["add"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/addAdvert">
									<i class="icon-double-angle-right"></i>
									新广告
								</a>
							</li>

							<li class="<?php echo ($advert_style["get"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getAdvert">
									<i class="icon-double-angle-right"></i>
									广告列表
								</a>
							</li>
						</ul>
					</li>

					<li class="<?php echo ($user_style["li"]); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="icon-list"></i>
							<span class="menu-text"> 用户管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" style="display: <?php echo ($user_style["ul"]); ?>;">
							<li class="<?php echo ($user_style["add"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/addUser">
									<i class="icon-double-angle-right"></i>
									新用户
								</a>
							</li>

							<li class="<?php echo ($user_style["get"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getUser">
									<i class="icon-double-angle-right"></i>
									用户列表
								</a>
							</li>

							<li class="<?php echo ($user_style["auth"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getAuth">
									<i class="icon-double-angle-right"></i>
									权限查询
								</a>
							</li>

						</ul>
					</li>

					<li class="<?php echo ($file_style["li"]); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text"> 素材管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" style="display: <?php echo ($file_style["ul"]); ?>;">
							<li class="<?php echo ($file_style["add"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/addFile">
									<i class="icon-double-angle-right"></i>
									上传素材
								</a>
							</li>

							<li class="<?php echo ($file_style["get"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getFile">
									<i class="icon-double-angle-right"></i>
									查询素材
								</a>
							</li>

						</ul>
					</li>

					<li class="<?php echo ($company_style["li"]); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="icon-adjust"></i>
							<span class="menu-text"> 广告主管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" style="display: <?php echo ($company_style["ul"]); ?>;">
							<li class="<?php echo ($company_style["add"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/addCompany">
									<i class="icon-double-angle-right"></i>
									添加广告主
								</a>
							</li>

							<li class="<?php echo ($company_style["get"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getCompany">
									<i class="icon-double-angle-right"></i>
									查询广告主
								</a>
							</li>
						</ul>
					</li>

					<li class="<?php echo ($barbershop_style["li"]); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="icon-home"></i>
							<span class="menu-text"> 店铺管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" style="display: <?php echo ($barbershop_style["ul"]); ?>;">
							<li class="<?php echo ($barbershop_style["add"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/addBarbershop">
									<i class="icon-double-angle-right"></i>
									添加店铺
								</a>
							</li>

							<li class="<?php echo ($barbershop_style["get"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getbarbershop">
									<i class="icon-double-angle-right"></i>
									查询店铺
								</a>
							</li>
						</ul>
					</li>

					<li class="<?php echo ($product_style["li"]); ?>">
						<a href="#" class="dropdown-toggle">
							<i class="icon-laptop"></i>
							<span class="menu-text"> 终端管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu" style="display: <?php echo ($product_style["ul"]); ?>;">
							<li class="<?php echo ($product_style["add"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/addProduct">
									<i class="icon-double-angle-right"></i>
									添加终端
								</a>
							</li>

							<li class="<?php echo ($product_style["get"]); ?>">
								<a href="http://localhost/meidian/index.php/Admin/Index/getProduct">
									<i class="icon-double-angle-right"></i>
									查询终端
								</a>
							</li>
						</ul>
					</li>

					<li class="<?php echo ($place_style["li"]); ?>">
						<a href="http://localhost/meidian/index.php/Admin/Index/addPlace" class="dropdown-toggle">
							<i class="icon-laptop"></i>
							<span class="menu-text"> 添加地区 </span>
						</a>
					</li>

				</ul><!-- /.nav-list -->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>

				<ul class="breadcrumb">
					<li>
						<i class="icon-home home-icon"></i>
						<a href="#">首页</a>
					</li>

					<li>
						<a href="#">店铺管理</a>
					</li>
					<li class="active"> 添加店铺 </li>
				</ul><!-- .breadcrumb -->

				<div class="nav-search" id="nav-search">
					<form class="form-search">
						<span class="input-icon">
							<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
							<i class="icon-search nav-search-icon"></i>
						</span>
					</form>
				</div><!-- #nav-search -->
			</div>
			<div class="page-content">
				<div class="page-header">
					<h1>
						店铺管理
						<small>
							<i class="icon-double-angle-right"></i>
							添加店铺
						</small>
					</h1>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺名称 </label>

								<div class="col-sm-9">
									<input type="text" id="form-field-1" placeholder="店铺名称" class="col-xs-10 col-sm-5" name="barbershop_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺地址 </label>

								<div class="col-sm-9">
									<div id="place_select">
										<select class="width-20 " id="form-field-select-3" name="province">
											<option value="">请选择省份</option>
											<?php if(is_array($province)): foreach($province as $key=>$pro): ?><option value="<?php echo ($pro["id"]); ?>"><?php echo ($pro["province_name"]); ?></option><?php endforeach; endif; ?>
										</select>
										<select class="width-20 " id="form-field-select-1" name="city">
											<option value="">请选择城市</option>		
										</select>
										<select class="width-20 " id="form-field-select-3" name="district">
											<option value="">请选择区/县</option>
										</select>
										<select class="width-20 " id="form-field-select-3" name="street">
											<option value="">请选择街道/村</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店主 </label>

								<div class="col-sm-9">
									<div>
										<select class="width-80 chosen-select" id="form-field-select-3" data-placeholder="Choose a Country..." style="display: none;" name="user_id">
											<option value="">&nbsp;</option>
											<?php if(is_array($user)): foreach($user as $key=>$u): ?><option value="<?php echo ($u["id"]); ?>"><?php echo ($u["username"]); ?></option><?php endforeach; endif; ?>
										</select>
									</div>
								</div>
							</div>
						</div><!--表单组-->
						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info addbarbershop" type="button">
									<i class="icon-ok bigger-110"></i>
									添加
								</button>

								&nbsp; &nbsp; &nbsp;
								<button class="btn reset" type="reset">
									<i class="icon-undo bigger-110"></i>
									重置
								</button>
							</div>
						</div>
					</div>
				</div>
			</div><!--page-content-->
			<div class="ace-settings-container" id="ace-settings-container" style="top: 100px;">
				<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
					<i class="icon-cog bigger-150"></i>
				</div>

				<div class="ace-settings-box" id="ace-settings-box">
					<div>
						<div class="pull-left">
							<select id="skin-colorpicker" class="hide" style="display: none;">
								<option data-skin="default" value="#438EB9">#438EB9</option>
								<option data-skin="skin-1" value="#222A2D">#222A2D</option>
								<option data-skin="skin-2" value="#C6487E">#C6487E</option>
								<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
							</select>
							<div class="dropdown dropdown-colorpicker" style="display: none;">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span class="btn-colorpicker" style="background-color:#438EB9"></span>
								</a>
								<ul class="dropdown-menu dropdown-caret">
									<li><a class="colorpick-btn selected" href="#" style="background-color:#438EB9;" data-color="#438EB9"></a></li>
									<li><a class="colorpick-btn" href="#" style="background-color:#222A2D;" data-color="#222A2D"></a></li>
									<li><a class="colorpick-btn" href="#" style="background-color:#C6487E;" data-color="#C6487E"></a></li>
									<li><a class="colorpick-btn" href="#" style="background-color:#D0D0D0;" data-color="#D0D0D0"></a></li>
								</ul>
							</div>
						</div>
						<span>&nbsp; 主题风格</span>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar">
						<label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar">
						<label class="lbl" for="ace-settings-sidebar"> 固定工具栏</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs">
						<label class="lbl" for="ace-settings-breadcrumbs"> 固定面包屑</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl">
						<label class="lbl" for="ace-settings-rtl"> 工具栏左右切换</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container">
						<label class="lbl" for="ace-settings-add-container">
							工具栏居中
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="http://localhost/meidian/Public/Js/jquery.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='http://localhost/meidian/Public/assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='http://localhost/meidian/Public/assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
		<script src="http://localhost/meidian/Public/assets/js/bootstrap.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="http://localhost/meidian/Public/assets/js/chosen.jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost/meidian/Public/Js/dialog/layer.js"></script>
		<script type="text/javascript" src="http://localhost/meidian/Public/Js/dialog.js"></script>
		<script type="text/javascript" src="http://localhost/meidian/Public/Js/fun.js"></script>
		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="http://localhost/meidian/Public/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/jquery.slimscroll.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/jquery.sparkline.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/flot/jquery.flot.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->

		<script src="http://localhost/meidian/Public/assets/js/ace-elements.min.js"></script>
		<script src="http://localhost/meidian/Public/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			window.onload = function(){
				$(".chosen-select").chosen(); 
				addbarbershop();
				placesec();
			}

			function addbarbershop(){
				$(".addbarbershop").click(function(){
					var barbershop_name = $("[name=barbershop_name]").val();
					var user_id = $("[name=user_id]").val();
					var barbershop_province = $("[name=province]").val();
			        var barbershop_city = $("[name=city]").val();
			        var barbershop_district = $("[name=district]").val();
			        var barbershop_street = $("[name=street]").val();
					if(barbershop_name == '' || user_id == ''){
						return dialog.error("请录入完整信息!");
					}
					$.ajax({
						"url":app+"/Admin/Barbershop/addBarbershop",
						"type":"post",
						"data":{
							"barbershop_name":barbershop_name,
							"user_id":user_id,
							"barbershop_province":barbershop_province,
			                "barbershop_city":barbershop_city,
			                "barbershop_district":barbershop_district,
			                "barbershop_street":barbershop_street
						},
						"success":function(res){
							if(res.status){
								return dialog.successconfirm("添加成功");
							}
							return dialog.error("添加失败");
						}
					});
				});
			}


		</script>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</html>