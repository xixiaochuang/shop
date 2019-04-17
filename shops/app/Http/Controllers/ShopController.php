<?php

namespace App\Http\Controllers;

use App\Model\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function shoplist()
    {
        // PRINT_R($_SERVER['SCRIPT_NAME']);exit;
        $cate = DB::table('category')->where(['pid' => '0'])->get();
        $info = DB::table('goods')->where(['is_up' => 1])->get();
        return view('allshops', ['cate' => $cate, 'shopinfo' => $info]);
    }

    public function shopinfo(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $where = [];
        if ($data['cate_id'] != null) {
            $cateinfo = DB::table('category')->get();
            $cate_id = $this->cateid($cateinfo, $data['cate_id']);
            $shopinfo = DB::table('goods')->whereIn('cate_id', $cate_id)->get();
        }
        if ($data['fileds'] != null && $data['ord'] == null) {
            $shopinfo = DB::table('goods')->whereIn('cate_id', $cate_id)->orderBy($data['fileds'], 'desc')->get();
        }
        if ($data['fileds'] != null && $data['ord'] != null) {
            $shopinfo = DB::table('goods')->whereIn('cate_id', $cate_id)->orderBy($data['fileds'], $data['ord'])->get();
        };
        if ($data['fileds'] == null && $data['ord'] == null) {
            $shopinfo = DB::table('goods')->whereIn('cate_id', $cate_id)->orderBy('goods_score', 'desc')->get();
        }

        // $where=['cate_id'=>['in',implode(',',$cate_id)]];
        $c_id = implode(',', $cate_id);

        echo view('shop', ['shopinfo' => $shopinfo]);
    }

    public function cateid($cateinfo, $pid)
    {
        static $arr = [];
        foreach ($cateinfo as $k => $v) {
            if ($v->pid == $pid) {
                $arr[] = $v->cate_id;
                $this->cateid($cateinfo, $v->cate_id);
            }

        }
        return $arr;
        dd($arr);
    }

    public function checklogin()
    {
        $session = session('userinfo');
        if ($session == null) {
            $value = ['font' => '<h1>请先登录</h1>', 'icon' => 2];
            echo json_encode($value);
        }
    }

    public function shopcate(Request $request)
    {
        $goods_id = $request->goods_id;
        $user_id = session('userinfo')['admin_id'];
        $shopinfo = ['goods_id' => $goods_id, 'admin_id' => $user_id, 'state' => 1];
        $shop = DB::table('cart')->where($shopinfo)->first();
        $buy_num = DB::table('cart')->where(['goods_id' => $goods_id])->value("buy_num");
        if ($shop) {
            $shopt = ['buy_num' => $shop->buy_num + 1];
            if (!$this->buy_num($goods_id, $buy_num + 1)) {
                $data = ['font' => "没货了", 'icon' => 6];
            } else {
                $lei = DB::table('cart')->where($shopinfo)->update($shopt);
                dd($lei);
                if ($lei) {
                    $data = ['font' => '添加成功', 'icon' => 1];
                } else {
                    $data = ['font' => '加入失败', 'icon' => 2];
                }
            }
        } else {
            $shopinfo['buy_num'] = 1;
            if (!$this->buy_num($goods_id, $buy_num + 1)) {
                $data = ['font' => "没货了", 'icon' => 6];
            } else {
                $jia = DB::table('cart')->where(['goods_id' => $goods_id, 'admin_id' => $user_id])->insert($shopinfo);
                if ($jia) {
                    $data = ['font' => '添加成功', 'icon' => 1];
                } else {
                    $data = ['font' => '加入失败', 'icon' => 2];
                }
            }
        }
        echo json_encode($data);


    }

    public function buy_num($goods_id, $num)
    {
        $goods_num = DB::table('goods')->where(['goods_id' => $goods_id])->value("goods_num");
        if ($goods_num > $num) {
            return true;
        } else {
            return false;
        }
    }

    public function money(Request $request)
    {
        $goods_id = $request->goods_id;
        // dd($goods_id);
        $res=explode(',',$goods_id);
        $buy_num = explode(',', $request->buy_num);
      //  print_r($buy_num);
        for ($i=0;$i<=count($res)-1;$i++){
            $dd=DB::table('cart')->where(['admin_id'=>session('userinfo')['admin_id'],'goods_id'=>$res[$i]])->update(['buy_num'=>$buy_num[$i]]);
        }
        $self_price=[];
        for($i=0;$i<=count($res)-1;$i++){
            $self_price[] = Goods::where('goods_id',$res[$i])->value('self_price');
        }
      //  print_r($self_price);exit;
        $money = 0;
        for ($i = 0; $i <= count($self_price) - 1; $i++) {
            for ($a = 0; $a <= count($buy_num) - 1; $a++) {
                if ($i == $a) {
                    $money += $self_price[$i] * $buy_num[$a];
                }
            }
        }
        // print_r($money);
        echo $money;
    }

    public function payment(Request $request)
    {
        $goods_id = explode(',', $request->goods_id);
        $admin_id = session('userinfo')['admin_id'];
        $where = ['admin_id' => $admin_id, 'state' => 1];
        $data = DB::table('cart')->join('goods', 'cart.goods_id', '=', 'goods.goods_id')->where($where)->whereIn('goods.goods_id', $goods_id)->get();
//        $res=[];
//        for($i=0;$i<=count($data)-1;$i++){
//            $res[]=array_unique($data[$i]);
//        }
       // dd($data);
        $money = 0;
        for ($a=0;$a<=count($data)-1;$a++) {
             $money += $data[$a]->buy_num * $data[$a]->self_price;
        }

        return view('payment',['res'=>$data,'money'=>$money]);
    }


}
