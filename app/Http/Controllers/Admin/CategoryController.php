<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function data_kategori()
    {
        $categories = Category::all();
        return view('pointakses/admin/data_kategori/tampilkan_data', compact('categories'));
    }

    function create_category()
    {
        return view('pointakses/admin/data_kategori/create');
    }

    function store_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        return redirect()->route('datakategori')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    function edit_category(string $id): View
    {
        $categories = Category::findOrFail($id);

        return view('pointakses/admin/data_kategori/edit', compact('categories'))->with(['success' => 'Data Berhasil Disimpan!']);
    }


    function category_update(Request $request, $id)
    {
        $categories = Category::find($id);
        $categories->category_name = $request->input('category_name'); // Perbaikan disini
        $categories->save();

        return redirect()->route('datakategori')->with('Berhasil', 'Kategori berhasil diupdate.');
    }
    public function category_delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back();
    }

}