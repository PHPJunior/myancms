<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

/**
 * @property SiteSettings siteSettings
 */
class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct(SiteSettings $siteSettings)
    {
        parent::__construct();
        $this->siteSettings = $siteSettings;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $theme = $this->siteSettings->find(1);

        if ($request->path() == '/') {
            $page = CmsPage::getFrontPage('home');
            if ($page->database_table) {
                $data = DB::table($page->database_table)->get();
                return view('theme.' . $theme->theme . '.pages.home', compact('theme', 'data'));
            }
            return view('theme.' . $theme->theme . '.pages.home', compact('theme'));
        }

        $page = CmsPage::getFrontPage($request->path());
        if ($page->database_table) {
            $data = DB::table($page->database_table)->get();
            return view('theme.' . $theme->theme . '.pages.' . $page->filename, compact('theme', 'data'));
        }
        return view('theme.' . $theme->theme . '.pages.' . $page->filename, compact('theme'));
    }
}
