<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $menu_items = MenuItem::all();
        return view('frontend.home', compact('menu_items'));
    }

    public function menu()
    {
        $categories = Category::with('menuItems')->get();

        return view('frontend.menu', compact('categories'));
    }

    public function productDetail($id)
    {
        $product = MenuItem::findOrFail($id);
        return view('frontend.product_detail', compact('product'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function location()
    {
        return view('frontend.location');
    }
}