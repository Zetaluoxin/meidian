<?php  

    /*
        D方法快速加载文件
    */
    function D($ctrl,$opt='Controller'){
        if($ctrl == ''){
            $ctrl = 'Common';
        }
        $ctrl = ucfirst($ctrl);
        $opt = ucfirst($opt);
        $sctrl = $ctrl.$opt;
        require_once dirname(__DIR__).'\\'.$opt.'\\'.$sctrl.'.php';
        return new $sctrl();
    }


    /*
        S函数操作session
    */
    function S($key,$val=''){
        if($val == '' && $key){
            return $_SESSION[$key];
        }else if($key == null){
            if(empty($_SESSION)){
                return;
            }else{
                foreach ($_SESSION as $k => $v) {
                    unset($_SESSION[$k]);
                }
            }
        }else if($val == null && $key){
            unset($_SESSION[$key]);
        }else{
            $_SESSION[$key] = $val;
        }
    }

    /**
     * 发送HTTP请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    function http($url, $params=array(), $method = 'GET', $header = array("Content-type: text/html; charset=utf-8"), $multi = false){
        $opts = array(
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER     => $header
        );

        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error) throw new Exception('请求发生错误：' . $error);
        return  $data;
    }

    /*
    *判断时间差
    *作者：杜勇
    *时间：2107 1 13
    * 传入 开始时间和结束时间，返回的单位
    * 返回时间差
    */
    function diff_time($time1,$time2,$unit){
        $startime = strtotime($time1);
        $endtime = strtotime($time2);
        $diff = $endtime - $startime;
        return floor($diff/($unit));
    }
?>