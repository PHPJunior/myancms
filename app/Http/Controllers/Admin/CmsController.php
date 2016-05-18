<?php

namespace App\Http\Controllers\Admin;

use App\Models\CmsPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SiteHelper;


class CmsController extends Controller
{
    protected $module = 'cms';
    protected $permission = array();
    protected $data = array();

    public function __construct()
    {
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

        $this->permission['permission'] = $this->access;
        return view('admin.cms.index', $this->permission);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['tables'] = SiteHelper::getTableList();
        return view('admin.cms.create', $this->data);
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
            'title' => 'required',
            'alias' => 'required',
            'filename' => 'required',
            'status' => 'required',
            'template' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $filename = base_path() ."/resources/views/pages/".$request->get('filename').".blade.php";

            $content = $request->get('content');
            $fp=fopen($filename,"w+");
            fwrite($fp,$content);
            fclose($fp);

            $page = new CmsPage();
            $page->title = $request->get('title');
            $page->slug = strtolower($request->get('alias'));
            $page->filename = strtolower($request->get('filename'));
            $page->status = $request->get('status');
            $page->template = $request->get('template');
            $page->database_table = $request->get('database_table');
            $page->save();

            self::createRoute();

            return Redirect::to('cms');
        }else{
            return Redirect::back()->withErrors($validator)->withInput();
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

    public function createRoute()
    {
        $rows = CmsPage::all();
        $val  =	"<?php \n";
        foreach($rows as $row)
        {
            $slug = $row->slug;
            $val .= "Route::get('{$slug}', 'HomeController@index');\n";
        }
        $val .= "?>";
        $filename = app_path().'/Http/page_routes.php';
        $fp=fopen($filename,"w+");
        fwrite($fp,$val);
        fclose($fp);
        return true;
    }

}