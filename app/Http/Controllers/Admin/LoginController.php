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
    public function postLogin()
    {
        try
        {
            $input = Input::all();

            $rules = [
                'email'    => 'required|email',
                'password' => 'required',
            ];

            $validator = Validator::make($input, $rules);

            if ($validator->fails())
            {
                return Redirect::to('letmein')
                    ->withInput()
                    ->withErrors($validator);
            }

            $remember = (bool) Input::get('remember', false);

            if ($user = Sentinel::authenticate(Input::all(), $remember))
            {
                Session::put('admin_id',$user->id);
                Session::put('admin_first_name',$user->first_name);
                Session::put('admin_last_name',$user->last_name);
                Session::put('admin_email',$user->email);
                Session::put('last_login',$user->last_login);
                Session::put('is_logged_in','true');

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
