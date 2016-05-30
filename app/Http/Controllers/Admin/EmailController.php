<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SiteHelper;

class EmailController extends Controller
{
    protected $module = 'email';
    protected $permission = array();
    protected $info;
    protected $access;

    /**
     * EmailController constructor.
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

        $this->permission['permission'] = $this->access;
        return view('admin.config.email_setting');
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');
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

    public function email_server_data(Request $request)
    {
       $rule = [
            'emailFromName' => 'required',
            'emailFromEmail' => 'required',
            'SMTPHostPort' => 'numeric',
        ];

        $validator = Validator::make( $request->all(),$rule );

        if ($validator->fails()) {

            return Redirect::back()
                ->withInput()
                ->WithErrors($validator);

        } else {

            $val = "<?php \n";
            $val .= "define('emailFromName','" . $request->input('emailFromName') . "');\n";
            $val .= "define('emailFromEmail','" . $request->input('emailFromEmail') . "');\n";
            $val .= "define('SMTPHostAddress','" . $request->input('SMTPHostAddress') . "');\n";
            $val .= "define('SMTPHostPort','" . $request->input('SMTPHostPort') . "');\n";
            $val .= "define('MailDriver','" . $request->input('MailDriver') . "');\n";
            $val .= "define('EMailEncryptionProtocol','" . $request->input('EMailEncryptionProtocol') . "');\n";
            $val .= "define('SMTPServerUsername','" . $request->input('SMTPServerUsername') . "');\n";

            if($request->input('SMTPServerPassword') !== '' || $request->input('SMTPServerPassword') !== null ){
                $val .= "define('SMTPServerPassword','" . $request->input('SMTPServerPassword') . "');\n";
            }else{
                $val .= "define('SMTPServerPassword','" . $request->input('SMTPServerPassword02') . "');\n";
            }

            $val .= "?>";

            $filename = base_path() . '/resources/views/admin/config/setting_file/mailsetting.php';
            $fp = fopen($filename, "w+");
            fwrite($fp, $val);
            fclose($fp);

            Session::flash('Message', 'Mail Server Successfully Updated.');

            return Redirect::back();

        }
    }
}