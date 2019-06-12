<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserssModel;
use Illuminate\Support\Facades\Redis;
class UserssController extends Controller
{
    //
    public  function login(){
        Redis::set('aa','123');
        $a = Redis::get('aa');
        dd($a);
        $res=[
            'u_name'=>'张三',
            'u_password'=>11111
        ];
        $data=UserssModel::insertGetId($res);
        dd($data);
    }
}
