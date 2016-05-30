<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SiteHelper;

class MenuController extends Controller
{
    protected $routes = array();
    protected $module = 'menu';
    protected $permission = array();
    protected $info;
    protected $access;

    public function __construct(Router $router)
    {
        parent::__construct();
        $this->routes = $router;
        $this->info = SiteHelper::moduleInfo($this->module);
        $this->access = SiteHelper::checkPermission($this->info->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        $type = $request->get('type') ? $request->get('type') : 'frontend';

        $routes = $this->getRoute(); //get route parameters
        $menus = Menu::nestedMenu($type);
        $this->permission['permission'] = $this->access;
        return view('admin.menu.index', compact('routes', 'menus'), $this->permission);
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
        $rules = array(
            'active' => 'required',
            'menu_type' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $lang = SiteHelper::langOption();
            $language = array();
            foreach ($lang as $l) {
                if ($request->input('language_title_' . $l['folder'])) {
                    $menu_lang = ($request->input('language_title_' . $l['folder']));
                } else {
                    $menu_lang = ('');
                }
                $language['title'][$l['folder']] = $menu_lang;
            }

            $menu = new Menu();
            $menu->menu_name = $request->input('language_title_en');
            $menu->menu_lang = json_encode($language);
            $menu->menu_icon = $request->input('menu_icons');
            if ($request->has('slug')) {
                $menu->slug = $request->input('slug');
            } else {
                $menu->slug = "#";
            }
            $menu->active = $request->input('active');
            $menu->menu_type = $request->input('menu_type');
            $menu->save();

            Session::flash('status', 'Data Has Been Save Successfull!');
            return Redirect::back();

        } else {
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
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        $type = Input::get('type') ? Input::get('type') : 'frontend';

        $menu_data = Menu::find($id);
        $routes = $this->getRoute();
        $menus = Menu::nestedMenu($type);
        $this->permission['permission'] = $this->access;
        return view('admin.menu.edit', compact('routes', 'menus', 'menu_data'), $this->permission);
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
        $rules = array(
            'active' => 'required',
            'menu_type' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $lang = SiteHelper::langOption();
            $language = array();
            foreach ($lang as $l) {
                if ($request->input('language_title_' . $l['folder'])) {
                    $menu_lang = ($request->input('language_title_' . $l['folder']));
                } else {
                    $menu_lang = ('');
                }
                $language['title'][$l['folder']] = $menu_lang;
            }

            $menu = Menu::find($id);
            $menu->menu_name = $request->input('language_title_en');
            $menu->menu_lang = json_encode($language);
            $menu->menu_icon = $request->input('menu_icons');
            if ($request->has('slug')) {
                $menu->slug = $request->input('slug');
            } else {
                $menu->slug = "#";
            }
            $menu->active = $request->input('active');
            $menu->menu_type = $request->input('menu_type');
            $menu->save();

            Session::flash('status', 'Data Has Been Save Successfull!');
            return Redirect::back();

        } else {
            return Redirect::back();
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
        //
    }

    /**
     * @return array
     */
    protected function getRoute()
    {
        $results = [];

        foreach ($this->routes->getRoutes() as $route) {
            $results[] = $this->getRouteInformation($route);
        }

        return array_filter($results);
    }

    /**
     * @param Route $route
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        return $this->filterRoute([
            'method' => implode('|', $route->methods()),
            'uri' => $route->uri(),
            'action' => $route->getActionName(),
        ]);
    }

    /**
     * @param array $route
     * @return array
     */
    protected function filterRoute(array $route)
    {
        return $route;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function saveorder(Request $request, $id = 0)
    {
        $rules = [
            'reorder' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $menus = json_decode($request->input('reorder'), true);
            $child = array();
            $a = 0;
            foreach ($menus as $m) {
                //Check Child Menu
                if (isset($m['children'])) {
                    $b = 0;
                    foreach ($m['children'] as $l) {
                        //Check Create Child has Child Menu
                        if (isset($l['children'])) {
                            $c = 0;
                            foreach ($l['children'] as $l2) {
                                $level3[] = $l2['id'];
                                DB::table('menu')->where('id', '=', $l2['id'])
                                    ->update(array('parent_id' => $l['id'], 'ordering' => $c));
                                $c++;
                            }
                        }

                        //Save Menu Order
                        DB::table('menu')->where('id', '=', $l['id'])
                            ->update(array('parent_id' => $m['id'], 'ordering' => $b));
                        $b++;
                    }
                }
                DB::table('menu')->where('id', '=', $m['id'])
                    ->update(array('parent_id' => '0', 'ordering' => $a));
                $a++;
            }
            Session::flash('status', 'Data Has Been Save Successfull!');
            return Redirect::back();
        } else {
            return Redirect::back();

        }
    }

}