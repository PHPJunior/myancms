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
    protected $model;
    protected $access;
    protected $info;

    /**
     * CmsController constructor.
     * @param CmsPage $cmsPage
     */
    public function __construct(CmsPage $cmsPage)
    {
        parent::__construct();
        $this->model = $cmsPage;
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
        return view('admin.cms.index', compact('themes'), $this->permission);
    }

    public function page_list($theme)
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        $pages = $this->model->all();
        $this->permission['permission'] = $this->access;
        return view('admin.cms.page_list', compact('pages', 'theme'), $this->permission);
    }

    public function addtheme(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'folder' => 'required|alpha',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $template = base_path();

            $folder = $request->input('folder');
            mkdir($template . "/resources/views/theme/" . $folder, 0777);

            $info = json_encode(array("name" => $request->input('name'), "folder" => $folder, "created_at" => date('Y-m-d H:i:s')));
            $fp = fopen($template . '/resources/views/theme/' . $folder . '/info.json', "w+");
            fwrite($fp, $info);
            fclose($fp);

            $files = scandir($template . '/resources/views/theme/default/');
            foreach ($files as $f) {
                if ($f != "." && $f != ".." && $f != "info.json") {
                    if (is_dir($template . '/resources/views/theme/default/' . $f)) {

                        mkdir($template . "/resources/views/theme/" . $folder . '/' . $f, 0777);
                        $folders = scandir($template.'/resources/views/theme/default/'.$f.'/');

                        foreach ($folders as $file) {
                            if ($file != "." && $file != "..") {
                                copy($template . '/resources/views/theme/default/' . $f . '/' . $file, $template . '/resources/views/theme/' . $folder . '/' . $f . '/' . $file);
                            }
                        }

                    }else {
                        copy($template . '/resources/views/theme/default/' . $f, $template . '/resources/views/theme/' . $folder . '/' . $f );
                    }
                }
            }
            return Redirect::back();

        } else {
            return Redirect::back();
        }
    }

    public function removetheme($folder)
    {
        self::removeDir(base_path() . "/resources/views/theme/" . $folder);
        return Redirect::back();
    }

    function removeDir($dir)
    {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {

                foreach (glob($file . '/*') as $files) {
                    unlink($files);
                }
                rmdir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dir);
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
        if ($this->access['create'] != '1')
            return view('admin.errors.403');

        $rules = [
            'title' => 'required',
            'alias' => 'required',
            'filename' => 'required',
            'status' => 'required',
            'template' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            foreach(SiteHelper::themeOption() as $themes){
                $filename = base_path() . "/resources/views/theme/" . $themes['folder'] . "/pages/" . $request->get('filename') . ".blade.php";

                $content = $request->get('content');
                $fp = fopen($filename, "w+");
                fwrite($fp, $content);
                fclose($fp);
            }

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
        } else {
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
    public function edit(Request $request, $id)
    {
        $page = $this->model->find($id);
        $theme = $request->get('theme');

        if ($page) {
            $filename = base_path() . "/resources/views/theme/" . $theme . "/pages/" . $page->filename . ".blade.php";
            if (file_exists($filename)) {
                $this->data['content'] = file_get_contents($filename);
            } else {
                $this->data['content'] = '';
            }
        }


        $this->data['id'] = $id;
        $this->data['title'] = $page->title;
        $this->data['filename'] = $page->filename;
        $this->data['slug'] = $page->slug;
        $this->data['status'] = $page->status;
        $this->data['database_table'] = $page->database_table;
        $this->data['template'] = $page->template;
        $this->data['theme'] = $theme;
        $this->data['tables'] = SiteHelper::getTableList();

        return view('admin.cms.edit', $this->data);
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
        if ($this->access['update'] != '1')
            return view('admin.errors.403');

        $rules = [
            'title' => 'required',
            'alias' => 'required',
            'filename' => 'required',
            'status' => 'required',
            'template' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $filename = base_path() . "/resources/views/theme/" . $request->get('theme') . "/pages/" . $request->get('filename') . ".blade.php";

            $content = $request->get('content');
            $fp = fopen($filename, "w+");
            fwrite($fp, $content);
            fclose($fp);

            $page = $this->model->find($id);
            $page->title = $request->get('title');
            $page->slug = strtolower($request->get('alias'));
            $page->filename = strtolower($request->get('filename'));
            $page->status = $request->get('status');
            $page->template = $request->get('template');
            $page->database_table = $request->get('database_table');
            $page->save();

            self::createRoute();

            return Redirect::to('cms');
        } else {

            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->access['delete'] != '1')
            return view('admin.errors.403');


    }

    public function createRoute()
    {
        $rows = CmsPage::all();
        $val = "<?php ";
        foreach ($rows as $row) {
            $slug = $row->slug;
            $val .= "Route::get('{$slug}', 'HomeController@index');\n";
        }
        $filename = app_path() . '/Http/page_routes.php';
        $fp = fopen($filename, "w+");
        fwrite($fp, $val);
        fclose($fp);
        return true;
    }

}