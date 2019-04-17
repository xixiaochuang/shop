<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $res= \App\Model\Goods::get();
    return view('Index',['data'=>$res]);
});
Route::any('userpage','UserpageController@lists');
Route::any('shopcart','CartController@cartlist');
Route::any('shopcart/del','CartController@del');
Route::any('shopcart/payment','ShopController@payment');
Route::any('allshops',"ShopController@shoplist");
Route::any('allshops/checklogin',"ShopController@checklogin");
Route::any('allshops/shopcate',"ShopController@shopcate");
Route::any('allshops/shopinfo',"ShopController@shopinfo");
Route::any('allshops/money',"ShopController@money");
Route::any('/goods/shop','GoodsController@shopcontent');
Route::prefix('userpage')->group(function (){
        Route::any('buyrecord',function (){
            return view('buyrecord');
        });
        Route::any('address',"UserpageController@address");
        Route::any('writeaddr','UserpageController@writeadd');
        Route::any('share','UserpageController@share');
        Route::any('invite',function (){
            return view('invite');
        });
        Route::any('mywallet',function (){
            return view('mywallet');
        });
        Route::any('login',function (){
            return view('login');
        });
        Route::any('login/regauth','LoginController@regauth');
        Route::any('login/add','LoginController@add');
        Route::any('login/checklogin','LoginController@checklogin');
        Route::any('register',function (){
            return view('register');
        });
    Route::any('mody-loginpwd',function (){
        return view('mody-loginpwd');
    });
});
Route::any('text',"Captchas@verify");
Route::any('texts',"LoginController@captcha");
Route::prefix('alipay')->group(function(){
   route::any('pay',"AlipayController@pay");
   Route::any('yibu',"AlipayController@yibu");
   Route::any('dongbu',"AlipayController@dongbu");

});
Route::prefix('address')->group(function(){
    route::any('writeadd',"OrderController@add");
});