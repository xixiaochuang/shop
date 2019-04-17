<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Captcha;
class Captchas extends Controller
{
    public function verify(){
        $new=new Captcha();
        $code=$new->getCode();
        session(['code'=>$code]);
        $new->doimg();
    }
}
