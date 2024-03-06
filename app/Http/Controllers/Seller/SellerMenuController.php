<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SellerMenuController extends Controller
{
    function data_menu_seller(Request $request)
    {
        if ($request->has('search')) {
            $menus = Menu::where('menu_name', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $menus = Menu::all();
        }
        return view('pointakses/seller/data_menu_seller/tampilkan_menu_seller', compact('menus'));
    }

    function create_menu()
    {
        $categories = Category::all();

        return view('pointakses/seller/data_menu_seller/create', compact('categories'));
    }

    function store_menu(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'menu_pic' => 'required|image|mimes:jpeg,jpg,png',
            'min_order' => 'required|in:H-1,H-2,H-3',
        ]);

        $user = auth()->user();

        $menu = new Menu();
        $menu->menu_name = $request->input('menu_name');
        $menu->menu_price = $request->input('menu_price');
        $menu->seller = $user->nama_lengkap;
        $menu->category_id = $request->input('category');
        $menu->menu_desc = $request->input('menu_desc');
        $menu->users_id = auth()->id();
        $menu->min_order_time = $request->input('min_order');
        $menu->save();


        // Ambil ID makanan yang baru saja disimpan
        $menuId = $menu->id;

        if ($request->hasFile('menu_pic')) {
            $image = $request->file('menu_pic');
        
            // Ubah nama file gambar menjadi ID makanan
            $imageName = $menuId . '.' . $image->getClientOriginalExtension();
        
            // Simpan gambar ke direktori storage dengan nama baru
            $resizedImage = Image::make($image)->fit(600, 520)->encode();
        
            // Tentukan path penyimpanan baru
            $imagePath = 'public/menu_images/' . $imageName;
        
            // Simpan gambar yang telah diresize ke dalam penyimpanan
            Storage::put($imagePath, $resizedImage);
        
            // Update path gambar pada model Menu
            $menu->menu_pic = $imagePath;
            $menu->save();
        }

        return redirect()->route('data_menu_seller')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    function edit_menu(string $id): View
    {
        $menus = Menu::findOrFail($id);

        return view('pointakses/seller/data_menu_seller/edit', compact('menus'));
    }

    function menu_update(Request $request, $id): RedirectResponse
    {
        $menus = Menu::find($id);
        $menus->menu_name = $request->input('menu_name');
        $menus->menu_price = $request->input('menu_price');
        $menus->category_id = $request->input('category');
        $menus->menu_desc = $request->input('menu_desc');
        $menus->min_order_time = $request->input('min_order');
        $menus->users_id = auth()->id();
        $menus->save();

        // Ambil ID makanan yang baru saja disimpan
        $menuId = $menus->id;

        if ($request->hasFile('menu_pic')) {
            $image = $request->file('menu_pic');

            // Ubah nama file gambar menjadi ID makanan
            $imageName = $menuId . '.' . $image->getClientOriginalExtension();

            $resizedImage = Image::make($image)->fit(600, 520)->encode();

            // Tentukan path penyimpanan baru
            $imagePath = 'public/menu_images/' . $imageName;
        
            // Simpan gambar yang telah diresize ke dalam penyimpanan
            Storage::put($imagePath, $resizedImage);

            // Update path gambar pada model Menu
            $menus->menu_pic = $imagePath;
            $menus->save();
        }

        return redirect()->route('data_menu_seller')->with('Berhasil', 'Menu berhasil diupdate.');
    }
    public function menu_delete($id)
    {
        $menus = menu::find($id);
        $menus->delete();

        return redirect()->back();
    }
}