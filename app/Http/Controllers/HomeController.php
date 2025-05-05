<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $files = Storage::disk('public')->files('dcp');
        $dcpFiles = array_map('basename', $files);

        return view('welcome', compact('dcpFiles'));
    }
}
