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
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(SiteSettings $siteSettings)
    {
        $this->middleware('guest');
        $this->siteSettings = $siteSettings;
    }

    public function showResetForm(Request $request, $token = null)
    {
        $theme = $this->siteSettings->find(1);

        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');
        return view('theme.'.$theme->theme.'.password.reset')->with(compact('token','email','theme'));
    }


    public function getEmail()
    {
        $theme = $this->siteSettings->find(1);
        return view('theme.'.$theme->theme.'.password.password',compact('theme'));
    }

}
