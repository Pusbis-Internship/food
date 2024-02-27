<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Menu;
use App\Models\Category;
use App\Models\User;

class MenuController extends Controller
{
    function data_menu(Request $request)
    {
        if ($request->has('search')) {
            $menus = Menu::where('menu_name', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $menus = Menu::all();
        }
        return view('pointakses/admin/data_menu/tampilkan_menu', compact('menus'));
    }

    function create_menu()
    {
        $categories = Category::all();
        $users = User::where('role', 'seller')->get();

        return view('pointakses/admin/data_menu/create', compact('categories', 'users'));
    }

    function store_menu(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'menu_pic' => 'required|image|mimes:jpeg,jpg,png',
            'min_order' => 'required|in:H-1,H-2,H-3', 
        ]);

        $menu = new Menu();
        $menu->menu_name = $request->input('menu_name');
        $menu->menu_price = $request->input('menu_price');
        $menu->category_id = $request->input('category');
        $menu->users_id = $request->input('vendor');
        $menu->menu_desc = $request->input('menu_desc');
        $menu->min_order_time = $request->input('min_order');


        // $menu->users_id = auth()->id();

        // Ambil ID makanan yang baru saja disimpan
        $menuId = $menu->id;

        if ($request->hasFile('menu_pic')) {
            $image = $request->file('menu_pic');

            // Ubah nama file gambar menjadi ID makanan
            $imageName = $menuId . '.' . $image->getClientOriginalExtension();

            // Simpan gambar ke direktori storage dengan nama baru
            $imagePath = $image->storeAs('public/menu_images/', $imageName);

            // Update path gambar pada model Menu
            $menu->menu_pic = $imagePath;
        }

        $menu->save();

        return redirect()->route('datamenu')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    function edit_menu(string $id): View
    {
        $menus = Menu::findOrFail($id);

        return view('pointakses/admin/data_menu/edit', compact('menus'));
    }

    function menu_update(Request $request, $id)
    {
        $menus = Menu::find($id);
        $menus->menu_name = $request->input('menu_name');
        $menus->menu_price = $request->input('menu_price');
        $menus->category_id = $request->input('category');
        $menus->menu_desc = $request->input('menu_desc');
        $menus->users_id = auth()->id();
        $menus->save();

        // Ambil ID makanan yang baru saja disimpan
        $menuId = $menus->id;

        if ($request->hasFile('menu_pic')) {
            $image = $request->file('menu_pic');

            // Ubah nama file gambar menjadi ID makanan
            $imageName = $menuId . '.' . $image->getClientOriginalExtension();

            // Simpan gambar ke direktori storage dengan nama baru
            $imagePath = $image->storeAs('public/menu_images/', $imageName);

            // Update path gambar pada model Menu
            $menus->menu_pic = $imagePath;
            $menus->save();
        }

        return redirect()->route('datamenu')->with('Berhasil', 'Menu berhasil diupdate.');
        ;
    }
    public function menu_delete($id)
    {
        $menus = menu::find($id);
        $menus->delete();

        return redirect()->back();
    }
}