<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public $available_locales;
    public $locale;

    public function __construct(Request $request)
    {
        $this->available_locales = config('app.available_locales');
        $this->locale = $request->locale;
    }
    public function update()
    {
        if (isset($locale) && in_array($this->locale, $this->available_locales)) {
            app()->setLocale($this->locale);
            session()->put('locale', $this->locale);
        }
        return redirect()->back();
    }
}
