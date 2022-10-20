<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;

class SiteController extends Controller
{
 
    public function landing() {
        $categories = Category::get()->sortBy('category');
        return view('pages.landing', compact('categories'));
        
        // return view('pages.landing');
    }
}
