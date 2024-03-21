<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $makanans = Menu::where('category_id', 1)->get();
        $minumans = Menu::where('category_id', 2)->get();
        $snacks   = Menu::where('category_id', 3)->get();

        $order = session()->get('order', []);
        $total = 0;

        foreach ($order as $id => $order_detail) {
            $subtotal = isset ($order_detail['subtotal']) ? $order_detail['subtotal'] : 0;
            $subtotal += $order_detail['quantity'] * $order_detail['menu_price'];
            $order[$id]['subtotal'] = $subtotal;
            $total += $subtotal;
        }
        session()->put('order', $order);  // Update the session with new subtotal values

        return view('frontend.customer.homepage', compact('makanans', 'minumans', 'snacks', 'order', 'total'));

    }
    public function menu(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        if ($search) {
            $menus = Menu::where('menu_name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $menus = Menu::all();
        }
        return view('frontend.customer.page.page_menu', compact('categories', 'menus', 'search'));
    }
    public function filterMenu(Request $request)
    {
        $categories = Category::all();
        $category = $request->input('category');

        if ($category) {
            $menus = Menu::where('category_id', $category)->get();
        } else {
            $menus = Menu::all();
        }
        return view('frontend.customer.page.page_menu', compact('menus', 'categories'));
    }
    public function about()
    {
        return view('frontend.customer.page.page_about');
    }
    public function contact()
    {
        return view('frontend.customer.page.page_contact');
    }
}