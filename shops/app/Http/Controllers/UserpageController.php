<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserpageController extends Controller
{
    public function lists(){
        $session=session('userinfo');
        if($session==null){
            $code=1;
        }else{
            $code=0;
        }
        return view('userpage',['code'=>$code]);
    }
    //地址管理
    public function address(){
        return view('address');
    }
    //地址添加
    public function writeadd(){
        return view('writeaddr');
    }
    //晒单
    public function share(){
        return view('share');
    }
}
