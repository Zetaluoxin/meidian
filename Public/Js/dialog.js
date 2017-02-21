var dialog = {
    // 错误弹出层
    error: function(message) {
        layer.open({
            content : message,
            icon:2,
            btn : ['确定'],
        });
    },

    //成功弹出层
    success : function(message,url) {
        layer.open({
            content : message,
            icon : 1,
            yes : function(){
                location.href=url;
            },
        });
    },

    // 确认弹出层
    confirm : function(message, url) {
        layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                return true;
            },
            no:function(){
                return false;
            }
        });
    },

    //无需跳转到指定页面的确认弹出层
    toconfirm : function(message) {
        layer.open({
            content : message,
            icon:1,
            btn : ['确定'],
        });
    },

    //成功时无须跳转确认
    successconfirm : function(message) {
        layer.open({
            content : message,
            icon:1,
            btn : ['确定'],
        });
    },

    footerconfirm:function(yes,no){
        layer.open({
            content: '您真的要离开DD吗?',
            btn: ['狠心离开', '继续逛逛'],
            skin: 'footer',
            yes: yes,
            no:no
        });
    }
}

