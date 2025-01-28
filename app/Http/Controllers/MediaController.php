<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        dd(session()->get('locale'));
        return view('media.index');
    }
}
