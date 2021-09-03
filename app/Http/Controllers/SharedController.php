<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SharedController extends Controller
{
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->forget('language_settings');
        Helpers::language_load();
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
