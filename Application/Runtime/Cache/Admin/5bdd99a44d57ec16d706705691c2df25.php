<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<button>异步请求</button>
</body>
<script type="text/javascript" src="http://localhost/meidian/Public/Js/jquery.js"></script>
<script type="text/javascript">
$("button").click(function(){
    $.ajax({
        "url":"http://localhost/meidian/index.php/Admin/Advert/getAdvert",
        "type":"post",
        "data":{},
        "success":function(res){
            // var str = JSON.parse(res);
            console.log(res);
        }
    });
});
</script>
</html>