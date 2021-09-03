<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LanguageController extends Controller
{

    public function index()
    {
        return view('admin-views.business-settings.language.index');
    }

    public function index_app()
    {
        return view('admin-views.business-settings.language.index-app');
    }

    public function store(Request $request)
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $lang_array = [];
        foreach (json_decode($language['value'], true) as $key => $data) {
            if ($data['code'] != $request['code']) {
                array_push($lang_array, $data);
            }
        }

        if (!file_exists(base_path('resources/lang/' . $request['code']))) {
            mkdir(base_path('resources/lang/' . $request['code']), 0777, true);
        }

        $lang_file = fopen(base_path('resources/lang/' . $request['code'] . '/' . 'messages.php'), "w") or die("Unable to open file!");
        $read = file_get_contents(base_path('resources/lang/en/messages.php'));
        fwrite($lang_file, $read);

        array_push($lang_array, [
            'id' => count(json_decode($language['value'], true)) + 1,
            'name' => $request['name'],
            'code' => $request['code'],
            'status' => 0,
        ]);

        BusinessSetting::where('type', 'language')->update([
            'value' => $lang_array
        ]);

        return back();
    }

    public function update_status(Request $request)
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $lang_array = [];
        foreach (json_decode($language['value'], true) as $key => $data) {
            if ($data['code'] == $request['code']) {
                if ($data['status'] == 1) {
                    $lang = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'code' => $data['code'],
                        'status' => 0,
                    ];
                } else {
                    $lang = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'code' => $data['code'],
                        'status' => 1,
                    ];
                }
                array_push($lang_array, $lang);
            } else {
                array_push($lang_array, $data);
            }
        }
        BusinessSetting::where('type', 'language')->update([
            'value' => $lang_array
        ]);
    }

    public function translate($lang)
    {
        return view('admin-views.business-settings.language.translate', compact('lang'));
    }

    public function translate_submit(Request $request, $lang)
    {
        $data = array_combine($request['key'], $request['value']);
        $str = "<?php return " . var_export($data, true) . ";";
        file_put_contents(base_path('resources/lang/' . $lang . '/messages.php'), $str);
        Toastr::success('Translation file updated!');
        return back();
    }

    public function delete($lang)
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $lang_array = [];
        foreach (json_decode($language['value'], true) as $key => $data) {
            if ($data['code'] != $lang) {
                array_push($lang_array, $data);
            }
        }
        BusinessSetting::where('type', 'language')->update([
            'value' => $lang_array
        ]);

        $dir = base_path('resources/lang/' . $lang);
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);

        Toastr::success('Removed Successfully!');
        return back();
    }
}
