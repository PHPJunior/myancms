<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\SiteSettings;
use App\Models\UserAccess;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Database;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use InstalledFile;
use SiteHelper;

class InstallerController extends Controller
{

    protected $roles;

    /**
     * InstallerController constructor.
     */
    public function __construct()
    {
        $this->roles = Sentinel::getRoleRepository()->createModel();

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('installer.welcome');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function environment()
    {
        $envConfig = SiteHelper::getEnvContent();
        return view('installer.environment', compact('envConfig'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function environmentSave(Request $request)
    {
        $message = SiteHelper::saveEnvFile($request);
        return Redirect::back()->with(['message' => $message]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        return view('installer.user');
    }

    /**
     * @param Request $request
     * @param Database $database
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userSave(Request $request, Database $database)
    {
        $rule = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {

            if ($database->migrateAndSeed()) {

                $credentials = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ];

                $user = Sentinel::registerAndActivate($credentials);

                Sentinel::getRoleRepository()->createModel()->create([
                    'name' => 'Administrator',
                    'slug' => 'admin',
                    'permissions' => [
                        'admin' => true,
                    ]
                ]);

                $role = Sentinel::findRoleByName('Administrator');

                $role->users()->attach($user);

                $data = [
                    'create' => '0',
                    'delete' => '0',
                    'view' => '0',
                    'update' => '0',
                ];

                $module_list = Module::all();

                foreach ($module_list as $module) {
                    $access_data = new UserAccess();
                    $access_data->access_data = json_encode($data);
                    $access_data->user_id = $user->id;
                    $access_data->module_id = $module->id;
                    $access_data->save();
                }
                return Redirect::to('install/setting');
            } else {
                return view('installer.error');
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting()
    {
        return view('installer.setting');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function saveSetting(Request $request)
    {

        $settings = new SiteSettings();
        $settings->site_name = $request->input('site_name');
        $settings->site_metakey = $request->input('site_metakey');
        $settings->site_metadesc = $request->input('site_metadesc');
        $settings->company_name = $request->input('company_name');
        $settings->company_email = $request->input('company_email');
        $settings->address = $request->input('address');
        $settings->phone = $request->input('phone');
        $settings->facebook = $request->input('facebook');
        $settings->google_plus = $request->input('google_plus');
        $settings->twitter = $request->input('twitter');
        $settings->save();

        return Redirect::to('install/finished');
    }

    /**
     * @param InstalledFile $installedFile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finished(InstalledFile $installedFile)
    {
        $installedFile->update();
        return view('installer.finished');
    }

}
