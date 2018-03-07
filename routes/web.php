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

Route::get('/','HomeController@index');
Route::get('/list','HomeController@lists');
Route::get('/list-vip','HomeController@listvip');
Route::get('/list-long','HomeController@listlong');
Route::get('/view','HomeController@pageview');

//会员中心

Route::group(['middleware' => 'userlogin','prefix' => 'member'],function()
{
    Route::get('/','HomeController@member');
    Route::get('/vip','HomeController@vip');

    Route::group(['namespace' => 'Cont'],function()
    {
        Route::get('/logout','UserController@logout');
    });
});

Route::group(['prefix' => 'mobile'],function()
{
    Route::get('/index','MobileController@index');
    Route::get('/list','MobileController@listView');
    Route::get('/list-vip','MobileController@listVipView');
    Route::get('/list-long','MobileController@listLongView');
    Route::get('/view','MobileController@playView');
    Route::get('/register','MobileController@registerView');
    Route::get('/login','MobileController@loginView');

    Route::group(['prefix' => 'member','middleware' => 'mobilelogin'],function()
    {
        Route::get('/index','MobileController@memberView');
        Route::get('/changUser','MobileController@userInfoView');
        Route::get('/vip','MobileController@userVipView');

    });

});


Route::group(['namespace' => 'Admin'],function()
{
    Route::get('/webhadmin/index','LoginController@index');
    Route::post('/webadminlogin/gethalt','LoginController@getHalt');


    Route::group(['middleware' => 'adminlogin','prefix'=>'admin'],function()
    {
        Route::get('/htadmin','IndexController@index');
        Route::get('/user','UserController@index');
        Route::get('/vip','UserController@vip');
        Route::get('/setvip','UserController@setVip');
        Route::get('/deleteuser','UserController@delete');
        Route::get('/video','VideoController@index');
        Route::get('/video/setvip','VideoController@setvip');
        Route::get('/video/delete','VideoController@delete');
        Route::get('/videovip','VideoController@vip');
        Route::get('/lengthlong','VideoController@lengthlong');
        Route::get('/loading','VideoController@loading');
        Route::get('/recovervideo','VideoController@recovervideo');
        Route::get('/video/setok','VideoController@setok');
        Route::get('/videoadd','VideoController@add');
        Route::post('/video/addHalt','VideoController@addHalt');
        Route::get('/links','LinkController@index');
        Route::get('/linksadd','LinkController@add');
        Route::get('/link/delete','LinkController@delete');
        Route::get('/logout','IndexController@logout');
        Route::get('/system','SystemController@index');
        Route::post('/system/addHalt','SystemController@addHalt');
        Route::get('/clearCache','SystemController@clearCache');
        Route::post('/link/addHalt','LinkController@addHalt');
        Route::get('/code','CodeController@index');
        Route::get('/addcode','CodeController@addcode');
        Route::get('/notice','NoticeController@index');
        Route::get('/noticeadd/','NoticeController@add');
        Route::get('/noticeedit/{id}','NoticeController@edit');
        Route::get('/notice/delete','NoticeController@delete');
        Route::post('/notice/addHalt','NoticeController@addHalt');
        Route::get('/message','MessageController@index');
        Route::get('/servicelink','SystemController@servicelink');
        Route::get('/servicelinkview','SystemController@servicelinkView');
        Route::get('/serviceLinkDelete','SystemController@serviceLinkDelete');
        Route::post('/message/addHalt','MessageController@addHalt');
        Route::post('/videoservice/serviceAdd','SystemController@serviceAdd');
    });



});


//接口
Route::group(['prefix' => 'Api'],function()
{
    Route::get('/getImagesLink','ApiController@getImageLink');
    Route::get('/getHome','ApiController@getHome');
    Route::get('/getVideoList','ApiController@getVideoList');

    Route::group(['namespace' => 'Cont'],function()
    {
        //Route::post('/checkUser','UserController@checkUser');  //检测用户名是否存在
        Route::post('/reg','UserController@regUser');
        Route::post('/login','UserController@login');
        Route::post('/updateEmail','UserController@updateEmail');
        Route::post('/updatePassword','UserController@updatePassword');

        Route::post('actionCode','CodeController@actionCode');

        Route::get('getVideo','VideoController@findVideo');
        Route::get('getRandVideo','VideoController@randVideo');

        Route::get('getService','VideoServiceController@getList');
        Route::get('changeLine','VideoServiceController@changeLine');

    });

});


