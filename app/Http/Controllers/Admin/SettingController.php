<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailSetting;
use App\Models\SiteSettings;
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
    protected $info;
    protected $access;

    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->info = SiteHelper::moduleInfo($this->module);
        $this->access = SiteHelper::checkPermission($this->info->id);

    }

    public function site_setting()
    {
        if ($this->access['view'] != '1')
            return view('admin.errors.403');

        $setting = SiteSettings::find(1);
        return view('admin.config.site_setting',compact('setting'));
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

            $template = 'index';
            return view('admin.config.translation.' . $template);
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

    public function save_site_setting(Request $request)
    {
        $settings = SiteSettings::find(1);
        $settings->site_name = $request->input('site_name');
        $settings->site_metakey = $request->input('site_metakey');
        $settings->site_metadesc = $request->input('site_metadesc');
        $settings->company_name = $request->input('company_name');
        $settings->company_email = $request->input('company_email');
        $settings->address = $request->input('address');
        $settings->phone = $request->input('phone');
        $settings->theme = $request->input('theme');
        $settings->facebook = $request->input('facebook');
        $settings->google_plus = $request->input('google');
        $settings->twitter = $request->input('twitter');
        $settings->save();

        return Redirect::back();
    }

}