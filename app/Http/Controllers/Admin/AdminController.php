<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\UserAccess;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SiteHelper;

class AdminController extends Controller
{
    protected $roles;
    protected $module = 'admin';
    protected $permission = array();
    protected $info;
    protected $access;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->roles = Sentinel::getRoleRepository()->createModel();

        //Check Module Info
        $this->info = SiteHelper::moduleInfo($this->module);
        //Check User Permission
        $this->access = SiteHelper::checkPermission($this->info->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        $this->permission['permission'] = $this->access;
        $users = User::get_all_admin_list();
        $roles = $this->roles->paginate();
        return view('admin.list.index', compact('users', 'roles'), $this->permission);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($user = Sentinel::registerAndActivate($request->all())) {

            $role = Sentinel::findRoleBySlug($request->input('role'));
            $role->users()->attach($user);

            $data = [
                'create' => '0',
                'delete' => '0',
                'view' => '0',
                'update' => '0',
            ];

            $module_list = Module::all();

            if($module_list) {
                foreach ($module_list as $module) {
                    $access_data = new UserAccess();
                    $access_data->access_data = json_encode($data);
                    $access_data->user_id = $user->id;
                    $access_data->module_id = $module->id;
                    $access_data->save();
                }
            }
            Session::flash('status', 'User added sucessful!');
            return Redirect::to('admin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users'
        ];

        if ($id) {
            $user = Sentinel::findById($id);
            $user_role = User::get_user_role($id);
            $rules['email'] .= ",email,{$user->email},email";

            $messages = $this->validateUser($request->all(), $rules);

            if ($messages->isEmpty()) {

                if ($request->input('password')) {
                    $credentials = [
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('last_name'),
                        'password' => $request->input('password'),
                        'email' => $request->input('email'),
                    ];
                } else {
                    $credentials = [
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('last_name'),
                        'email' => $request->input('email'),
                    ];
                }
                if ( Sentinel::update($user, $credentials)) {
                    $user = Sentinel::findById($id);

                    $role = Sentinel::findRoleBySlug($user_role->slug);
                    if ($role->users()->detach($user)) {
                        $role = Sentinel::findRoleBySlug($request->input('role'));
                        $role->users()->attach($user);
                    }

                }

            }
        }

        if ($messages->isEmpty()) {
            \Session::flash('status', 'User updated sucessful!');
            return Redirect::to('admin');
        }

        return Redirect::back()->withInput()->withErrors($messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($user = Sentinel::findById($id)) {
            $user->delete();
            UserAccess::where('user_id',$id)->delete();
            return Redirect::to('admin');
        }

        return Redirect::to('admin');
    }

    protected function validateUser($data, $rules)
    {
        $validator = Validator::make($data, $rules);

        $validator->passes();

        return $validator->errors();
    }

    public function changePassword(Request $request)
    {
        $id = Session::get('admin_id');
        if ($id) {
            $user = Sentinel::findById($id);
            if ($user) {
                if ($request->input('password_data.password')) {
                    $credentials = [
                        'password' => $request->input('password_data.password'),
                    ];

                    if (Sentinel::update($user, $credentials)) {
                        return 'true';
                    } else {
                        return 'false';
                    }
                }
            }
        }
    }

}
