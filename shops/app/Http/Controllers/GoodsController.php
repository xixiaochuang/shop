<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
class GoodsController extends Controller
{
    public function shopcontent(Request $request){
        $goods_id=$request->all();
        $where=['goods_id'=>$goods_id['goods_id']];
        $shopinfo=Goods::where($where)->first();
        $goodsimgs= $shopinfo->goods_imgs;
        $goods_imgs=explode('|',rtrim($goodsimgs,'|'));
        return view('shopcontent',['shop'=>$shopinfo,'img'=>$goods_imgs]);
    }
}
