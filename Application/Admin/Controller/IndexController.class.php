<?php
	namespace Admin\Controller;
	use Admin\Controller\CommonController;
	class IndexController extends CommonController{
		private $arr=array();
		function __construct(){
			parent::__construct();
			$this->arr = array(
				"li"=>"open active",
				"ul"=>"block",
			);
		}

		function index(){
			$auth=$this->auth();
			// dump($auth);die;
			if($auth){
				$this->arr['li'] = "active";
				$this->assign("index_style",$this->arr);
				return $this->display();
			}else{
				$this->display("Error:noAuth");
			}
		}

		//用户页面管理
		function addUser(){
			// $uid = session('uid');
			$auth = $this->auth();
			if($auth){
				$this->arr['add'] = "open"; 
				$this->assign("user_style",$this->arr);
				return $this->display("User:addUser");		
			}else{
				// $this->arr['style'] = 'none';
				// $this->assign("user_style",$this->arr);
				// return $this->display("User:addUser");	
				return $this->display("Error:noAuth");
			}
		}

		function getUser(){
			$auth = $this->auth();
			if($auth){
				$this->arr['get'] = "open"; 
				$this->assign("user_style",$this->arr);
				D("User","Controller")->getUser();
				IS_GET?$this->assign("search",I("get.")):'';
				return $this->display("User:getUser");	
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function getAuth(){
			$auth=$this->auth();
			if($auth){
				$this->arr['auth'] = "open"; 
				$this->assign("user_style",$this->arr);
				D("User","Controller")->getUser();
				return $this->display("User:getAuth");
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function updateUser(){
			$this->assign("user_style",$this->arr);
			if(IS_GET){
				$this->assign("user",I("get."));
			}
			$place = D("Place","Controller");
			$place->province();
			return $this->display("User:updateUser");
		}

		function login(){
			return $this->display("Login:login");
		}
		function userinfo(){
			return $this->display('User:userInfo');
		}
		function updateUserInfo(){
			return $this->display('User:updateUserInfo');
		}
		function updatePassword(){
			return $this->display('User:updatePassword');
		}		
		//广告页面跳转管理
		// function addAdvert(){
		// 	$auth=$this->auth();
		// 	if($auth){
		// 		$this->arr['add'] = "open"; 
		// 		$this->assign("advert_style",$this->arr);
		// 		$ad = D("Advert","Controller")->getCompany();
		// 		$bb = D("Product","Controller")->getProduct();
		// 		$place = D("Place","Controller");
		// 		$place->province();
		// 		D("Area","Controller")->queryArea();
		// 		return $this->display("Advert:addAdvert");
		// 	}else{
		// 		return $this->display("Error:noAuth");
		// 	}
		// }

		function getAdvert(){
			$auth=$this->auth();
			if($auth){
				$this->arr['get'] = "open"; 
				$this->assign("advert_style",$this->arr);
				D("Advert","Controller")->getAdvert();
				IS_GET?$this->assign("search",I("get.")):'';
				return $this->display("Advert:getAdvert");				
			}else{
				return $this->display("Error:noAuth");
			}
		}


		//修改广告
		function updateAdvert(){
			$this->assign("advert_style",$this->arr);
			D("Area","Controller")->queryArea();
			$place = D("Place","Controller");
			$place->province();
			$ad = D("Advert","Controller")->getCompany();
			if(IS_GET){
				$this->assign("a",I("get."));
			}
			$fc = D("File","Controller");
			$fc->getImg();
			$fc->getVideo();
			return $this->display("Advert:updateAdvert");
		}


		//添加广告
		function addAdvert(){
			$this->assign("advert_style",$this->arr);
			D("Area","Controller")->queryArea();
			$place = D("Place","Controller");
			$place->province();
			$ad = D("Advert","Controller")->getCompany();
			if(IS_GET){
				$this->assign("a",I("get."));
			}
			$fc = D("File","Controller");
			$fc->getImg();
			$fc->getVideo();
			return $this->display("Advert:addAdvert");
		}
		//推送广告
		function pushAdvert(){
			return $this->display("Advert:pushAdvert");
		}
		function statusAdvert(){
			return $this->display("Advert:statusAdvert");
		}
		function examineAdvert(){
			return $this->display("Advert:examineAdvert");
		}
		function payAdvert(){
			return $this->display("Advert:payAdvert");
		}
		//素材页面管理
		function addFile(){
			$auth = $this->auth();
			if($auth){
				$this->arr['add'] = 'open';
				$this->assign("file_style",$this->arr);
				return $this->display("File:addFile");
			}else{
				 return $this->display("Error:noAuth");
			}
		}

		function getFile(){
			$auth = $this->auth();
			if($auth){
				$this->arr['get'] = 'open';
				$this->assign("file_style",$this->arr);
				$fc = D("File","Controller");
				$fc->getImg();
				$fc->getVideo();
				IS_GET?$this->assign("search",I("get.")):'';
				return $this->display("File:getFile");
			}else{
				return $this->display("Error:noAuth");
			}
		}


		//广告主页面管理
		function addCompany(){
			$auth = $this->auth();
			if($auth){
				$this->arr['add'] = 'open';
				$this->assign("company_style",$this->arr);
				D("User","Controller")->getUser();
				$place = D("Place","Controller");
				$place->province();
				return $this->display("Company:addCompany");
			}else{
				return $this->display("Error:noAuth");			
			}
		}

		function getCompany(){
			$auth=$this->auth();
			if($auth){
				$this->arr['get'] = 'open';
				$this->assign("company_style",$this->arr);
				D("Company","Controller")->getName();
				IS_GET?$this->assign("search",I("get.")):'';
				return $this->display("Company:getCompany");
				
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function updateCompany(){
			$this->assign("company_style",$this->arr);
			D("User","Controller")->getUser();
			if(IS_GET){
				$this->assign("com",I("get."));
			}
			$place = D("Place","Controller");
			$place->province();
			return $this->display("Company:updateCompany");
		}

		//店铺管理
		function addBarbershop(){
			$auth=$this->auth();
			if($auth){
				$this->arr['add'] = 'open';
				$this->assign("barbershop_style",$this->arr);
				D("User","Controller")->getUser();
				$place = D("Place","Controller");
				$place->province();
				return $this->display("Barbershop:addBarbershop");
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function getBarbershop(){
			$auth=$this->auth();
			if($auth){
			$this->arr['get'] = 'open';
			$this->assign("barbershop_style",$this->arr);
			D("Barbershop","Controller")->queryBarbershop();
			IS_GET?$this->assign("search",I("get.")):'';
			return $this->display("Barbershop:getBarbershop");
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function updateBarbershop(){
			$this->assign("barbershop_style",$this->arr);
			D("User","Controller")->getUser();
			if(IS_GET){
				$this->assign("barbershop",I("get."));
			}
			$place = D("Place","Controller");
			$place->province();
			return $this->display("Barbershop:updateBarbershop");
		}

		//终端页面管理
		function addProduct(){
			$auth=$this->auth();
			if($auth){
				$this->arr['add'] = 'open';
				$this->assign("product_style",$this->arr);
				$place = D("Place","Controller");
				$place->province();
				return $this->display("Product:addProduct");
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function getProduct(){
			$auth=$this->auth();
			if($auth){
				$this->arr['get'] = 'open';
				$this->assign("product_style",$this->arr);
				D("Product","Controller")->getProduct();
				IS_GET?$this->assign("search",I("get.")):'';
				return $this->display("Product:getProduct");
			}else{
				return $this->display("Error:noAuth");
			}
		}

		function updateProduct(){
			$this->assign("product_style",$this->arr);
			IS_GET?$this->assign("product",I("get.")):$this->assign("product",I("post."));
			// D("Barbershop","Controller")->queryBarbershop();
			$place = D("Place","Controller");
			$place->province();
			return $this->display("Product:updateProduct");
		}

		//地区管理
		function addPlace(){
			$auth=$this->auth();
			// dump($auth);die;
			if($auth){
				$this->arr['li'] = "active";
				$this->assign("place_style",$this->arr);
				D('Place','Controller')->province();
				return $this->display("Place:addPlace");				
			}else{
				return $this->display("Error:noAuth");
			}
		}

	}
?>