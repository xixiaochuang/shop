@extends('layout')
@section('sidebar')

<link href="/css/cartlist.css" rel="stylesheet" type="text/css" />
<body id="loadingPicBlock" class="g-acc-bg" >
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="/" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($res as $v)
                <li>
                    <s class="xuan current"  goods_id="{{$v->goods_id}}"></s>
                    <a class="fl u-Cart-img" href="/v44/product/12501977.do">
                        <img src="{{url('/storage/uploads/goosfile/'.$v->goods_img)}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r">
                        <a href="/v44/product/12501977.do" class="gray6">{{$v->goods_name}}</a>
                        <span class="gray9">
                            <em>剩余{{$v->goods_num}}件</em>
                        </span>
                        <div class="num-opt">
                            <em class="num-mius dis min"><i></i></em>
                            <input class="text_box" name="num" maxlength="{{$v->goods_num}}" type="text" value="{{$v->buy_num}}" codeid="12501977">
                            <em class="num-add add"><i></i></em>
                        </div>
                        <a href="javascript:;" name="delLink" cid="12501977" isover="0" class="z-del"><s></s></a>
                    </div>    
                </li>
                    @endforeach
            </ul>
            {{--{{var_dump($res)}}--}}
            @if($code!=1)
            <div id="divNone" class="empty " style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
            @else
             <div id="divNone" class="empty " ><s></s><p>您的购物车还是空的哦~</p><a href="{{url('/')}}" class="orangeBtn">立即潮购</a></div>
            @endif
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove">删除</a>
                    <a href="javascript:;" id="a_payments" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    <li>
                        <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                            <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>368671</i>潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                        </p>
                        <ins class="gray9">价值:￥7130</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @csrf
<!---商品加减算总数---->
    <script type="text/javascript">
    $(function () {
        $(".add").click(function () {
            var t = $(this).prev();
            t.val(parseInt(t.val()) + 1);
            money()
        })
        $(".min").click(function () {
            var t = $(this).next();
            if(t.val()>1){
                t.val(parseInt(t.val()) - 1);
                money()
            }
        })
    })
    </script>


    <script>

    // 全选        
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');
             $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current");

                } else {
                    $(this).addClass("current");

                } 
            });
             money()
        }else{
            $(this).addClass('current');

             $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
          money()
        }
        
        
    });
    // 单选
    $(".g-Cart-list .xuan").click(function () {
        if($(this).hasClass('current')){
            

            $(this).removeClass('current');

        }else{
            $(this).addClass('current');
        }
        if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }
        // $("#total2").html() = GetCount($(this));
        money();
        //alert(conts);
    });
  // 已选中的总额
  //   function GetCount() {
  //       var conts = 0;
  //       var aa = 0;
  //       $(".g-Cart-list .xuan").each(function () {
  //           if ($(this).hasClass("current")) {
  //               for (var i = 0; i < $(this).length; i++) {
  //                   conts += parseInt($(this).parents('li').find('input.text_box').val());
  //                   // aa += 1;
  //               }
  //           }
  //       });
  //
  //        $(".total").html('<span>￥</span>'+(conts).toFixed(2));
  //   }
    var _token=document.getElementsByName('_token')[0].value
    $(function (){
        money();
        layui.use('layer',function () {
            var layer=layui.layer;
            $(".text_box").blur(function () {
                var buy_num=$(this).val();
                var goods_num=parseInt($(this).prop('maxlength'))
                var reg=/^[1-9][0-9]*$/;
                if(buy_num==""){
                    $(this).val(1)
                }else if(!reg.test(buy_num)){
                    $(this).val(1)
                }else if(parseInt(buy_num)>goods_num){
                    $(this).val(goods_num)
                }
                money();
            })
            $(".add").click(function(){
                money();
                var _this=$(this);
                var max=parseInt($(this).prev().val())
                var goods_num=parseInt($(this).prev().prop('maxlength'));
                if(max>goods_num){
                    layer.msg('已超过库存',{icon:8,time:2000});
                    _this.prev().val(max-1)
                }
            })

        })
        $('#a_payments').click(function () {
            var goods="";
            var status=$('#cartBody').children('li').find("s[class='xuan current']").each(function(){
                goods+=$(this).attr('goods_id')+',';
            });
            var goods_id=goods.substring(goods,goods.length-1)
           var info=false;
            $.ajax({
                url:"{{url('allshops/checklogin')}}"
                ,method:'get'
                ,async:false
                ,dataType:"json"
            }).done(function(res){
                layui.use('layer',function(){
                    var layer=layui.layer;
                    if(res.icon==2){
                        layer.msg(res.font,{icon:res.icon,time:10000},function(){
                            location.href="{{url('userpage/login')}}"
                        })
                        // layer.msg('ss',{icon:5})
                        info=true;
                    }
                })
            })

            if(info==false && goods_id!=""){
                layer.msg('跳转',{icon:6},function(){
                    location.href="{{url('shopcart/payment')}}?goods_id="+goods_id;
                })
            }else{
                layer.msg('登陆或选中',{icon:3});
            }
          //  console.log(status.length)
            // if(info==false){
            //
            // }
            })
        $(".z-del").click(function () {
            var goods_id=$(this).parents('li').children('s').attr('goods_id');
            delcart(goods_id)
        })
        $('#a_payment').click(function () {
            var goods_id="";
          //  var buy_num="";
            $('#cartBody').children('li').each(function () {
                if($(this).children('s').prop('class')=="xuan current"){
                    goods_id+=$(this).children('s[class="xuan current"]').attr('goods_id')+',';
                   // buy_num+=$(this).find('input[class="text_box"]').val()+","
                }
            })
            var res=goods_id.substring(goods_id,goods_id.length-1);
            if(res==""){
                    layer.msg('请选择要删除的商品',{icon:9})
            }else{
                delcart(res)
            }
        });
    })
    function money(){
        var goods_id="";
        var buy_num="";
        $('#cartBody').children('li').each(function () {
            if($(this).children('s').prop('class')=="xuan current"){
                goods_id+=$(this).children('s[class="xuan current"]').attr('goods_id')+',';
                buy_num+=$(this).find('input[class="text_box"]').val()+","
            }
        })
        var res=goods_id.substring(goods_id,goods_id.length-1);
        var num=buy_num.substring(buy_num,buy_num.length-1);
       // return false;
        $.ajax({
            url:"{{url('allshops/money')}}"
            ,data:{_token:_token,goods_id: res,buy_num:num}
            ,method:"post"
            ,async:false
        }).done( function(res){
            $('.orange.total').text(res);

        })



    }
    function delcart(goodsid){
        $.post(
            "{{url('shopcart/del')}}"
            ,{_token:_token,goods_id:goodsid}
            ,function(res){
                history.go(0);
                console.log(res)
            }
        )
    }
</script>
</body>
@endsection


