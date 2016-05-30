<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use App\Models\UserAccess;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use SiteHelper;

class ModuleController extends Controller
{
    protected $module = 'module';
    protected $permission = array();
    protected $access;
    protected $info;

    /**
     * ModuleController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->info = SiteHelper::moduleInfo($this->module);
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

        $module_list = Module::all();
        $this->permission['permission'] = $this->access;
        return view('admin.module.index', compact('module_list'), $this->permission);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage_permission($id)
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        $this->permission['permission'] = $this->access;
        $module = Module::find($id);
        $users = User::get_all_admin_list();
        return view('admin.module.manage_permission', compact('module', 'users'), $this->permission);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save_user_permission(Request $request,$id, $module_id)
    {

        $data = [
            'create' => $request->input('create'),
            'delete' => $request->input('delete'),
            'view' =>   $request->input('view'),
            'update' => $request->input('update'),
        ];

        $access_data = UserAccess::where('user_id', $id)->where('module_id', $module_id)->update(['access_data' => json_encode($data)]);

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
        $module = new Module();
        $module->module_name = Input::get('module_name');
        $module->module_title = Input::get('module_title');

        if($module->save()){

            $data = [
                'create' => '0',
                'delete' => '0',
                'view' => '0',
                'update' => '0',
            ];

            $user_list = User::all();
            foreach($user_list as $user){
                $access_data = new UserAccess();
                $access_data->access_data = json_encode($data);
                $access_data->user_id = $user->id;
                $access_data->module_id = $module->id;
                $access_data->save();
            }

            return Redirect::back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
