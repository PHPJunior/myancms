<?php

namespace App\Http\Controllers\Admin;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return Sentinel::check() ? Redirect::intended('dashboard') : view('admin.login.login');
    }

    /**
     * @return $this
     */
    public function postLogin(Request $request)
    {
        try
        {
            $rules = [
                'email'    => 'required|email',
                'password' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
            {
                return Redirect::to('letmein')
                    ->withInput()
                    ->withErrors($validator);
            }

            $remember = (bool) $request->get('remember', false);

            if ($user = Sentinel::authenticate($request->all(), $remember))
            {
                return Redirect::intended('dashboard');
            }
            Session::flash('status','Invalid Login or password!');
        }
        catch (NotActivatedException $e)
        {
            $errors = 'Account is not activated!';

            return Redirect::to('letmein')->with('user', $e->getUser());
        }
        catch (ThrottlingException $e)
        {
            $delay = $e->getDelay();

            $errors = "Your account is blocked for {$delay} second(s).";
            return view('admin.login.ipblock')->with('errors',$errors);
        }

        return Redirect::to('letmein');

    }

    public function getLogout()
    {
        Sentinel::logout();
        return Redirect::to('/');
    }
}
