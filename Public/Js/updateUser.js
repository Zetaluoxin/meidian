// $(function() {
//     $('#upload').uploadify({
//         'swf'      : public+'/Js/uploadify/uploadify.swf',    //指定上传控件的主体文件,不可更改文件
//         'uploader' : app+'/Admin/Common/uploadify',    //指定服务器端上传处理文件
//         'buttonText' : '选择文件上传',
//         'fileTypeDesc' : 'All Files',
//         'fileObjName' : 'file',
//         'fileTypeExts' : '*.gif;*.jpg;*.png;*.jpeg',
//         'onUploadSuccess' : function(file,data,res){
//         	//file 包含组件自动生成的信息和上传的图片信息,返回值为obj类型
//         	//data 上传文件的返回值,
//         	//res为操作是否成功 返回值为bool类型
//         	if(res){
//         		var obj = JSON.parse(data);
//         		console.log(obj);
//         		$("#"+file.id).find(".data").html("上传完成!");//修改提示信息
//         		//讲图片放到页面中并展示
//         		$("#img").attr("src",public+"/Uploads/"+obj.data.small_img);
//         		$("#small_img").val(obj.data.small_img);
//         		$("#big_img").val(obj.data.big_img);
//         		$("#img").show();
//         	}else{
//         		return dialog.error("上传失败");
//         	}
//         }
//         //其他配置项
//     });
// });

function updateUser(){
    $(".updateuser").click(function(){
        layer.confirm(
            '请确认修改信息',
            {icon:3,title:'提示'},
            function(index){
                var user_id = $(".user_form").attr("name");
                var nickname = $("[name=nickname]").val();
                var names = $("[name=names]").val();
                var qq = $("[name=qq]").val();
                var telephonenum = $("[name=telephonenum]").val();
                var postalcode = $("[name=postalcode]").val();
                var province_id = $("[name=province]").val();
                var city_id = $("[name=city]").val();
                var district_id = $("[name=district]").val();
                var street_id = $("[name=street]").val();
                if(nickname==''&&names==''&&qq==''&&telephonenum==""&&postalcode==''&&province_id==''&&city_id==''&&district_id==''&&street_id==''){
                    return dialog.error("不能添加空的信息喔");
                }
                $.ajax({
                    "url":app+"/Admin/User/addUserInfo",
                    "type":"post",
                    "data":{
                        "user_id":user_id,
                        "nickname":nickname,
                        "names":names,
                        "qq":qq,
                        "telephonenum":telephonenum,
                        "postalcode":postalcode,
                        "province_id":province_id,
                        "city_id":city_id,
                        "district_id":district_id,
                        "street_id":street_id
                    },
                    "success":function(res){
                        if(res.status){
                            return dialog.successconfirm("修改成功!");
                        }
                        return dialog.error("修改失败!");
                    }
                });
            }
        );
    });
}
updateUser();
placesec();