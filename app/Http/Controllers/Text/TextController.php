<?php

namespace App\Http\Controllers\Text;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class TextController extends Controller
{
    //
    public  function curl(){
        $url='https://www.baidu.com';
//        初始化
        $ch=curl_init($url);
//        设置参数
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        执行一个会话
        curl_exec($ch);
//        关闭会话
        curl_close($ch);
    }

//    调用access_token
    public  function  curl1(){
        $aiid='wx3a2605b6b79c23ee';
        $appsecret='3788596a18231dd407bb6222af8b05da';
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$aiid}&secret={$appsecret}";
//        初始化
        $ch=curl_init($url);
//        设置参数
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        执行一个会话
        $data=curl_exec($ch);
//        关闭会话
        curl_close($ch);
        return $data;
    }

    public function curl3(){
        echo '<pre>';print_r($_POST);echo '<pre>';
    }



    public  function curlpost(){
        $post_data=[
            'name'=>'刘蕊',
            'age'=>11
        ];
        $url="http://zhb.1810.com/curl3";
        //初始化
        $ch=curl_init($url);
//    设置参数
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//如果是 true  当前页面就可以打印（执行会话附一个变量） 如果是false 需要请求服务端
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
//    执行会话
        curl_exec($ch);
//    获取错误信息
        $errno=curl_errno($ch);
        $error=curl_error($ch);
        var_dump($error);echo "<br>";
        var_dump($errno);
//    关闭会话
        curl_close($ch);
    }

//    请求自定义菜单
    public function  menu(){
        $post_data='
        {
                 "button":[
                 {    
                      "type":"view",
                      "name":"知乎",
                      "url":"https://www.zhihu.com/"
                  },
                  ]
         }
        ';
        $access_token=$this->curl1();
       $access_token= json_decode($access_token,true);
        $assess=$access_token['access_token'];
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$assess}";
//        初始化
        $ch=curl_init($url);
//        设置参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//如果是 true  当前页面就可以打印（执行会话附一个变量） 如果是false 需要请求服务端
        curl_setopt($ch,CURLOPT_POST,true);
//        执行会话
        $data=curl_exec($ch);
//        关闭会话
        curl_close($ch);
//        dd($data);
    }

    public  function imgss(){

    }
    public function file(){
        return view('text/file');
    }
    /**
     * 上传文件
     */
    public function filedo(){
//        $img="image/清纯淡雅居家美女温心(Swan)图片_彼岸图网.jpg";
            $url = 'http://zhb.lumen.com/text/curl';
            $path = $this->upload('file_url');
//        上传图片成功后 把图片同步到微信的道media_id
            $media_path = public_path() . "/" . $path;

            //素材路径 必须是绝对路径
            $img = $media_path;
            //1初始化
            $ch = curl_init();
            $post_data = array(
                'a' => 'Post',
                'c' => 'Api_Review',
                'file' => $img
            );
            //2设置参数
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//设为 TRUE ，将在启用 CURLOPT_RETURNTRANSFER 时，返回原生的（Raw）输出
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);//数据
            curl_setopt($ch, CURLOPT_URL, $url);
            //3执行会话
            $info = curl_exec($ch);
            //获取错误信息
        $errno=curl_errno($ch);
        $errmsg=curl_error($ch);

    var_dump($errno);echo "<hr>";
    var_dump($errmsg);
            //4结束会话
            curl_close($ch);
//        print_r($info);
    }

    //    图片上传
    public function upload($name){
        if (request()->hasFile($name) && request()->file($name)->isValid()) {
            $photo = request()->file($name);
            // 返回文件后缀
            $extension = $photo->getClientOriginalExtension();
            // 创建目录 根据时间创建
//            $store_result = $photo->store('upload/'.date('Ymd'));
            // 文件自定义名字 str随机数
            $name = time().Str::random(10);
            $store_result = $photo->storeAs('upload/'.date('Ymd'), $name.'.'.$extension);
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    //第一种方式 form-data
    public function form_data(){
        $post_data=[
        'username'=>'xyc',
        'pass'=>'123'
    ];

        $url="http://zhb.lumen.com/text/curl";
//        初始化
        $ch=curl_init($url);
//        设置参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//如果是 true  当前页面就可以打印（执行会话附一个变量） 如果是false 需要请求服务端
//        执行会话
        curl_exec($ch);

        //获取错误信息
//        $errno=curl_errno($ch);
//        $errmsg=curl_error($ch);
//
//    var_dump($errno);echo "<hr>";
//    var_dump($errmsg);
//        关闭会话
        curl_close($ch);
    }
    //第二种方式 x-www-form-urlencoded
    public function urlencoded(){
        $url="http://zhb.lumen.com/text/curl";
    $post_data="name=xyc&pass=456";
//    初始化
        $ch=curl_init($url);
//        设置参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//如果是 true  当前页面就可以打印（执行会话附一个变量） 如果是false 需要请求服务端
//        执行会话
        curl_exec($ch);
//        关闭会话
        curl_close($ch);
    }
    //第三种方式 raw
    public function raw(){
        $url="http://zhb.lumen.com/text/curl";
        $post_data=[
            'name'=>'lisi',
            'age'=>11
        ];
                $post_data=json_encode($post_data);
        //    初始化
        $ch=curl_init($url);
//        设置参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//如果是 true  当前页面就可以打印（执行会话附一个变量） 如果是false 需要请求服务端
//        执行会话
        curl_exec($ch);
//        查看错误信息
//                $errno=curl_errno($ch);
//        $errmsg=curl_error($ch);
//
//    var_dump($errno);echo "<hr>";
//    var_dump($errmsg);
//        关闭会话
        curl_close($ch);
    }

    /**
     * 加密
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function  jm(){
        $url="http://zhb.lumen.com/text/curl2";
        $a='你好';
        $data=base64_encode(serialize($a));
        $client= new Client();//实例化 Guzzle
        $response = $client->request('POST', $url, [
            'body' =>$data
        ]);
        echo $response->getBody();
    }

    /**
     * 对称加密
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function encrypt(){
        $a='你好啊';
        $key="password";
        $method="AES-128-CBC";//密码学方式
        $iv="adminadminadmin1";//非 NULL 的初始化向量
        $url="http://zhb.lumen.com/text/curl3";
        $client= new Client();//实例化 Guzzle
        $app=openssl_encrypt($a,$method,$key,OPENSSL_RAW_DATA,$iv);//  openssl_encrypt加密 $a 待加密的明文信息数据  解密和加密第一个值不一样其他必须一致
        $app=base64_encode($app); //bas64加密
        $response = $client->request('POST', $url, [
            'body' =>$app
        ]);
        echo $response->getBody();
    }


    //非对称加密
    public function asymm(){
        $data="qwertyuiop";
        //获取私钥
        $a=openssl_get_privatekey("file://".storage_path('rsa_private_key.pem'));
        //将原数据进行私钥加密  赋给 $cc
        openssl_sign($data,$cc,$a);//生成签名
        $b=base64_encode($cc);
        $url="http://zhb.lumen.com/asymm?url=".urlencode($b);//urlencode 是让传输的数据加密
        //使用Guzzle传值
        $clinet = new Client();
        $response = $clinet ->request("POST",$url,[
            'body'=>$data
        ]);
        echo $response->getBody();
    }

    //非对称加密
    public  function personal(){
        $url="http://zhb.lumen.com/personal"; //请求路径
        $a="狗子";
        $acc=json_encode($a,JSON_UNESCAPED_UNICODE);  //数据变json格式   JSON_UNESCAPED_UNICODE不让文字转成json格式
        $key=openssl_pkey_get_private("file://".storage_path('rsa_private_key.pem'));  //获取私钥
        dump($key);
        $crypted='';
        openssl_private_encrypt ($acc , $crypted ,  $key);//私钥加密
          $data=base64_encode($crypted);
        //使用Guzzle传值
        $clinet = new Client();
        $response = $clinet ->request("POST",$url,[
            'body'=>$data
        ]);
        echo $response->getBody();
    }

//    练习
    public  function exercise(){
        $data="活人禁忌";
        $key="password";
        $method="AES-128-CBC";//密码学方式
        $iv="adminadminadmin1";//非 NULL 的初始化向量
        $a=openssl_get_privatekey("file://".storage_path('rsa_private_key.pem')); //获取秘钥
        openssl_sign($data,$exer,$a);//生成签名
        $url="http://zhb.lumen.com/exerci?url=".urlencode($exer);//签名拼接到路由  发送到服务端
        $app=openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);// 对称加密
        $clinet= new Client();//实例化 Guzzle
//        Guzzle 发送
        $response=$clinet->request("POST",$url,[
            'body'=>$app
        ]);
        echo $response->getBody();
    }

    /**
     * 接收服务端返回来的数据
     */
    public function syntony()
    {
        $key="passwords";
        $method="AES-128-CBC";//密码学方式
        $iv="1212121212121212";//非 NULL 的初始化向量
        $re=$_GET['url']; //路由拼接的数据
        $data=file_get_contents('php://input');
        $data_post=openssl_decrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "传过来的值".$data_post;
        $asymm=openssl_pkey_get_public("file://".storage_path('rsa_public_key.pem'));//从证书中解析公钥，以供使用
        dump($asymm);
        $result = openssl_verify($data_post,$re,$asymm);//验证签名
        echo "签名验证".$result;
    }

    public  function  aipay(){
//        支付宝网关
        $aipay="https://openapi.alipaydev.com/gateway.do";
//        沙箱APPID
        $appid="2016092500596176";
//        请求参数
        $biz_content=[
            'subject'        =>'测试沙箱'.mt_rand('11111','99999'),
            'out_trade_no'   =>'1810'.mt_rand('11111','99999').time(),
            'total_amount'   =>mt_rand('1','10'),
            'product_code'   =>'QUICK_WAP_WAY',
        ];
//        公共参数
        $post_data=[
            'app_id'        =>$appid,
            'method'        =>"alipay.trade.wap.pay", //	接口名称
            'charset'       =>'utf-8',//请求使用的编码格式，如utf-8,gbk,gb2312等
            'sign_type'     =>'RSA2',//	商户生成签名字符串所使用的签名算法类型，目前支持RSA2和RSA，推荐使用RSA2
            'timestamp'     =>date('Y-m-d H:i:s'),//	发送请求的时间
            'version'       =>'1.0',//	调用的接口版本，固定为：1.0
            'biz_content'   =>json_encode($biz_content,JSON_UNESCAPED_UNICODE),//业务请求参数的集合
        ];
        //根据键排序
        ksort($post_data);
//        拼接代签名字符串
        $str0='';
        foreach ($post_data as $k=>$v){
            $str0.=$k.'='.$v.'&';
        }
        $str=rtrim($str0,"&");
        dump($str);
//        私钥签名
        $priv=openssl_get_privatekey("file://".storage_path("priva.pem"));
        openssl_sign($str,$info0,$priv,OPENSSL_ALGO_SHA256);
        $post_data['sign']=base64_encode($info0);
        $param_str='?';
        foreach ($post_data as $k=>$v){
            $param_str.=$k.'='.urlencode($v).'&';
        }
        $param=rtrim($param_str,'&');
        dd($param);
        $url=$aipay.$param;
        //发送GET请求
        header("Location:".$url);

    }


    public function ceshi()
    {
        echo $_SERVER['HTTP_HOST'];echo "<br>";//zhb.1810.com
        echo $_SERVER["HTTP_USER_AGENT"] ;echo "<br>";// Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36
        echo $_SERVER["HTTP_ACCEPT"] ;echo "<br>";// text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3
        print_r($_SERVER["HTTP_CONNECTION"]) ;echo "<br>";// keep-alive
        print_r($_SERVER["GATEWAY_INTERFACE"]) ;echo "<br>";// CGI/1.1
        print_r($_SERVER ["REMOTE_PORT"]) ;echo "<br>";// 55779
        print_r($_SERVER["PHP_SELF"]) ;echo "<br>";//   /index.php
        print_r($_SERVER["SERVER_PORT"] ) ;echo "<br>";// 80
        print_r($_SERVER["REQUEST_SCHEME"]) ;echo "<br>";//  http
        print_r($_SERVER["SERVER_ADDR"] ) ;echo "<br>";//  192.168.152.133
        print_r($_SERVER["SERVER_SOFTWARE"]  ) ;echo "<br>";//  nginx/1.14.2
        print_r($_SERVER["REQUEST_TIME"]);//  1560474567  得到请求开始时的时间戳。
    }

}
