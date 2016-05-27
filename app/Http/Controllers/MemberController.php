<?php

namespace App\Http\Controllers;

use App\Member;
use App\Models\SiteSettings;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    use ThrottlesLogins;

    /**
     * MemberController constructor.
     */
    public function __construct(SiteSettings $siteSettings)
    {
        parent::__construct();
        $this->siteSettings = $siteSettings;
    }

}
