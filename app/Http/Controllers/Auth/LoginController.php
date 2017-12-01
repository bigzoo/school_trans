<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
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
    protected $redirectTo = '/home';

    /**
     * The application proxy.
     *
     * @var LoginProxy
     */
    private $loginProxy;

    /**
     * Create a new controller instance.
     *
     * @param LoginProxy $loginProxy
     */

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
        $this->middleware('guest')->except('logout','refresh');
    }


    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

//        return $this->response($this->loginProxy->attemptLogin($email, $password));
        return $this->loginProxy->attemptLogin($email, $password);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function refresh(Request $request)
    {
        return $this->loginProxy->attemptRefresh();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        $this->loginProxy->logout();

        return $this->response(null, 204);
    }
}
