<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller('mail','MailController');

Route::get('mail', 'MailController@getSend');

//login 個d
Route::auth();
//Project page
Route::get('/', 'ProjectPageController@index');
//Project Submit and Image Upload
Route::group(['middleware' => 'auth'], function () {
    Route::POST('projectSubmit', 'ProjectPageController@submit');
});
Route::POST('projectUpload', 'ProjectPageController@upload');

Route::get('myproject', 'OwnProjectController@index');
Route::get('myproject/{bugId}', 'OwnProjectController@bugInfo');
Route::get('myproject/{userId}/getBugList', 'OwnProjectController@getBug');


//www.404NotFound.wingpage.net/project/{projectId}
Route::pattern('projectId', '[0-9]*'); //條件 正則表達式 Regex 任意長度
Route::pattern('bugId', '[0-9]*'); //條件 正則表達式 Regex 0-9 任意長度
Route::group(['prefix' => 'project'], function () {
    Route::get('{projectId}', 'ProjectBugListController@index');
    Route::get('{projectId}/getbugList', 'ProjectBugListController@getBug');
    Route::get('{projectId}/reportBug', 'ProjectBugListController@reportBug')->name('reportBug')->middleware('auth');
    Route::get('{projectId}/{bugId}', 'ProjectBugListController@bugInfo')->name('bugInfo');
    Route::POST('{projectId}/{bugId}/commentSubmit', 'ProjectBugController@commentSubmit')->name('commentSubmit');
});



Route::POST('updateStatus', 'ProjectBugController@statusChange');
Route::POST('updateFire', 'ProjectBugController@fireSubmit');


//Report bugs
Route::group(['middleware' => 'auth'], function () {
    Route::POST('bugSubmit', 'ReportBugController@submit');
});
Route::POST('reportBugFileUpload', 'ReportBugController@upload');




Route::get('/home', 'HomeController@index');

//Google Sign-in
//路由前綴 'prefix'
//全部'login/social' 都會自動入來處理 e,g:login/social/xxx
Route::group(['prefix' => 'login/social', 'middleware' => ['guest']], function () {

    Route::POST('{provider}/redirect', [
        //識別名稱
        'as'   => 'social.redirect',
        //指定到控制器執行
        'uses' => 'Auth\SocialController@getSocialRedirect',
    ]);
    //google set好 驗證完會重新導向去 http://www.404notfound.wingpage.net/login/social/google/callback
    //https://console.developers.google.com/apis/
    Route::get('{provider}/callback', [
        //識別名稱
        'as'   => 'social.handle',
        //指定到控制器執行
        'uses' => 'Auth\SocialController@getSocialCallback',
    ]);
});
