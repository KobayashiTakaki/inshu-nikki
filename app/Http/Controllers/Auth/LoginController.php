<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     *  デモユーザでログイン
     *
     * @return \Illuminate\Http\Response
     */
     public function loginDemo()
     {
       Auth::login(User::where('twitter_id','11111111')->first());
       Auth::user()->update(['api_token' => str_random(60)]);
       return redirect('/');
     }

    /**
     * Twitterの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitterからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();

        // $user->token;
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        Auth::user()->update(['api_token' => str_random(60)]);
        return redirect('/');
    }

    private function findOrCreateUser($twitterUser){
        $authUser = User::where('twitter_id', $twitterUser->id)->first();
        if ($authUser){
            return $authUser;
        }
        return User::create([
            'name' => $twitterUser->name,
            'twitter_id' => $twitterUser->id
        ]);
    }



    protected function authenticated(Request $request, $user)
    {
        $user->update(['api_token' => str_random(60)]);
    }

    public function logout(Request $request)
    {
        // api_tokenをnullにする
        $user = $request->user();
        if ($user !== null)
        {
          $user->update(['api_token' => null]);
        }

        $this->guard()->logout();

        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
