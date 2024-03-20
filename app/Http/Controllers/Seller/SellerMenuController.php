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

    public function store_menu(Request $request): RedirectResponse
    {
        // Validasi input
        $this->validate($request, [
            'menu_pic' => 'required|image|mimes:jpeg,jpg,png',
            'min_order' => 'required|in:H-1,H-2,H-3',
        ]);
    
        // Mendapatkan user yang sedang login
        $user = auth()->user();
    
        // Membuat instance model Menu
        $menu = new Menu();
        $menu->menu_name = $request->input('menu_name');
        $menu->menu_price = $request->input('menu_price');
        $menu->seller = $user->nama_lengkap;
        $menu->category_id = $request->input('category');
        $menu->menu_desc = $request->input('menu_desc');
        $menu->users_id = auth()->id();
        $menu->min_order_time = $request->input('min_order');
        $menu->makanan_1 = $request->input('makanan_1');
        $menu->makanan_2 = $request->input('makanan_2');
        $menu->makanan_3 = $request->input('makanan_3');
        $menu->makanan_4 = $request->input('makanan_4');
        $menu->makanan_5 = $request->input('makanan_5');
        $menu->makanan_6 = $request->input('makanan_6');
        $menu->makanan_7 = $request->input('makanan_7');
        $menu->makanan_8 = $request->input('makanan_8');
    
    
        // Simpan data menu ke dalam database
        $menu->save();
    
        // Jika terdapat file gambar yang diupload
        if ($request->hasFile('menu_pic')) {
            $image = $request->file('menu_pic');
    
            // Ubah nama file gambar menjadi ID menu
            $imageName = $menu->id . '.' . $image->getClientOriginalExtension();
    
            // Resize dan simpan gambar ke dalam penyimpanan
            $resizedImage = Image::make($image)->fit(600, 520)->encode();
            $imagePath = 'public/menu_images/' . $imageName;
            Storage::put($imagePath, $resizedImage);
    
            // Update path gambar pada model Menu
            $menu->menu_pic = $imagePath;
            $menu->save();
        }
    
        // Redirect dengan pesan sukses
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
