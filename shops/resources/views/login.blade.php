@extends('layout')
@section('sidebar')
<link href="/css/login.css" rel="stylesheet" type="text/css" />
<link href="/css/vccode.css" rel="stylesheet" type="text/css" />
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">登录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <div class="txtAccount">
                            <input id="admin_name" type="text" placeholder="请输入您的手机号码/邮箱" value="{{json_decode(cookie('userinfo'))['admin_tel']}}"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="admin_pwd" type="password" placeholder="密码" value="{{json_decode(cookie('userinfo'))}}" maxlength="20" /><b></b>
                    </dl>
                    <dl>
                        <input id="captcha" type="text" placeholder="验证码"  maxlength="4"  /><b></b>
                        <img src="{{url('text')}}" id="img">
                    </dl>
                </li>
            </ul>
           @csrf <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="{{url('userpage/mody-loginpwd')}}">忘记密码？</a><b></b><a href="{{url('userpage/register')}}">新用户注册</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: none;">
        
        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>
    <script>
        $(function(){
            layui.use('layer',function(){
                var layer=layui.layer;
                $('#btnLogin').click(function(){
                    var _token=$(this).prev().val();
                    var admin_tel=$('#admin_name').val();
                    var admin_pwd=$('#admin_pwd').val();
                    var code=$("#captcha").val();
                    if(admin_tel==''){
                        alert('用户民不能为空');
                        return false;
                    }else if(admin_pwd==''){
                        alert('密码不能为空');
                        return false;
                    }
                    if(code==null){
                        alert('验证码不能为空');
                        return false;
                    }
                    $.post(
                        "{{url('userpage/login/checklogin')}}"
                        ,{_token:_token,admin_tel:admin_tel,admin_pwd:admin_pwd,code:code}
                        ,function(res){
                            if(res['icon']==1){
                                layer.msg(res['font'],{icon:res['icon'],time:2000},function(){
                                    location.href="{{url('/')}}"
                                })
                            }else{
                                layer.msg(res['font'],{icon:res['icon']})
                            }
                        },'json'
                    )
                })
           $("#img").click(function(){
               $(this).prop('src',"{{url('text')}}"+'?'+Math.random())
           })

            })
        })
    </script>
@endsection
