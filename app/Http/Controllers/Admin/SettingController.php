<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailSetting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SiteHelper;

class SettingController extends Controller
{
    protected $module = 'setting';
    protected $permission = array();

    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->info = SiteHelper::moduleInfo($this->module);
        $this->access = SiteHelper::checkPermission($this->info->id);

    }


    public function translation(Request $request, $type = null)
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        if (!is_null($request->input('edit'))) {
            $file = (!is_null($request->input('file')) ? $request->input('file') : 'site.php');
            $files = scandir(base_path() . "/resources/lang/" . $request->input('edit') . "/");

            $str = \File::getRequire(base_path() . "/resources/lang/" . $request->input('edit') . '/' . $file);


            $en_file = (!is_null($request->input('file')) ? $request->input('file') : 'site.php');
            $en_files = scandir(base_path() . "/resources/lang/" . $request->input('edit') . "/");

            $en_str = \File::getRequire(base_path() . "/resources/lang/en" . '/' . $en_file);


            $this->data = array(
                'pageTitle' => 'Help Manual',
                'pageNote' => 'Documentation',
                'stringLang' => $str,
                'lang' => $request->input('edit'),
                'files' => $files,
                'file' => $file,
            );

            $this->en_data = array(
                'en_stringLang' => $en_str,
                'en_files' => $en_files,
                'en_file' => $en_file,
            );

            $template = 'edit';
            return view('admin.config.translation.' . $template, $this->data, $this->en_data);
        } else {

            $this->data = array(
                'pageTitle' => 'Help Manual',
                'pageNote' => 'Documentation',
            );
            $template = 'index';
            return view('admin.config.translation.' . $template, $this->data);
        }


    }

    public function addtranslation(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'folder' => 'required|alpha',
            'author' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {

            $template = base_path();

            $folder = $request->input('folder');
            mkdir($template . "/resources/lang/" . $folder, 0777);

            $info = json_encode(array("name" => $request->input('name'), "folder" => $folder, "author" => $request->input('author')));
            $fp = fopen($template . '/resources/lang/' . $folder . '/info.json', "w+");
            fwrite($fp, $info);
            fclose($fp);

            $files = scandir($template . '/resources/lang/en/');
            foreach ($files as $f) {
                if ($f != "." and $f != ".." and $f != 'info.json') {
                    copy($template . '/resources/lang/en/' . $f, $template . '/resources/lang/' . $folder . '/' . $f);
                }
            }
            return Redirect::back();

        } else {
            return Redirect::back();
        }

    }

    public function savetranslation(Request $request)
    {
        $template = base_path();

        $form = "<?php \n";
        $form .= "return array( \n";
        foreach ($_POST as $key => $val) {
            if ($key != '_token' && $key != 'lang' && $key != 'file') {
                if (!is_array($val)) {
                    $form .= '"' . $key . '"			=> "' . strip_tags($val) . '", ' . " \n ";
                } else {
                    $form .= '"' . $key . '"			=> array( ' . " \n ";
                    foreach ($val as $k => $v) {
                        $form .= '"' . $k . '"			=> "' . strip_tags($v) . '", ' . " \n ";
                    }
                    $form .= "), \n";
                }
            }
        }
        $form .= ');';
        $lang = $request->input('lang');
        $file = $request->input('file');
        $filename = $template . '/resources/lang/' . $lang . '/' . $file;
        $fp = fopen($filename, "w+");
        fwrite($fp, $form);
        fclose($fp);
        return Redirect::back();
    }

    public function removetranslation($folder)
    {
        self::removeDir(base_path() . "/resources/lang/" . $folder);
        return Redirect::back();
    }

    function removeDir($dir)
    {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                removedir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dir);
    }

    public function clear_cache()
    {
        return view('admin.config.clear_cache');
    }

    public function clear_cache_data()
    {

        $dir = base_path() . "/storage/logs";
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                //removedir($file);
            } else {

                unlink($file);
            }
        }

        $dir = base_path() . "/storage/framework/views";
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                //removedir($file);
            } else {

                unlink($file);
            }
        }

    }

    public function email_setting()
    {
        return view('admin.config.email_setting');
    }

    public function email_server_data(Request $request)
    {
        $input = Input::all();

        $validator = Validator::make(
            array(
                'emailFromName' => $input['emailFromName'],
                'emailFromEmail' => $input['emailFromEmail'],
                'SMTPHostAddress' => $input['SMTPHostAddress'],
                'SMTPHostPort' => $input['SMTPHostPort'],
                'EMailEncryptionProtocol' => $input['EMailEncryptionProtocol'],
                'SMTPServerUsername' => $input['SMTPServerUsername'],
                'SMTPServerPassword' => $input['SMTPServerPassword']
            ),

            array(
                'emailFromName' => 'required',
                'emailFromEmail' => 'required',
                'SMTPHostPort' => 'numeric',

            )
        );

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
            $val .= "define('EMailEncryptionProtocol','" . $request->input('EMailEncryptionProtocol') . "');\n";
            $val .= "define('SMTPServerUsername','" . $request->input('SMTPServerUsername') . "');\n";

            if($request->input('SMTPServerPassword') != '' || $request->input('SMTPServerPassword') != null ){
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