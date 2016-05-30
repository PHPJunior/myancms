<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Repository\BlogRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SiteHelper;

/**
 * @property array|bool|mixed access
 */
class BlogController extends Controller
{
    protected $module = 'blog';
    protected $permission = array();
    protected $blog;
    protected $info;

    /**
     * BlogController constructor.
     * @param BlogRepository $blog
     */
    public function __construct(BlogRepository $blog)
    {
        parent::__construct();
        $this->info = SiteHelper::moduleInfo($this->module);
        $this->access = SiteHelper::checkPermission($this->info->id);
        $this->blog = $blog;
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
        return view('admin.blog.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->access['create'] != '1')
            return view('admin.errors.403');

        $tags = Blog::TagsList();
        return view('admin.blog.create')->with('tags',$tags);
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
        $slug = Str::slug($request->input('title'));
        if (!$slug) {
            $slug = Str::random(7);
        }
        $blog->user_id = Session::get('admin_id');
        $blog->title = $request->input("title");
        $blog->description = $request->input('description');
        $blog->slug = $slug;

        if($request->hasFile('image')){
            $img = file_get_contents($request->file('image'));
            $imagefile = 'data:image/png;base64,' . base64_encode($img);
            $blog->image = $imagefile;
        }

        $blog->save();

        $tags = Blog::find($blog->id);

        $tags->tag($request->input('tags'));

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
        if ($this->access['update'] != '1')
            return view('admin.errors.403');
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
        if ($this->access['delete'] != '1')
            return view('admin.errors.403');

    }

}