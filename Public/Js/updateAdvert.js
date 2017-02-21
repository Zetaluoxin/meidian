
var ad_name =  "";
var ad_format = "";
var big_img = "";
var small_img = "";
var video_id = "";
var audio_id = "";
var ad_putnum =  "";
var video_css = "";
var video_src = "";
var audio_css = "";
var audio_src = "";
var img_css = "";
var img_src = "";
var ad_companys = "";
var ad_areas =  "";
var places = "";
var ad_company_index="";
var ad_area_index="";
var place_index="";
var arrSpan = [];
function reset(){
    $(".reset").click(function(){
         $("[name=ad_name]").val(ad_name);
         $("[name=ad_format]").val(ad_format);
         $("#big_img").val(big_img);
         $("#small_img").val(small_img);
         $("#video").val(video_id);
         $("#audio").val(audio_id);
         $("[name=ad_putnum]").val(ad_putnum);
         $(".chosen-container-single").find("span").eq(0).text(arrSpan[0]);
         $(".chosen-container-single").find("span").eq(2).text(arrSpan[1]);
         $(".chosen-container-single").find("span").eq(4).text(arrSpan[2]);
         $("video").css("display",video_css);
         $("video").attr("src",video_src);
         $("audio").css("display",audio_css);
         $("audio").attr("src",audio_src);
         $("#img").css("display",img_css);
         $("#img").attr("src",img_src);
         for(var i = 0;i<ad_companys.length;i++){
            if(i == ad_company_index){
                ad_companys.eq(i).attr("selected","true");
            }else{
                ad_companys.eq(i).removeAttr("selected");
            }
        }
        for(var j = 0;j<ad_areas.length;j++){
            if(j == ad_area_index){
                ad_areas.eq(j).attr("selected","true");
            }else{
                ad_areas.eq(j).removeAttr("selected");
            }
        }
        for(var k = 0;k<places.length;k++){
            if(k == place_index){
                places.eq(k).attr("selected","true");
            }else{
                places.eq(k).removeAttr("selected");
            }
        }
    });
}
reset();
window.onload = function(){
    ad_name =  $("[name=ad_name]").val();
    ad_format = $("[name=ad_format]").val();
    big_img = $("#big_img").val();
    small_img = $("#small_img").val();
    video_id = $("#video").val();
    audio_id = $("#audio").val();
    ad_putnum =  $("[name=ad_putnum]").val();
    video_css = $("video").css("display");
    video_src = $("video").attr("src");
    audio_css = $("audio").css("display");
    audio_src = $("audio").attr("src");
    img_css = $("#img").css("display");
    img_src = $("#img").attr("src");
    ad_companys = $("[name=ad_company]").find("option");
    ad_areas =  $("[name=ad_area]").find("option");
    places =  $("[name=place]").find("option");
    ad_company_index="";
    ad_area_index="";
    for(var i = 0;i<ad_companys.length;i++){
        if(ad_companys.eq(i).attr("selected")){
            ad_company_index = i; 
        }
    }
    for(var j = 0;j<ad_areas.length;j++){
        if(ad_areas.eq(j).attr("selected")){
            ad_area_index = j; 
        }
    }
    for(var k = 0;k<places.length;k++){
        if(places.eq(k).attr("selected")){
            place_index = k; 
        }
    }
    arrSpan[0] = $(".chosen-container-single").find("span").eq(0).text(); 
    arrSpan[1] = $(".chosen-container-single").find("span").eq(2).text(); 
    arrSpan[2] = $(".chosen-container-single").find("span").eq(4).text(); 
    console.log(arrSpan);
}

function update(){
    $(".updateadvert").click(function(){
        alert('die');
        // var id = $("#divform").attr("name");
        // var ad_name = $("[name=ad_name]").val();
        // var ad_text = $(".adtext").val();
        // var img_id = $("#imgFile").find("select").val();
        // var video_id = $("#videoFile").find("select").val();
        // var ad_putnum = $("[name=ad_putnum]").val();
        // var ad_company = $("[name=ad_company]").val();
        // var ad_area = $("[name=ad_area]").val();
        // var ad_province_id = $("[name=province]").val();
        // var ad_city_id = $("[name=city]").val();
        // var ad_district_id = $("[name=district]").val();
        // var ad_street_id = $("[name=street]").val();
        // var barbershop_id = $("[name=barbershop]").val();
        //  $.ajax({
        //     "url":app+"/Admin/Advert/saveAdvert",
        //     "type":"post",
        //     "data":{
        //         "id":id,
        //         "ad_name":ad_name,
        //         "ad_text":ad_text,
        //         "img_id":img_id,
        //         "video_id":video_id,
        //         "ad_putnum":ad_putnum,
        //         "ad_company_id":ad_company,
        //         "ad_area_id":ad_area,
        //         "ad_province_id":ad_province_id,
        //         "ad_city_id":ad_city_id,
        //         "ad_district_id":ad_district_id,
        //         "ad_street_id":ad_street_id,
        //         "barbershop_id":barbershop_id
                
        //     },
        //     "success":function(res){
        //         console.log(res);
        //         if(res.status){
        //             return dialog.successconfirm("修改成功");
        //         }
        //         return dialog.error("修改失败");
        //     }
        // })
    });
}
update();


placesec();



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