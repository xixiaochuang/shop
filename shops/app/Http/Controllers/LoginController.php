<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginAdd;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    protected function captcha($moblie,$code){
        $host = env('CAPTCAHA_HOST');
        $path = env('CAPTCAHA_PATH');
//        echo $path;exit;
        $method = "POST";
        $appcode = env('CAPTCAHA_APPCODE');
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：{$code}，3分钟内有效！&mobile={$moblie}";
        $value=['u_tel'=>$moblie,'code'=>$code,'time'=>time()];
        session(['ucaptcha'=>$value]);
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }
    private function code($leg){
        $code="";
        for($i=0;$i<$leg;$i++){
            $code.=mt_rand(0,9);
        }
        return $code;
    }
    public function add(Request $request)
{
    $info=$request->post();
    unset($info['_token']);
    //$this->value=$info;
//      $res=$request->validate();
    $info['admin_pwd']=encrypt($info['admin_pwd']);
    unset( $info['password']);
    $res=DB::table('admin')->insert($info);
    if($res){
        echo 1;
    }else{
        echo 2;
    }
}
    public function checklogin(Request $request){
        $info=$request->all();
        unset($info['_token']);
        $code=session('code');
        if($code!=$info['code']){
            $value=['font'=>'验证码错误','icon'=>2];
            echo json_encode($value);exit;
        }
        $infos=DB::table('admin')->where(['admin_tel'=>$info['admin_tel']])->first();
        if($info){
            $admin_pwd=decrypt($infos->admin_pwd);
            if($admin_pwd==$info['admin_pwd']){
                $value=['font'=>'登陆成功','icon'=>1];
                session(['userinfo'=>['admin_id'=>$infos->admin_id,'admin_tel'=>$infos->admin_tel]]);
                echo json_encode($value);
            }else{
                $value=['font'=>'登陆失败','icon'=>2];
                echo json_encode($value);;
            }
        }else{
            $value=['font'=>'用户民或密码错误','icon'=>2];
            echo json_encode($value);
        }
    }
}

