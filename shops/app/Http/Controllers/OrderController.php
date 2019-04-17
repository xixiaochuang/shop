<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    //地址展示
    public function add()
    {
        $data=$this->cart(0);
        return view('writeaddr',['data'=>$data]);
    }

    //城市查询
    public function cart($pid)
    {
        $data=DB::table('area')->where(['pid'=>$pid])->get();
        return $data;
    }
}
