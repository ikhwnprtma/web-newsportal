<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view("admin.category.index",compact("categories"));
    }

    public function create(){
        return view("admin.category.create");
    }
    
    public function store(Request $request){
        $request->validate([
            "name"=> "required|unique:tb_categories|max:255" 
        ]);

        Category::create($request->all());

        return redirect()->route("categories.index")->with("success","Kategori berhasil ditambahkan.");
    }

    public function edit(Category $category){
        return view("admin.category.edit",compact("category"));
    }

    public function update(Request $request, Category $category){
        $request->validate([
            "name"=> "required|max:256|unique:tb_categories,name," . $category->id 
        ]);
        
        $category->update($request->all());
        return redirect()->route("categories.index")->with("success","Kategori Berhasil Di Perbarui");
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route("categories.index")->with("success","Kategori Berhasil Di Hapus");
        
    }
}

