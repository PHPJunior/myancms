<?php

namespace App\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SiteHelper;

class RoleController extends Controller
{
    protected $roles;
    protected $module = 'role';
    protected $permission = array();
    protected $access;
    protected $info;

    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->roles = Sentinel::getRoleRepository()->createModel();
        $this->info =  SiteHelper::moduleInfo($this->module);
        $this->access = SiteHelper::checkPermission($this->info->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->access['view'] != '1' )
            return view('admin.errors.403');

        $roles = $this->roles->paginate();
        return view('admin.role.index',compact('roles'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name'       => 'required',
            'slug'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }else{
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'permissions' => [
                    $request->input('slug') => true,
                ]
            ]);

            return Redirect::to('role');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'name'       => 'required',
            'slug'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }else{
            $role = Sentinel::findRoleBySlug(Input::get('slug'));
            $role->name = $request->input('name');
            $role->save();

            return Redirect::to('role');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($role = Sentinel::findRoleById($id))
        {
            $role->delete();

            return Redirect::to('role');
        }

        return Redirect::to('role');
    }
}
