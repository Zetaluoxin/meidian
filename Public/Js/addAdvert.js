function add(){
    $("[type=button]").click(function(){
        var img_id          = $("#imgFile").find("select").val();
        var video_id        = $("#videoFile").find("select").val();
        var ad_name         = $("[name=ad_name]").val();
        var ad_text         = $(".adtext").val();
        var ad_putnum       = $("[name=ad_putnum]").val();
        var ad_area_id      = $("[name=ad_area]").val();
        var ad_company      = $("[name=ad_company]").val();
        var ad_province_id  = $("[name=province]").val();
        var ad_city_id      = $("[name=city]").val();
        var ad_district_id  = $("[name=district]").val();
        var ad_street_id    = $("[name=street]").val();
        var barbershop_id   = $("[name=barbershop]").val();
        $.ajax({
            "url":app+"/Admin/Advert/addAdvert",
            "type":"post",
            "data":{
                "ad_name"       :ad_name,
                "ad_text"       :ad_text,
                "ad_putnum"     :ad_putnum,
                "img_id"        :img_id,
                "video_id"      :video_id,
                "ad_company"    :ad_company,
                "ad_area_id"    :ad_area_id,
                "ad_province_id":ad_province_id,
                "ad_city_id"    :ad_city_id,
                "ad_district_id":ad_district_id,
                "ad_street_id"  :ad_street_id,
                "barbershop_id" :barbershop_id
            },
            "success":function(res){
                console.log(res);
                if(res.status){
                    return dialog.successconfirm("添加成功");
                }
                return dialog.error("添加失败");
            }
        })
    });
}
add();
function reset(){
    $(".reset").click(function(){
         $("[name=ad_name]").val('');
         $("[name=ad_format]").val('');
         $("[name=ad_putnum]").val('');
         $("[name=ad_company]").find("option").eq(0).attr('selected',"true");
         $("[name=ad_area]").find("option").eq(0).attr('selected',"true");
         $("[name=place]").find("option").eq(0).attr('selected',"true");
         $(".chosen-container-single").find("span").text(" ");
    });
}
reset();


placesec();

// function vue(data){
//     var goods = new Vue({
//         el:"#place_select",//绑定给父元素才能获取操作权
//         data:{citys:data}//必须是键值对的形式,传入的数组只能在value位置,key位置需要自己定义
//     });
// }

function chosen_select(){
     $(".chosen-select").chosen(); 

}
chosen_select();

//通过地区选择查询通过地区选择查询终端数量
function productNum(){
     $("[name=barbershop]").change(function(){
        var barbershop_id = $(this).val();
        if(barbershop_id == ''){
            return;
        }
        $.ajax({
            "url":app+"/Admin/Product/getProductNum",
            "type":"post",
            "data":{"barbershop_id":barbershop_id},
            "success":function(res){
                var num = res.data.length;
                return $("[name=ad_putnum]").val(num);
            }
        });
     });
     $("[name=street]").change(function(){
        var street_id = $(this).val();
        if(street_id == ''){
            return;
        }
        $.ajax({
            "url":app+"/Admin/Product/productStreet",
            "type":"post",
            "data":{"product_street":street_id},
            "success":function(res){
                var num = res.data.length;
                return $("[name=ad_putnum]").val(num);
            }
        });
     });

     $("[name=district]").change(function(){
        var district_id = $(this).val();
        if(district_id == ''){
            return;
        }
        $.ajax({
            "url":app+"/Admin/Product/productDistrict",
            "type":"post",
            "data":{"product_district":district_id},
            "success":function(res){
                var num = res.data.length;
                return $("[name=ad_putnum]").val(num);
            }
        });
     });

      $("[name=city]").change(function(){
        var city_id = $(this).val();
        if(city_id == ''){
            return;
        }
        $.ajax({
            "url":app+"/Admin/Product/productCity",
            "type":"post",
            "data":{"product_city":city_id},
            "success":function(res){
                var num = res.data.length;
                return $("[name=ad_putnum]").val(num);
            }
        });
     });

      $("[name=province]").change(function(){
        var province_id = $(this).val();
        if(province_id == ''){
            return;
        }
        $.ajax({
            "url":app+"/Admin/Product/productProvince",
            "type":"post",
            "data":{"product_province":province_id},
            "success":function(res){
                var num = res.data.length;
                return $("[name=ad_putnum]").val(num);
            }
        });
     });
}   
productNum();
