<?php

namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use App\SocialUser as SocialUserEloquent;
use App\User as UserEloquent;
use Auth;

// https://github.com/barryvdh/laravel-debugbar/issues/316
use Barryvdh\Debugbar\Facade as Debugbar;
use Config;
use Illuminate\Http\Request;
use Redirect;
use Socialite;

//處理第三方登入重新導向
class SocialController extends Controller
{
    public $login_role;

    public function getSocialRedirect(Request $request)
    {

        session()->put('role', $request->input('role'));

        $providerKey = Config::get('services.' . $request->input('provider'));
        //provider 系在login.blade.php個陣輪入的['provider' => 'google']

        if (empty($providerKey)) {
            return App::abort(404);
        }
        return Socialite::driver($request->input('provider'))->redirect();
    }

    public function getSocialCallback($provider, Request $request)
    {
        $login_role = session()->pull('role');
        Debugbar::error($login_role);
        Debugbar::error($login_role);

        if ($request->exists('error')) {
            return Redirect::action('Auth\AuthController@showLoginForm')->withErrors(['msg' => $provider . '登入失敗']);
        }
        $socialite_user = Socialite::with($provider)->user();
        $login_user     = null;

        $user = UserEloquent::where('role', $login_role)->where('email', $socialite_user->email)->where('provider', $provider)->first();
        if (!empty($user)) {
            //使用已註冊的帳號登入
            $login_user = $user;
        } else {
            //建立帳號
            $new_user = new UserEloquent([
                'email' => $socialite_user->email,
                'name'  => $socialite_user->name,
                'role'  => $login_role,
            ]);
            $new_user->provider = $provider;
            $new_user->save();
            $new_socialUser = new SocialUserEloquent([
                'user_id'          => $new_user->id,
                'provider_user_id' => $socialite_user->id,
                'provider'         => $provider,
            ]);
            $new_socialUser->save();
            $login_user = $new_user;
        }
        if (!is_null($login_user)) {
            Auth::login($login_user);
            if (session()->has('backUrl')) {
                return Redirect::to(session()->pull('backUrl'));//在Authenticate save底的
            }
            return Redirect::action('ProjectPageController@index');
        }
        return App::abort(500);
    }
}
