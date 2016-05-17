<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SiteHelper;

class BlogController extends Controller
{
    protected $module = 'blog';
    protected $permission = array();

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
        return view('admin.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'title' =>'required',
            'description' => 'required',
        ];
        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v)->withInput();
        }
        $blog = new Blog();
        $slug = Str::slug($request->get('title'));
        if (!$slug) {
            $slug = Str::random(7);
        }
        $blog->user_id = Session::get('admin_id');
        $blog->title = $request->get("title");
        $blog->description = $request->get('description');
        $blog->slug = $slug;

        if($request->hasFile('image')){
            $img = file_get_contents($request->file('image'));
            $imagefile = 'data:image/png;base64,' . base64_encode($img);
            $blog->image = $imagefile;
        }

        $blog->save();

        $tags = Blog::find($blog->id);

        $tags->tag($request->get('tags'));

        return Redirect::back()->with('Message', 'New Blog is created');
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