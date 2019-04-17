<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function  cartlist(){
        $session=session('userinfo');
        if($session==null){
            return view('login');
        }else{
            $where=['admin_id'=>$session['admin_id'],'state'=>1];
            $res=DB::table('cart')->join('goods','cart.goods_id','=','goods.goods_id')->where($where)->get();
            $money=0;
            foreach($res as $k=>$v){
                $money+=$v->buy_num*$v->self_price;
            }
            //echo $money;exit;
           // $remm=DB::table('cart')->where($where)->pluck('goods_id');
//            for($i=0;$i<=count($remm)-1;$i++){
//                $wheres=['goods_id'=>$remm[$i]];
//                $data[]=DB::table('goods')->where($where)->pluck('goods_id');
//            }
           // dd($res);
            if($money==0){
                $code=1;
            }else{
                $code=0;
            }
           // echo $code;exit;
            return view('shopcart',['res'=>$res,'code'=>$code]);
        }
    }

    public function del(Request $request){
       $goods_id=$request->goods_id;
       $goods_ids=str_split($goods_id);
      // $del=DB::table('cart')->whereIn('goods_id','87666'$goods_id)->get();
      // $goodsid=array_flip($goods_id);
       $g=array_keys($goods_ids,',');
       if($g!=''){
           for($i=0;$i<=count($g)-1;$i++){
               unset($goods_ids[$g[$i]]);
           }
       }
        $del=DB::table('cart')->where('admin_id',session('userinfo')['admin_id'])->whereIn('goods_id',$goods_ids)->update(['state'=>2]);
        if($del){
            $data=['font'=>'删除成功','icon'=>1];
            echo json_encode($data);
        }else{
            $data=['font'=>'删除失败','icon'=>2];
            echo json_encode($data);
        }

    }
}
