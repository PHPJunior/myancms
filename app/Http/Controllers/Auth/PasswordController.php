<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use MemPassword;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/';
    protected $siteSettings;

    /**
     * Create a new password controller instance.
     *
     * @param SiteSettings $siteSettings
     */
    public function __construct(SiteSettings $siteSettings)
    {
        $this->middleware('guest');
        parent::__construct();
        $this->siteSettings = $siteSettings;
    }

    /**
     * @param Request $request
     * @param null $token
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $theme = $this->siteSettings->find(1);

        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');
        return view('theme.'.$theme->theme.'.password.reset')->with(compact('token','email','theme'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmail()
    {
        $theme = $this->siteSettings->find(1);
        return view('theme.'.$theme->theme.'.password.password',compact('theme'));
    }

}
