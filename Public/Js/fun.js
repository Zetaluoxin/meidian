var public = "http://localhost/meidian/Public";
var app = "http://localhost/meidian/index.php";



function placesec(){
    $("[name=province]").change(function(){
        var province_id = $(this).val();
        $.ajax({
            "url":app+"/Admin/Place/city",
            "type":"post",
            "data":{"province_id":province_id},
            "success":function(res){
                $("[name=city]").html("<option>请选择城市</option>");
                $("[name=district]").html("<option>请选择区/县</option>");
                $("[name=street]").html("<option>请选择街道/村</option>");
                $("[name=barbershop]").html("<option>请选择店铺</option>");
                if(res.status){
                    for (var i = 0; i < res.data.length; i++) {
                        var opt = $("<option></option>");
                        opt.val(res.data[i]['id']);
                        opt.text(res.data[i]['city_name']);
                        $("[name=city]").append(opt);
                    }
                    return;
                }
            }
        });
    });


    $("[name=city]").change(function(){
        var city_id = $(this).val();
        $.ajax({
            "url":app+"/Admin/Place/district",
            "type":"post",
            "data":{"city_id":city_id},
            "success":function(res){
                $("[name=district]").html("<option>请选择区/县</option>");
                $("[name=street]").html("<option>请选择街道/村</option>");
                $("[name=barbershop]").html("<option>请选择店铺</option>");
                if(res.status){
                    console.log(res.data);
                    for (var i = 0; i < res.data.length; i++) {
                        var opt = $("<option></option>");
                        opt.val(res.data[i]['id']);
                        opt.text(res.data[i]['district_name']);
                        $("[name=district]").append(opt);
                    }
                    return;
                }
            }
        });
    });


    $("[name=district]").change(function(){
        var district_id = $(this).val();
        $.ajax({
            "url":app+"/Admin/Place/street",
            "type":"post",
            "data":{"district_id":district_id},
            "success":function(res){
                $("[name=street]").html("<option>请选择街道/村</option>");
                $("[name=barbershop]").html("<option>请选择店铺</option>");
                if(res.status){
                    for (var i = 0; i < res.data.length; i++) {
                        var opt = $("<option></option>");
                        opt.val(res.data[i]['id']);
                        opt.text(res.data[i]['street_name']);
                        $("[name=street]").append(opt);
                    }
                    return;
                }
            }
        });
    });


    $("[name=street]").change(function(){
        var street_id = $(this).val();
        $.ajax({
            "url":app+"/Admin/Barbershop/queryBarbershopByStreet",
            "type":"post",
            "data":{"barbershop_street":street_id},
            "success":function(res){
                $("[name=barbershop]").html("<option>请选择店铺</option>");
                if(res.status){
                    for (var i = 0; i < res.data.length; i++) {
                        var opt = $("<option></option>");
                        opt.val(res.data[i]['id']);
                        opt.text(res.data[i]['barbershop_name']);
                        $("[name=barbershop]").append(opt);
                    }
                    return;
                }
            }
        });
    });
}


function logout(){
$('#logout').click(function(){
        $.ajax({
            type:'post',
            url:app+'/admin/user/logout',
            dasta:{},
            dataType:'json',
            success:function(data){
                if(data.status == 1){
                    var url=app+'/admin/index/login';
                    return dialog.success("退出成功",url);
                }else{
                    dialog.error('退出失败');
                }
            }
        });
    });

}

logout();


