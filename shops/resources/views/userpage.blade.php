﻿@extends('layout')
@section('sidebar')
<link href="css/comm.css" rel="stylesheet" type="text/css" /><link href="css/member.css" rel="stylesheet" type="text/css" /><script src="js/jquery190_1.js" language="javascript" type="text/javascript"></script>
<body class="g-acc-bg">
    @if($code==1)
    <div class="welcome logoin" >
        <p>Hi，等你好久了！</p>
        <a href="{{url('userpage/login')}}" class="orange">登录</a>
        <a href="{{url('userpage/register')}}" class="orange">注册</a>
    </div>
    @else
    <div class="welcome list" >
        <i class="set"></i>
        <div class="login-img clearfix">
            <ul>
                <li><img src="images/goods2.jpg" alt=""></li>
                <li class="name">
                    <h3>兰兰</h3>
                    <p>ID：10030053</p>
                </li>
                <li class="next fr"><s></s></li>
            </ul>
        </div>
        <div class="chao-money">
            <ul class="clearfix">
                <li class="br">
                    <p>潮购值</p>
                    <span>822</span>
                </li>
                <li class="br">
                    <p>余额（元）</p>
                    <span>0</span>
                </li>
                <li>
                    <a href="" class="recharge">去充值</a>
                </li>
            </ul>
        </div>

    </div >
    <!--获得的商品-->
    @endif
    <!--导航菜单-->
    
    <div class="sub_nav marginB person-page-menu">
        <a href="{{url('userpage/buyrecord')}}"><s class="m_s1"></s>潮购记录<i></i></a>
        <a href="#"><s class="m_s2"></s>获得的商品<i></i></a>
        <a href="{{url('userpage/share')}}"><s class="m_s3"></s>我的晒单<i></i></a>
        <a href="{{url('userpage/mywallet')}}"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="{{url('userpage/address')}}"><s class="m_s5"></s>收货地址<i></i></a>
        <a href="/v44/help/help.do" class="mt10"><s class="m_s6"></s>帮助与反馈<i></i></a>
        <a href="{{url('userpage/invite')}}"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>

    <script>
        function goClick(obj, href) {
            $(obj).empty();
            location.href = href;
        }
        if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
            $(".m-block-header").show();
        }
        {{--$(function(){--}}
            {{--var login="{{implode(',',session('userinfo'))}}";--}}
            {{--if(login!=''){--}}
                {{--$('.list').show();--}}
                {{--$('.logoin').hide();--}}
            {{--}--}}
        {{--})--}}
    </script>
</body>
@endsection
