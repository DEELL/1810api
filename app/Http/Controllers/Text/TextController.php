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

    public function  jm(){
//        $url="http://zhb.lumen.com/text/curl2";
        $a='你好';
        $data=base64_encode(serialize($a));
        $client= new Client();//实例化 Guzzle
        $response = $client->request('POST', 'http://zhb.lumen.com/text/curl2', [
            'body' =>$data
        ]);
        echo $response->getBody();

//        初始化
//        $ch=curl_init($url);
////        设置参数
//        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
//        curl_setopt($ch,CURLOPT_POST,true);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false); //如果是 true  当前页面就可以打印（执行会话附一个变量） 如果是false 需要请求服务端
////        执行会话
//        curl_exec($ch);
////        关闭会话
//        curl_close($ch);
    }

}
